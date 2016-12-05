# 漏洞检测平台

> A platform to scan the bugs of a certain website like [bugscan](http://www.bugscan.net/)

## 版本一(v1)

### 页面功能

- 用户可以`登录注册`，`上传漏洞脚本`，`检测网站漏洞`

- 主要使用到了`Yii2基础版`,`RabbitMQ`,`WorkerMan`

- 感谢@Hanaasagi 的外部`Python脚本`以及`队列消息`的提供

### API功能

`Nginx` root /path/to/path/api;

- 用户的登录注册接口

```
POST domain/v1/user/login
传入参数
--username=?&password=?--
成功则返回
{'status' : 1,'msg' : 'login successfully','uid' : $id,'code' : 200}

POST domain/v1/user/reg
传入参数
--username=?&password=?&email=?--
{'status' : 1,'msg' : 'loginup successfully','code' : 200}
```

- 漏洞检测接口

```
POST path/v1/infos body
传入参数 
--website=?&client_id=?&uid=?-- 

通过websocket把消息从队列中取出再实时输出到客户端
```






