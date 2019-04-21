# Todo-app

TODO应用简单常见，是最佳入门范例之一。

本文在已有HTML的情况下，提供后端API开发的思路。

提供的API：

| 接口编号 | 接口URL | 接口功能 |
|-----|----| ------------|
|1 | /user/add  |增加用户（用户注册）|
|2 | /user/login  |用户授权|
|3 | /project/getAll |查询所有的项目|
|3 | /project/add  |增加一个项目|
|4 | /activity/getAll |查询某个项目下的所有TODO项|
|5 | /activity/add |向某个项目添加TODO项|


纯HTML的实现，借助浏览器的本地存储也可以保存信息。但是存在无法跨设备，无法多人使用等限制。本文在已有HTML实现的基础上，提供后端API。

1. PHP版本的后端接口实现，展示了简单的PHP框架的雏形
2. [Go语言版本的实现](https://blog.csdn.net/panxl6/article/details/78758468)

[HTML来自另一个开源项目](https://github.com/themaxsandelin/todo.git)