钉钉第三方应用接口封装
===============
## 目录结构
~~~
├─wty_ding              根目录
│  ├─api                接口目录
│  ├─request            http请求类
│─Autoloader.php        实现自动加载
│─Dingconfig.php        全局配置文件
|—test.php              初始化过程
~~~

* 1、http 请求是从原来官方sdk包中整理出来的
* 2、autoloader  类自动加载
* 3、request  http 请求类
* 4、api 请求接口的具体类
* 5、Dingconfig  全局配置文件
* 6、test  接口请求运行的测试文件
* 7、完成Dingconfig 和 Http 类的实例化后再实例还api下的类就可以请求相应的接口