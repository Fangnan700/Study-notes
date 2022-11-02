# 按不了的F12

启动靶机：

![image-20221102110157275](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102110157275.png)

根据题目名称可知，这题与f12按键有关，即查看网页源代码。

按下f12发现f12按键被禁用：

![image-20221102110308028](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102110308028.png)

尝试另一种方式：右键->查看网页源代码

![image-20221102110407905](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102110407905.png)

发现同样被禁用，尝试第三种方式：ctrl+u

![image-20221102110453573](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102110453573.png)

发现同样被禁用，于是，在chrome浏览器的选项栏中打开开发者工具或ctrl+shift+i：

![image-20221102110754981](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102110754981.png)

获得flag。





# GET and POST

启动靶机：

![image-20221102111123679](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102111123679.png)

根据题目名称可知，这题考察的是http协议的请求方法，主要是get和post两种。

观察url发现：

![image-20221102111221039](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102111221039.png)

需要传入一个参数：what

根据网页上的提示，将flag作为payload传入：

![image-20221102111335099](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102111335099.png)

页面反馈：

![image-20221102111357298](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102111357298.png)

这里考察更改请求方式的方法。

使用burpsuite抓包：

![image-20221102111614287](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102111614287.png)

使用Rpeater模块更改请求参数：

![image-20221102111822041](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102111822041.png)

更改如下：

1. 更改请求方式：GET更改为POST
2. 添加请求头信息：Content-Type: application/x-www-form-urlencoded
3. 添加数据：what=flag

![image-20221102111912883](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102111912883.png)

发送数据包，获得flag：

![image-20221102111941737](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102111941737.png)





# 世界上最好的语言

启动靶机：

![image-20221102112228168](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102112228168.png)

发现php源码，分析源码可知：

程序从get请求的参数中获取变量flag，然后将flag的值进行md5加密，并将加密后的数据与字符串"s155964671a"进行md5加密后的数据进行比较，若相等且flag的值不与给定字符串相同，则输出flag。

编写脚本，获取字符串"s155964671a"的md5值：

![image-20221102112806795](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102112806795.png)

发现结果以0e开头，由此可知存在md5碰撞漏洞，使用md5值同样以0e开头的其它字符串作为payload传入（网上有很多，也可以自己写脚本跑出来，这里不赘述）

![image-20221102113137171](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102113137171.png)

获得flag：

![image-20221102113159456](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102113159456.png)

补充知识：

MD5是一种哈希算法，任意长度的输入经过处理后输出为128位的信息，且尽量使结果不冲突和信息不可逆。

php是一门弱类型语言，脚本中进行两个值的比较时，使用的是 == ，这是一种弱类型比较运算，之比较值，不比较类型。

PHP规定当进行字符串与数字的弱比较时，会进行如下步骤：

先看字符串开头是否为数字，如果为数字，则截止到连续数字的最后一个数字，即"123abc456"=>123

如果开头不为数字，则判断为false，即0。因此

("aaa123"==0) =>true

("123a"==123) =>true

由于两个md5值字符串都以0e开头且0e后不含有字母，所以在使用 == 进行比较时，都被当作用科学计数法表示的数字，因为0的n次幂仍为0，所以这条语句恒为真。





# 爱冒险的朵拉

启动靶机：

![image-20221102114212248](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102114212248.png)

非常可爱的画面hhh~

点击页面上的几个按钮，发现除了页面上的提示变化，url也有相应的变化：

![image-20221102114313457](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102114313457.png)

![image-20221102114322110](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102114322110.png)

![image-20221102114335398](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102114335398.png)

由此可知，页面显示不同的信息是通过读取服务器上的不同文件实现的，由此推测存在目录穿越漏洞，即通过更改url，可以读取服务器上的任意文件。

根据题目的提示信息：

![image-20221102114530239](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102114530239.png)

尝试构造payload，读取服务器根目录下的flag.txt

```
http://172.23.12.119:10869/index.php?place=../../../../flag.txt
```

这里的../代表的是linux文件系统中的上层目录，通过叠加可以逐层返回到上一层目录，直至根目录（层数不一定，可以根据需要尝试）

传入参数，获得flag：

![image-20221102114751240](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102114751240.png)





# 小心捣蛋鬼

启动靶机：

![image-20221102114920157](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102114920157.png)

发现两个base64字符串：

```
572R56uZ6KaB6K6w5b6X5aSH5Lu95ZOm
5pivdGFyLnh65LiN5pivdGFyLmd4fg==
```

分别解密后得到：

```
网站要记得备份哦
是tar.xz不是tar.gx~
```

由此推测服务器上存在网站的备份文件泄漏漏洞

获取泄露文件的方法一般就是先寻找备份目录以及备份文件名然后下载

**常见的备份文件所在目录**

```
/
/admin 
/data
/default
/index
/login
/manage
/cmseditor
/db
/bbs
/phpadmin
```

**常见的备份文件的文件名**

```
web
website
backup
back
www
wwwroot
temp
db
data
code
test
admin
user
sql
```

**常见的备份文件后缀名**

```
.rar
.zip
.7z
.tar.gz
.bak
index.php.bak
.txt
.old
.temp
_index.html
.swp
.sql
.tgz
tar
```

可以手工逐个尝试，也可以写脚本跑出来

根据页面上两个提示，直接访问 url/www.tar.xz 下载备份文件

![image-20221102115613107](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102115613107.png)

获取下载文件后解压，进入备份文件夹：

![image-20221102115914503](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102115914503.png)

发现一个备份文件和一个.git文件夹，首先查看index.php.bak

![image-20221102120007571](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102120007571.png)

发现flag不在这里面，于是想到.git文件，可能需要git回滚

使用git log命令查看commit信息

![image-20221102120138856](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102120138856.png)

使用git reset xxx --hard命令进行回滚（xxx表示commit编号）

回滚至323e1cc649260beea8af3b2ea6bfe9b6ebbe02e7版本时，发现index.php.bak.swp文件，推测还需要还原vim编辑器的备份文件

![image-20221102120327513](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102120327513.png)

使用命令 vim -r index.php.bak.swp 或 nvim -r index.php.bak.swp打开备份文件：

![image-20221102120608041](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221102120608041.png)

获得flag。