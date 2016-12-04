<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-10-28
 * Time: 下午11:17
 */

namespace app\controllers;
use yii\web\Controller;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use Workerman\Worker;
//use GatewayWorker\Gateway;
use Workerman\Autoloader;
use GatewayClient\Gateway;
use Yii;

class DefaultController extends Controller {
    public $enableCsrfValidation = false; //这里是重点，主要是要拦截csrf不然会400或500
    public function actionIndex() {

        return $this->renderPartial('index');
    }

    public function actionServer() {
        $data = Yii::$app->request->post();
        $fibonacci_rpc = new FibonacciRpcClient();
//        $res = $fibonacci_rpc->call($data['bug_type'] . '|' . $data['domain']);
        do{
            $res = $fibonacci_rpc->call($data['bug_type'] . '|' . $data['domain']);
            Gateway::bindUid($data['client_id'],Yii::$app->session->get('uid')) ?
                Gateway::sendToClient($data['client_id'],json_encode([
                    'msg' => $res,
                    'type' => 'other',
                    'client_id' => $data['client_id']
                ])) :
                Gateway::sendToClient($data['client_id'],json_encode([
                    'msg' => '连接失败哦',
                    'type' => 'other',
                    'client_id' => $data['client_id']
                ]));
        }while($res == 'complete');

//            $this->send_message(Yii::$app->session->get('uid'),'连接成功哦') :
//            $this->send_message(Yii::$app->session->get('uid'),'连接失败哦');
//        echo json_encode(['success' => 1,'text' => 'ok']);
//        exit();
//            $res = '';
//            $datas = Yii::$app->request->post();

//            $result = system('python Yii::$app->basePath/sender.py',$res);
//            pclose($res);
            // 创建一个Worker监听2346端口，使用websocket协议通讯


  /*          foreach($responses as $item){

                echo ['success' => 1,'text' => $item];
            }*/
//            echo $responses;


//            $responses = $fibonacci_rpc->call('hello ' . '|'.$datas['domain']);

//            $responses = $fibonacci_rpc->call('script');
            /*if(empty($datas['time']))exit();
            set_time_limit(0);//无限请求超时时间
            while (true){

//                echo ['success' => "1",'text' => $responses];
                //sleep(1);

                usleep(500000);//0.5秒
                //若得到数据则马上返回数据给客服端，并结束本次请求
                if($responses != null){
                    echo "[开始接收]";
                    $arr=array('success'=>"1",'text'=>$responses);
//                    $responses = '';
                    echo json_encode($arr);
//                    exit();
//                    continue;
                }*/

                //服务器($_POST['time']*0.5)秒后告诉客服端无数据
//                if($i==$_POST['time'] || !$responses){
               /* if($responses){
                    $arr=array('success'=>"0",'msg' => 'complete!');
                    echo json_encode($arr);
                    break;
                }*/
            /*}
        } else {
            echo json_encode(['success' => 0,'text' => 'failed to accept datas']);
        }*/
    }

    public function bind($client_id,$uid) {
        Gateway::$registerAddress = '127.0.0.1:1238';

// 假设用户已经登录，用户uid和群组id在session中
//        $uid      = $_SESSION['uid'];
// client_id与uid绑定
        Gateway::bindUid($client_id, $uid);
    }

    public function send_message($uid,$message) {
        Gateway::$registerAddress = '127.0.0.1:1238';

// 向任意uid的网站页面发送数据
        Gateway::sendToUid($uid, $message);
    }
}

class FibonacciRpcClient {
    private $connection;
    private $channel;
    private $callback_queue;
    private $response = '';
    private $corr_id;


    CONST HOST = "10.0.20.97";
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
            return $rep->body;
        }
    }

    public function call($n) {
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
        return 'complete';
    }
}

/*class WS {
    var $master;
    var $sockets = array();
    var $debug = false;
    var $handshake = false;

    function __construct($address, $port){
        $this->master=socket_create(AF_INET, SOCK_STREAM, SOL_TCP)     or die("socket_create() failed");
        socket_set_option($this->master, SOL_SOCKET, SO_REUSEADDR, 1)  or die("socket_option() failed");
        socket_bind($this->master, $address, $port)                    or die("socket_bind() failed");
        socket_listen($this->master,20)                                or die("socket_listen() failed");

        $this->sockets[] = $this->master;
        $this->say("Server Started : ".date('Y-m-d H:i:s'));
        $this->say("Listening on   : ".$address." port ".$port);
        $this->say("Master socket  : ".$this->master."\n");

        while(true){
            $socketArr = $this->sockets;
            $write = NULL;
            $except = NULL;
            socket_select($socketArr, $write, $except, NULL);  //自动选择来消息的socket 如果是握手 自动选择主机
            foreach ($socketArr as $socket){
                if ($socket == $this->master){  //主机
                    $client = socket_accept($this->master);
                    if ($client < 0){
                        $this->log("socket_accept() failed");
                        continue;
                    } else{
                        $this->connect($client);
                    }
                } else {
                    $this->log("^^^^");
                    $bytes = @socket_recv($socket,$buffer,2048,0);
                    $this->log("^^^^");
                    if ($bytes == 0){
                        $this->disConnect($socket);
                    }
                    else{
                        if (!$this->handshake){
                            $this->doHandShake($socket, $buffer);
                        }
                        else{
                            $buffer = $this->decode($buffer);
                            $this->send($socket, $buffer);
                        }
                    }
                }
            }
        }
    }

    function send($client, $msg){
        $this->log("> " . $msg);
        $msg = $this->frame($msg);
        return $msg;
//        socket_write($client, $msg, strlen($msg));
//        $this->log("! " . strlen($msg));
    }
    function connect($socket){
        array_push($this->sockets, $socket);
        $this->say("\n" . $socket . " CONNECTED!");
        $this->say(date("Y-n-d H:i:s"));
    }
    function disConnect($socket){
        $index = array_search($socket, $this->sockets);
        socket_close($socket);
        $this->say($socket . " DISCONNECTED!");
        if ($index >= 0){
            array_splice($this->sockets, $index, 1);
        }
    }
    function doHandShake($socket, $buffer){
        $this->log("\nRequesting handshake...");
        $this->log($buffer);
        list($resource, $host, $origin, $key) = $this->getHeaders($buffer);
        $this->log("Handshaking...");
        $upgrade  = "HTTP/1.1 101 Switching Protocol\r\n" .
            "Upgrade: websocket\r\n" .
            "Connection: Upgrade\r\n" .
            "Sec-WebSocket-Accept: " . $this->calcKey($key) . "\r\n\r\n";  //必须以两个回车结尾
        $this->log($upgrade);
        $sent = socket_write($socket, $upgrade, strlen($upgrade));
        $this->handshake=true;
        $this->log("Done handshaking...");
        return true;
    }

    function getHeaders($req){
        $r = $h = $o = $key = null;
        if (preg_match("/GET (.*) HTTP/"              ,$req,$match)) { $r = $match[1]; }
        if (preg_match("/Host: (.*)\r\n/"             ,$req,$match)) { $h = $match[1]; }
        if (preg_match("/Origin: (.*)\r\n/"           ,$req,$match)) { $o = $match[1]; }
        if (preg_match("/Sec-WebSocket-Key: (.*)\r\n/",$req,$match)) { $key = $match[1]; }
        return array($r, $h, $o, $key);
    }

    function calcKey($key){
        //基于websocket version 13
        $accept = base64_encode(sha1($key . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
        return $accept;
    }

    function decode($buffer) {
        $len = $masks = $data = $decoded = null;
        $len = ord($buffer[1]) & 127;

        if ($len === 126) {
            $masks = substr($buffer, 4, 4);
            $data = substr($buffer, 8);
        }
        else if ($len === 127) {
            $masks = substr($buffer, 10, 4);
            $data = substr($buffer, 14);
        }
        else {
            $masks = substr($buffer, 2, 4);
            $data = substr($buffer, 6);
        }
        for ($index = 0; $index < strlen($data); $index++) {
            $decoded .= $data[$index] ^ $masks[$index % 4];
        }
        return $decoded;
    }

    function frame($s){
        $a = str_split($s, 125);
        if (count($a) == 1){
            return "\x81" . chr(strlen($a[0])) . $a[0];
        }
        $ns = "";
        foreach ($a as $o){
            $ns .= "\x81" . chr(strlen($o)) . $o;
        }
        return $ns;
    }


    function say($msg = ""){
        echo $msg . "\n";
    }
    function log($msg = ""){
        if ($this->debug){
            echo $msg . "\n";
        }
    }
}*/



