<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-11-7
 * Time: 下午4:07
 */

namespace app\controllers;

use yii\web\Controller;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class TestController extends Controller
{

    public function actionIndex()
    {

        $fibonacci_rpc = new FibonacciRpcClient();
        $response = $fibonacci_rpc->call('script');
        echo " [.] Got ", $response, "\n";
    }


}

class FibonacciRpcClient {
    private $connection;
    private $channel;
    private $callback_queue;
    private $response;
    private $corr_id;

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
        while(!$this->response) {
            $this->channel->wait();
        }
        return intval($this->response);
    }
}



?>