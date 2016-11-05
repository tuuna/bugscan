<?php
/**
 * Created by PhpStorm.
 * User: tuuna
 * Date: 16-10-28
 * Time: 下午11:17
 */
/**
 * rabbitmq
 * HOST 10.0.68.69
 * USERNAME Haruna
 * PASSWORD moegirl
 * QUEUENAME queque
 */

namespace app\controllers;
use yii\web\Controller;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class DefaultController extends Controller {

    CONST HOST = "10.0.153.80";
    CONST PORT = 5672;
    CONST USER = "Haruna";
    CONST PASS = "moegirl";
    public function actionIndex() {
        $datas = $this->helloWolrd();
        var_dump($datas);
        return $this->renderPartial('index');
    }

    /**
     * RabbitMq Demo
     */
    public function actionRabbitMq()
    {
        $this->helloWolrd();
        return $this->renderPartial('index');
 //       $this->workQueues();
    }


    /**
     * case 1: "Hello World!"
     */
    private function helloWolrd()
    {
        echo "CASE 1: HELLO WORLD..................\n";
        $this->send('queue',"Hi,test");
        $this->recieve('queue');
    }

    private function send($queue,$msgs)
    {
        $connection = new AMQPStreamConnection(self::HOST, self::PORT, self::USER, self::PASS,'/');
        $channel = $connection->channel();
        //queue              : 队列名称
        //passive            ：当队列不存在时会抛出一个错误信息，仍然不会被声明。
        //durable            ：队列将在broker重启时启动。
        //exclusive          ：队列仅服务于一个客户端。
        //auto-delete        ：队列在没有活跃订阅者的时候将自动删除。这个类似于具有auto-delete属性的交换器：如果队
        $channel->queue_declare($queue, false, false, true, false);

        $msg = new AMQPMessage($msgs);
        $channel->basic_publish($msg,'',$queue);
        /*foreach($msgs as $m){
            $msg = new AMQPMessage($m);
            //直接扔到队列中，第三个参数routing_key这里配置的是上边声明的queue的名称
            $channel->basic_publish($msg, '',$queue);
            echo " [x] Sent message '".$m."'\n";
        }*/
        $channel->close();
        $connection->close();
    }

    private function recieve($queue)
    {
        $connection = new AMQPStreamConnection(self::HOST, self::PORT, self::USER, self::PASS);
        $channel = $connection->channel();
        $channel->queue_declare($queue, false, false, true, false);

        $callback = function($msg) {
            echo " [x] Received ", $msg->body, "\n";
        };
        $channel->basic_consume($queue, '', false, true, false, false, $callback);

        while(count($channel->callbacks)) {
            echo ' [*] Waiting for messages. To exit press CTRL+C', "\n";
            sleep(1);
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }

    /**
     * case 2: Work queues
     */
   /* private function workQueues()
    {
        echo "CASE 2: Work queues..................\n";
        $this->send2('task_queue',["This is hard task which takes 2 seconds.."]);
        $this->recieve2('task_queue');

    }

    private function send2($queue,$msgs=[])
    {
        $connection = new AMQPStreamConnection(self::HOST, self::PORT, self::USER, self::PASS);
        $channel = $connection->channel();
        //queue              : 队列名称
        //passive            ：当队列不存在时会抛出一个错误信息，仍然不会被声明。
        //durable            ：队列将在broker重启时启动。
        //exclusive          ：队列仅服务于一个客户端。
        //auto-delete        ：队列在没有活跃订阅者的时候将自动删除。这个类似于具有auto-delete属性的交换器：如果队
        $channel->queue_declare($queue, false, true, false, false);
        foreach($msgs as $m){
            $msg = new AMQPMessage($m);
            //直接扔到队列中，第三个参数routing_key这里配置的是上边声明的queue的名称
            $channel->basic_publish($msg, '',$queue);
            echo " [x] Sent message '".$m."'\n";
        }
        $channel->close();
        $connection->close();
    }


    private function recieve2($queue)
    {
        $connection = new AMQPStreamConnection(self::HOST, self::PORT, self::USER, self::PASS);
        $channel = $connection->channel();
        $channel->queue_declare($queue, false, true, false, false);

        $callback = function($msg) {
            echo " [x] Received ", $msg->body, "\n";
            sleep(substr_count($msg->body, '.'));
            echo " [x] Done", "\n";
            //发送消息确认
            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };
        //prefetch_count =1 表示队列一次只能给消费者一条消息，直到消费者处理完毕并确认
        $channel->basic_qos(null, 1, null);
        //需要消息确认
        $channel->basic_consume($queue, '', false, false, false, false, $callback);

        while(count($channel->callbacks)) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();
    }*/



}