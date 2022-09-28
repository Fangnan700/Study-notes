# SQL注入知识点回顾

## 一、漏洞原理

SQL注入是在用户可控的输入数据中注入SQL语句，破坏原有的SQL结构，构成恶意SQL语句，使服务器执行，进而获取数据库中的数据。

**漏洞形成原因**

程序设计时使用字符串拼接的方式构造SQL语句。

未对用户输入的参数进行过滤。

**漏洞可能的存在位置**

GET/POST 请求数据

HTTP 头部

Cookie 数据



## 二、常见的SQL注入类型

### **按参数类型分类**

1、**数字型注入**：

这类注入点的数据为数值型，即数据两边**无**引号包围。

输入参数为整型时，如id、年龄和页码等。

这一类的sql语句原型大概为select * from 表名 where id=1。

2、**字符型注入**：

这类注入点的数据为字符型，即数据两边**有**引号包围。

输入参数为字符型时，如姓名、职业等。

这一类的sql语句原型大概为where name=’admin’。

需要注意的是这里的引号有时也可能为双引号。



### **按回显类型分类**

1、**sql回显注入**

sql回显注入又可以分为：

a.union联合查询注入

b.报错注入

2、**sql盲注**

a.布尔盲注

b.时间注入



### 按提交方式分类

**GET注入**：注入字符在URL参数中；

**POST注入**：注入字段在POST提交的数据中；

**cookie注入**：注入字段在Cookie数据中，网站使用通用的防注入程序，会对GET、POST提交的数据进行过滤，却往往遗漏Cookie中的数据进行过滤。

**HTTP头部注入**：HTTP请求的其他内容触发的SQL注入漏洞



## 三、MYSQL数据库相关

### 注释

mysql中的注释形式有：

```sql
1、#
2、--
3、/*    */
4、/*！  */ (内联查询)？
```



### mysql元数据库（information_schema）

元数据是关于数据库的数据，如**数据库名**或**表名**，列的**数据类型**，或**访问权限**等。

information_schema表的结构：

```shell
information_schema
			|
			+-- schemeta (所有数据库的信息，show database的结果即取自这里)
			|
			|
			+--	tables (所有表的信息，show tables的结果取自这里)
			|		|
			|		+-- table_name (表的名字)
			|		|
			|		+-- table_schema (表所属数据库的名字)
			|		
			+-- columns	(所有字段的信息，show columns的结果取自这里)
					|
					+--	column_name (字段(列)的名字)
					|
					+--	table_name (字段所属表的名字)
					|
					+-- table_schema (字段所属数据库的名字)
```



### mysql常用函数及参数





## 四、SQL注入的一般流程

对于关系型数据库（具有明显的层次关系）：

获取数据库名 -> 获取表名 -> 获取列名 -> 获取数据

### 联合查询注入

联合查询注入是回显注入的一种。也可以说，联合注入的前提是页面上要有回显位。

在一个网站的正常页面，服务端执行sql语句查询数据库中的数据，客户端将数据展示在页面中，这个展示数据的位置就叫**回显位**。

#### 联合查询注入的一般步骤

1. 判断注入点
2. 判断注入类型（数字型型or字符型）
3. 判断字段数
4. 判断回显位
5. 确定数据库名
6. 确定表名
7. 确定字段名
8. 拿到数据



##### a、判断注入点

通过在请求的参数变量后加入数据来判断是否存在注入点。

以sqlilab为例：

![image-20220428141738955](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220428141738955.png)

根据提示，传入变量 id=1得到回显：

![image-20220428141851522](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220428141851522.png)

判断某个链接是否存在sql注入，可以通过对其传入的可控参数进行简单的构造，通过服务端返回的内容来判断有无注入。

传入sql语句可控参数分为两类

1. 数字类型，参数不用被引号括起来，如`?id=1`
2. 其他类型，参数要被引号扩起来，如 `?name="phone"`

数字类型               

| 构造测试   | 预期结果                 |
| ---------- | ------------------------ |
| a          | 触发错误，返回数据库错误 |
| a or 1=1   | 永真条件，返回所有记录   |
| a or 1=2   | 空条件，返回原来相同结果 |
| a and 1='2 | 永假条件，不返回记录     |

其它类型                  

| 构造测试      | 预期结果                 |
| ------------- | ------------------------ |
| a'            | 触发错误，返回数据库错误 |
| a' or '1'='1  | 永真条件，返回所有记录   |
| a' or '1'='2  | 空条件，返回原来相同结果 |
| a' and '1'='2 | 永假条件，不返回记录     |

![image-20220428142046292](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220428142046292.png)

传入参数后发现报错，修改参数为：?id=1' and 1=1-- 后再次传入，发现显示正常，说明存在注入点。

![image-20220428142548343](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220428142548343.png)





##### b、判断注入点类型

1、数字型

数字型注入的一般sql注入语句：

```
select * from tb_name where id=1;
```

测试步骤：

1. 变量后加单引号 **’**，这时sql语句后面多了一个单引号，会报错；
2. 变量后加 **and 1=1**，语句正常执行，页面与原始页面相同；
3. 变量后加 **and 1=2**，语句也可以正常执行，但页面会与原始网页存在差距

如满足以上三点，可以判断此处存在数字型注入。

2、字符型

字符型注入的一般sql注入语句：

```
select * from tb_name where cloums_name='xxx';
```

注入方式：

变量后加单引号，然后输入要执行的sql语句，最后要加上注释符来闭合程序语句后多余的引号。如：

```
https://1413-8d4d29ed-f9f8-49fa-9587-3b167311d0e7.do-not-trust.hacking.run/?id=1'  and 1=2-- 
```

当回显正常时我们可以判断此处为字符型注入。



##### c、判断字段数

使用 **order by** 语句对查询结果按照指定字段名排序。

修改指定字段的数值，通过返回结果判断所查询表的字段数：

```
order by 1
order by 2
......
```

当返回结果报错类似：**Unknown column ‘4’ in ‘order clause’** 时，即可判断该表字段数为3。



##### d、判断回显位

获取表的字段数后，需要判断回显位，即知道查询到的数据在哪个位置显示。

可以通过以下方式判断回显位：

```
union select 1,2,3,4......
```

[![img](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E5%88%A4%E6%96%AD%E5%9B%9E%E6%98%BE%E4%BD%8D.png)](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/博客/SQL注入笔记/2022-04-02/判断回显位.png)

如上图，可以判断回显位为2、3。



##### e、确定数据库名

通过 **database()、version()** 函数获取数据库的名称及版本。

```
union select database(),version()
```

[![img](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E7%A1%AE%E5%AE%9A%E6%95%B0%E6%8D%AE%E5%BA%93%E5%90%8D.png)](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/博客/SQL注入笔记/2022-04-02/确定数据库名.png)



##### f、确定表名

基础知识：

1> **information_schema**

在MySQL中，把 **information_schema** 看作是一个数据库，确切说是信息数据库。其中保存着关于MySQL服务器所维护的所有其他数据库的信息。如数据库名，数据库的表，表栏的数据类型与访问权 限等。

2> **常用的information_schema数据库表**（很重要）

① SCHEMATA表：提供了当前mysql实例中所有数据库的信息。是show databases的结果取之此表。

② TABLES表：提供了关于数据库中的表的信息（包括视图）。详细表述了某个表属于哪个schema，表类型，表引擎，创建时间等信息。

③ COLUMNS表：提供了表中的列信息。详细表述了某张表的所有列以及每个列的信息。

3> **group_concat()函数**

group_concat()会计算哪些行属于同一组，将属于同一组的列显示出来。

查询方式：

```
union select group_concat(table_name,'/') from information_schema.tables where table_schema='db_name'
```

[![img](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E7%A1%AE%E5%AE%9A%E8%A1%A8%E5%90%8D.png)](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/博客/SQL注入笔记/2022-04-02/确定表名.png)



##### g、确定字段名

与查询表名的方法类似，从 **information_schema** 中的 **columns** 表查询字段名：

```
union select group_concat(column_name,'/') from information_schema.columns where table_name='tb_name'
```

[![img](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/SQL%E6%B3%A8%E5%85%A5%E7%AC%94%E8%AE%B0/2022-04-02/%E7%A1%AE%E5%AE%9A%E5%AD%97%E6%AE%B5%E5%90%8D.png)](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/博客/SQL注入笔记/2022-04-02/确定字段名.png)



##### h、获取数据

获取数据库名、表名、字段名后就可以像正常查询数据一样获取数据库中的各种信息：

```
union select 1,2,group_concat(id,flag) from agPNVTRs-- 
```

![image-20220428151928285](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220428151928285.png)

成功拿到flag。



### Boolean盲注

盲注，就是在服务器没有错误回显时完成的注入攻击。
