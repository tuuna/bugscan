#!/usr/bin/env python
#coding=utf8
import pika
import uuid

class Center(object):
  def __init__(self):
    credentials = pika.PlainCredentials('Haruna', 'moegirl')
    self.connection = pika.BlockingConnection(pika.ConnectionParameters(
        '10.0.20.97',5672,'/',credentials))

    self.channel = self.connection.channel()

    #定义接收返回消息的队列
    result = self.channel.queue_declare(exclusive=True)
    self.callback_queue = result.method.queue

    self.channel.basic_consume(self.on_response,
                  no_ack=True,
                  queue=self.callback_queue)

  #定义接收到返回消息的处理方法
  def on_response(self, ch, method, props, body):
    self.response = body
    print body

  def request(self, n):
    self.response = ''
    self.rstr = ''
    #发送计算请求，并声明返回队列
    self.channel.basic_publish(exchange='',
                  routing_key='queue',
                  properties=pika.BasicProperties(
                     reply_to = self.callback_queue,correlation_id = str(uuid.uuid4())
                     ),
                  body=str(n))
    #接收返回的数据
    while self.response != 'end':
      self.connection.process_data_events()
    return self.response

center = Center()

print " [x] Requesting increase(30)"
response = center.request('sqlmap|http://www.laixiaojieblog.cn')
print " [.] Got %r" % (response,)
