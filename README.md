# 漏洞检测平台

> A platform to scan the bugs of a certain website like [bugscan](http://www.bugscan.net/)

## 版本一(v1)

### 页面功能

- 用户可以`登录注册`，`上传漏洞脚本`，`检测网站漏洞`。

### API功能

`Nginx` root /path/to/path/api;

- 用户的登录注册RESTful接口

```
GET path/v1/users: list all users page by page;
HEAD path/v1/users: show the overview information of user listing;
POST path/v1/users: create a new user;
GET path/v1/users/123: return the details of the user 123;
HEAD path/v1/users/123: show the overview information of user 123;
PATCH path/v1/users/123 and PUT /users/123: update the user 123;
DELETE path/v1/users/123: delete the user 123;
OPTIONS path/v1/users: show the supported verbs regarding endpoint /users;
OPTIONS path/v1/users/123: show the supported verbs regarding endpoint /users/123.
```

- 漏洞检测接口

```
POST path/v1/infos body: website=?&type=? get scan result of the website you take

 'type' means the type of the script like sql injection
```




