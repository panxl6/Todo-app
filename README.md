# Todo-app

TODO应用简单常见，是最佳入门范例之一。

纯HTML的实现，借助浏览器的本地存储也可以保存信息。但是存在无法跨设备，无法多人使用等限制。本文在已有HTML实现的基础上，提供后端API。

提供的API：

| 接口编号 | 接口URL | 接口功能 |
|-----|----| ------------|
|1 | /user/add  |增加用户（用户注册）|
|2 | /user/login  |用户授权|
|3 | /project/getAll |查询所有的项目|
|3 | /project/add  |增加一个项目|
|4 | /activity/getAll |查询某个项目下的所有TODO项|
|5 | /activity/add |向某个项目添加TODO项|



1. PHP版本的后端接口实现，展示了简单的PHP框架的雏形
2. [Go语言版本的实现](https://blog.csdn.net/panxl6/article/details/78758468)

# 单一入口
如上所示，当我们需要多个层级的url时，如果直接写多个对应目录的PHP去实现。那么每个PHP之间都会存在大量的重复代码。比如授权、打印日志。单一入口的文件应用，可以通过分层复用公共的逻辑。单一入口的限制，需要配合Nginx。

```bash
server {
    listen 80;

    server_name your-domain.com;

    index index.php;

    root /home/ubuntu/Todo-app/PHP;

    location / {
        try_files $uri $uri/ index.php?$query_string =404;
    }

    location ~ \.php(/|$) {
        include fastcgi.conf;
        fastcgi_pass unix:/run/php/php7.2-fpm.sock;
    }
}
```

# MVC
改为单一入口之后，资源访问路径都会由入口文件index.php进行分发。主要的思想是根据访问的url，定位到Controller类，然后动态调用这个类对应的方法。如果不想要按默认方式查找方法，那就需要定义路由映射。

# 自动加载
为了能够以动态调用的方式加载对应的代码，需要根据项目的目录规划定制加载函数。


[HTML来自另一个开源项目](https://github.com/themaxsandelin/todo.git)