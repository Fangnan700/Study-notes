# 1、view_source

### 题目描述：

X老师让小宁同学查看一个网页的源代码，但小宁同学发现鼠标右键好像不管用了。

### 考察方向：

查看页面源代码的几种方式：

1、页面点击右键选择查看源代码

2、按F12进入开发者工具，在element中查看

3、在页面url前面加上view-source:





# 2、robots

### 题目描述：

X老师上课讲了Robots协议，小宁同学却上课打了瞌睡，赶紧来教教小宁Robots协议是什么吧。

### 考察方向：

robots协议的基本概念及其作用，以及查看robots.txt的方式，在url栏中直接输入路径即可。

robots协议的相关知识：

robots.txt是搜索引擎中访问网站的时候要查看的第一个文件。当一个搜索蜘蛛访问一个站点时，它会首先检查该站点根目录下是否存在robots.txt，如果存在，搜索机器人就会按照该文件中的内容来确定访问的范围；如果该文件不存在，所有的搜索蜘蛛将能够访问网站上所有没有被口令保护的页面。

查看robots.txt发现提示：

```
User-agent: *
Disallow: 
Disallow: f1ag_1s_h3re.php
```

继续url栏中访问f1ag_1s_h3re.php即可获得flag。





# 3、backup

### 题目描述：

X老师忘记删除备份文件，他派小宁同学去把备份文件找出来,一起来帮小宁同学吧！

### 考察方向：

网站敏感文件备份的泄露。

常见的备份文件后缀名有： .git  .svn  .swp  .svn  .~  .bak  .bash_history

访问页面提示：你知道index.php的备份文件名吗？

方法一：猜测备份文件后缀名，逐个尝试，在url访问index.php.bak获得文件，用记事本打开即获得flag。

方法二：使用目录扫描工具：Kali下的DirBuster。使用方法如下：

1、在Target URL栏中输入要扫描的url

2、将Work Method（扫描方式）设置为Auto Switch(HEAD and GET)

3、设置Number of Threads(线程数)为20~30

4、File with list of dirs/files栏中设置要使用的字典路径。kali字典路径为：/usr/share/dirbuster/wordlists

5、URL to fuzz中可以按以下格式填写信息，扫描指定目录里的指定文件

```
:/admin/{dir}.php		扫描admin目录下的所有php文件
```







# 4、cookie

### 题目描述

X老师告诉小宁他在cookie里放了些东西，小宁疑惑地想：‘这是夹心饼干的意思吗？’

### 考察方向

cookie的基本概念以及查看cookie的方式。

访问页面提示：你知道什么是cookie吗？

按F12打开开发者工具，在application中查看cookie，发现提示"look-here:cookie.php"

访问cookie.php再次获得提示：See the http response

在network里查看headers选项，响应头中发现flag





# 5、disabled_button

### 题目描述

X老师今天上课讲了前端知识，然后给了大家一个不能按的按钮，小宁惊奇地发现这个按钮按不下去，到底怎么才能按下去呢？

### 考察方向

初步了解前端知识，查看前端源代码。

访问页面，按钮无法点击，按F12打开开发者工具，sources选项中查看源码：

```html
<html>
<head>
    <meta charset="UTF-8">
    <title>一个不能按的按钮</title>
    <link href="http://libs.baidu.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body{
            margin-left:auto;
            margin-right:auto;
            margin-TOP:200PX;
            width:20em;
        }
    </style>
</head>
<body>
<h3>一个不能按的按钮</h3>

<form action="" method="post" >
<input disabled class="btn btn-default" style="height:50px;width:200px;" type="submit" value="flag" name="auth" />
</form>

</body>
</html>
```

发现input标签里有disabled属性，disabled 属性禁用input标签。

双击disabled属性进入编辑，将其删除后即可点击按钮，获得flag。







# 6、weak_auth

### 题目描述

小宁写了一个登陆验证页面，随手就设了一个密码。

### 考察方向

弱口令爆破

访问url跳转至登录页，随意输入username后提示"please login as admin"，获得用户名。

此处发现页面空白且url栏中文件为check.php，查看源码发现提示：maybe you need a dictionary

所以采用burp进行弱口令爆破：

1、使用burp拦截登录的请求，并将请求发送至intruder

2、intruder的positions选项中设置爆破点为password，payloads选项中设置字典路径

3、开始攻击，查看响应包列表，找出length不同的选项，尝试使用该项的密码登录

4、登录成功，获得flag



