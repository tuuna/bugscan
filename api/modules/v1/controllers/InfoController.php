<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-5
 * Time: 下午7:00
 */

namespace app\api\modules\v1\controllers;
use yii\rest\ActiveController;
use app\models\Info;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Yii;

class InfoController extends ActiveController
{

    public $modelClass = 'app\models\Info';

    public function actions() {
        $actions = parent::actions();
        // 禁用""index,delete" 和 "create" 操作
        unset($actions['index'],$actions['delete'], $actions['create'],$actions['view']);
        return $actions;

    }

    //重写create的业务实现
    public function actionCreate()
    {
        $model = new Info();
        $datas = Yii::$app->getRequest()->getBodyParams();
        if($model->find()->where(['website' => $datas['website']])->one()) {
            echo  json_encode(['status' =>1,'datas' => $model->find()->where(['website' => $datas['website']])->one()->info]);
        } else {
            $fibonacci_rpc = new FibonacciRpcClient();
            $responses = $fibonacci_rpc->call($datas['website'].'_'.$datas['type']);
            $model->save(['info' => $responses]);
            echo  json_encode(['status' =>1,'datas' => $responses]);
        }
    }
}

class FibonacciRpcClient {
    private $connection;
    private $channel;
    private $callback_queue;
    private $response;
    private $corr_id;
    private $result = '';

    CONST HOST = "10.0.153.80";
    CONST PORT = 5672;
    CONST USER = "Haruna";
    CONST PASS = "moegirl";

    public function __construct() {
        $this->connection = new AMQPStreamConnection(
            self::HOST, self::PORT, self::USER, self::PASS);
        $this->channel = $this->connection->channel();
        list($this->callback_queue, ,) = $this->channel->queue_declare(
            "", false, false, true, false);
        $this->channel->basic_consume(
            $this->callback_queue, '', false, false, false, false,
            array($this, 'on_response'));
    }
    public function on_response($rep) {
        if($rep->get('correlation_id') == $this->corr_id) {
            $this->result .= $rep->body;
            $this->response = $rep->body;
        }
    }

    public function call($n) {
        $this->response = null;
        $this->corr_id = uniqid();

        $msg = new AMQPMessage(
            (string) $n,
            array('correlation_id' => $this->corr_id,
                'reply_to' => $this->callback_queue)
        );
        $this->channel->basic_publish($msg, '', 'queue');
        while($this->response != "end") {
            $this->channel->wait();
        }
        return $this->result;
    }
}