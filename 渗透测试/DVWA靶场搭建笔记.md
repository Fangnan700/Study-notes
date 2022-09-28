# DVWA靶场搭建

操作系统：Windows10

基础环境：php+apache+mysql

## 一、使用phpstudy搭建基础环境

phpstudy下载地址：

https://www.xp.cn/download.html

1、安装完成后，删除默认网站。

2、更改mysql数据库密码。

3、开启apache和mysql服务。

## 二、安装DVWA靶场

DVWA靶场下载地址：

https://dvwa.co.uk/

将源码解压后，复制到phpstudy安装目录下的WWW文件夹中，并在phpstudy面板中新建一个网站，根目录选择复制到WWW文件夹内的DVWA-master文件夹。

**配置数据库**

将DVWA-master/config/config.inc.php.dist的后缀名 dist 删掉，打开config.inc.php文件。

找到以下文字：

```
#If you are using MariaDB then you cannot use root, you must use create a dedicated DVWA user.
#See README.md for more information on this.
$_DVWA = array();
$_DVWA[ 'db_server' ]   = '127.0.0.1';
$_DVWA[ 'db_database' ] = 'dvwa';
$_DVWA[ 'db_user' ]     = 'dvwa';
$_DVWA[ 'db_password' ] = 'p@ssw0rd';
$_DVWA[ 'db_port'] = '3306';
```

将 $_DVWA[ 'db_user' ] 的值改为要用于登录MySQL数据库的用户名称，这里改为 root 。

将 $_DVWA[ 'db_password' ] 的值改为 用户root的登陆密码，即安装phpstudy时更改的数据库密码。

**测试靶场搭建情况**

使用浏览器访问：

127.0.0.1:80

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/DVWA%E9%9D%B6%E5%9C%BA%E6%90%AD%E5%BB%BA/2022-03-30/DVWA%E5%88%9D%E5%A7%8B.png)

发现报错。

**修复问题**

1、打开phpstudy安装目录下的Extensions/php/php7.3.4nts/php.ini配置文件，找到如下文字：

```
; Whether to allow the treatment of URLs (like http:// or ftp://) as files.
; http://php.net/allow-url-fopen
allow_url_fopen=On

; Whether to allow include/require to open URLs (like http:// or ftp://) as files.
; http://php.net/allow-url-include
allow_url_include=Off
```

将 allow_url_fopen 和 allow_url_include 全部设置为 On 。

2、打开DVWA文件夹里的config.inc.php文件，找到如下文字：

```
# ReCAPTCHA settings
#   Used for the 'Insecure CAPTCHA' module
#   You'll need to generate your own keys at: https://www.google.com/recaptcha/admin
$_DVWA[ 'recaptcha_public_key' ]  = '';
$_DVWA[ 'recaptcha_private_key' ] = '';
```

将 $_DVWA[ 'recaptcha_public_key' ] 的值设置为：6LdK7xITAAzzAAJQTfL7fu6I-0aPl8KHHieAT_yJg

将 $_DVWA[ 'recaptcha_private_key' ] 的值设置为：6LdK7xITAzzAAL_uw9YXVUOPoIHPZLfw2K1n5NVQ

设置完成后在phpstudy面板中重启apache服务，再重新访问127.0.0.1:80

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/DVWA%E9%9D%B6%E5%9C%BA%E6%90%AD%E5%BB%BA/2022-03-30/DVWA%E4%BF%AE%E5%A4%8D%E9%97%AE%E9%A2%98.png)

问题修复完成。

点击下方的 Create/Reset Database 按钮，初始化数据库。

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/DVWA%E9%9D%B6%E5%9C%BA%E6%90%AD%E5%BB%BA/2022-03-30/%E5%88%9D%E5%A7%8B%E5%8C%96%E6%95%B0%E6%8D%AE%E5%BA%93.png)

数据库初始化完成。

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/DVWA%E9%9D%B6%E5%9C%BA%E6%90%AD%E5%BB%BA/2022-03-30/%E6%95%B0%E6%8D%AE%E5%BA%93%E5%88%9D%E5%A7%8B%E5%8C%96%E5%AE%8C%E6%88%90.png)

## 三、登录DVWA靶场

DVWA默认的用户有五组，任选一个登录即可：

```
username:admin
password:password
```

```
username:gordonb
password:abc123
```

```
username:1337
password:charley
```

```
username:pablo
password:letmein
```

```
username:smithy
password:password
```

