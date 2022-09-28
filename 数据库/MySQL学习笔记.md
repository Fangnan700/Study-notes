# 数据库的基本概念

## 一、什么是数据库？

数据库（Database）是按照数据结构来组织、存储和管理数据的仓库。

每个数据库都有一个或多个不同的 **API** 用于创建，访问，管理，搜索和复制所保存的数据。

我们也可以将数据存储在文件中，但是在文件中读写数据速度相对较慢。

所以，现在我们使用**关系型数据库管理系统（RDBMS）**来存储和管理大数据量。

关系型数据库，是建立在关系模型基础上的数据库，借助于集合代数等数学概念和方法来处理数据库中的数据。

RDBMS 即关系数据库管理系统的特点：

- 1.数据以表格的形式出现
- 2.每行为各种记录名称
- 3.每列为记录名称所对应的数据域
- 4.许多的行和列组成一张表单
- 5.若干的表单组成database



## 二、RDBMS 术语

- **数据库:** 数据库是一些关联表的集合。
- **数据表:** 表是数据的矩阵。在一个数据库中的表看起来像一个简单的电子表格。
- **列:** 一列(数据元素) 包含了相同类型的数据, 例如邮政编码的数据。
- **行：**一行（=元组，或记录）是一组相关的数据，例如一条用户订阅的数据。
- **冗余**：存储两倍数据，冗余降低了性能，但提高了数据的安全性。
- **主键**：主键是唯一的。一个数据表中只能包含一个主键。你可以使用主键来查询数据。
- **外键：**外键用于关联两个表。
- **复合键**：复合键（组合键）将多个列作为一个索引键，一般用于复合索引。
- **索引：**使用索引可快速访问数据库表中的特定信息。索引是对数据库表中一列或多列的值进行排序的一种结构。类似于书籍的目录。
- **参照完整性:** 参照的完整性要求关系中不允许引用不存在的实体。与实体完整性是关系模型必须满足的完整性约束条件，目的是保证数据的一致性。





# MySQL的安装

Ubuntu系统直接使用apt命令安装即可：

```
sudo apt install mysql-server
```

验证MySQL的安装：

```
mysqladmin --version
```

终端上该命令将输出以下结果，该结果基于系统信息：

```
mysqladmin  Ver 8.23 Distrib 5.0.9-0, for redhat-linux-gnu on i386
```

MySQL默认的root用户密码为空，使用以下命令创建用户密码：

```
mysqladmin -u root password "newpassword";
```

创建密码后使用以下命令连接MySQL数据库：

```
mysql -u root -p
newpassword
```



# MySQL 的管理

Ubuntu系统下：

检查MySQL服务是否启动：

```
ps -ef | grep mysqld
```

如果MySql已经启动，以上命令将输出mysql进程列表。

如果mysql未启动，可以使用以下命令来启动mysql服务器：

```
cd /usr/bin
./mysqld_safe &
```

若要关闭目前运行的 MySQL 服务器, 可以执行以下命令：

```
cd /usr/bin
./mysqladmin -u root -p shutdown
```



# MySQL 用户设置

添加 MySQL 用户，只需要在MySQL 数据库中的 user 表添加新用户即可。

```sql
use mysql;
INSERT INTO user(host,ser,password,select_priv,insert_priv,update_priv) VALUES('localhost','guest',MD5('guest123'),'Y','Y','Y');
FLUSH PRIVILEGES;
```

添加用户时，使用MySQL提供的 MD5() 函数来对密码进行加密。

执行 **FLUSH PRIVILEGES** 语句后会重新载入授权表。

如果不使用该命令，就无法使用新创建的用户来连接mysql服务器，除非重启mysql服务器。

可以在创建用户时，为用户指定权限，在对应的权限列中，在插入语句中设置为 'Y' 即可，用户权限列表如下：

- Select_priv
- Insert_priv
- Update_priv
- Delete_priv
- Create_priv
- Drop_priv
- Reload_priv
- Shutdown_priv
- Process_priv
- File_priv
- Grant_priv
- References_priv
- Index_priv
- Alter_priv



# 管理MySQL的常用命令

##### USE DB_NAME :
选择要操作的Mysql数据库，使用该命令后所有Mysql命令都只针对该数据库。

```sql
use RUNOOB;
```

##### SHOW DB_NAME:
列出 MySQL 数据库管理系统的数据库列表。

```sql
show databases;
```

##### SHOW TABLES:
显示指定数据库的所有表，使用该命令前需要使用 use 命令来选择要操作的数据库。

```sql
show tables;
```

##### SHOW COLUMNS FROM TB_NAME:
显示数据表的属性，属性类型，主键信息 ，是否为 NULL，默认值等其他信息。

```sql
show columns from tb_name;
```

##### SHOW INDEX FROM TB_NAME:
显示数据表的详细索引信息，包括PRIMARY KEY（主键）。

```sql
show index from tb_name;
```

##### SHOW TABLE STATUS [FROM DB_NAME] [LIKE 'TB_NAME'] \G:
该命令将输出Mysql数据库管理系统的性能及统计信息。

```sql
show table status from db_name like 'tb_name'\G;
```

参数 \G 表示结果按列打印。



# MySQL的数据类型

MySQL 支持多种类型，大致可以分为三类：数值、日期/时间和字符串(字符)类型。

## 一、数值类型

包括严格数值数据类型(INTEGER、SMALLINT、DECIMAL 和 NUMERIC)，

以及近似数值数据类型(FLOAT、REAL 和 DOUBLE PRECISION)。

| 类型         | 大小                                     | 范围（有符号）                                               | 范围（无符号）                                               | 用途            |
| :----------- | :--------------------------------------- | :----------------------------------------------------------- | :----------------------------------------------------------- | :-------------- |
| TINYINT      | 1 Bytes                                  | (-128，127)                                                  | (0，255)                                                     | 小整数值        |
| SMALLINT     | 2 Bytes                                  | (-32 768，32 767)                                            | (0，65 535)                                                  | 大整数值        |
| MEDIUMINT    | 3 Bytes                                  | (-8 388 608，8 388 607)                                      | (0，16 777 215)                                              | 大整数值        |
| INT或INTEGER | 4 Bytes                                  | (-2 147 483 648，2 147 483 647)                              | (0，4 294 967 295)                                           | 大整数值        |
| BIGINT       | 8 Bytes                                  | (-9,223,372,036,854,775,808，9 223 372 036 854 775 807)      | (0，18 446 744 073 709 551 615)                              | 极大整数值      |
| FLOAT        | 4 Bytes                                  | (-3.402 823 466 E+38，-1.175 494 351 E-38)，0，(1.175 494 351 E-38，3.402 823 466 351 E+38) | 0，(1.175 494 351 E-38，3.402 823 466 E+38)                  | 单精度 浮点数值 |
| DOUBLE       | 8 Bytes                                  | (-1.797 693 134 862 315 7 E+308，-2.225 073 858 507 201 4 E-308)，0，(2.225 073 858 507 201 4 E-308，1.797 693 134 862 315 7 E+308) | 0，(2.225 073 858 507 201 4 E-308，1.797 693 134 862 315 7 E+308) | 双精度 浮点数值 |
| DECIMAL      | 对DECIMAL(M,D) ，如果M>D，为M+2否则为D+2 | 依赖于M和D的值                                               | 依赖于M和D的值                                               | 小数值          |



## 二、日期和时间类型

表示时间值的日期和时间类型为DATETIME、DATE、TIMESTAMP、TIME和YEAR。

每个时间类型有一个有效值范围和一个"零"值，当指定不合法的MySQL不能表示的值时使用"零"值。

| 类型      | 大小 ( bytes) | 范围                                                         | 格式                | 用途                     |
| :-------- | :------------ | :----------------------------------------------------------- | :------------------ | :----------------------- |
| DATE      | 3             | 1000-01-01/9999-12-31                                        | YYYY-MM-DD          | 日期值                   |
| TIME      | 3             | '-838:59:59'/'838:59:59'                                     | HH:MM:SS            | 时间值或持续时间         |
| YEAR      | 1             | 1901/2155                                                    | YYYY                | 年份值                   |
| DATETIME  | 8             | 1000-01-01 00:00:00/9999-12-31 23:59:59                      | YYYY-MM-DD HH:MM:SS | 混合日期和时间值         |
| TIMESTAMP | 4             | 1970-01-01 00:00:00/2038结束时间是第 **2147483647** 秒，北京时间 **2038-1-19 11:14:07**，格林尼治时间 2038年1月19日 凌晨 03:14:07 | YYYYMMDD HHMMSS     | 混合日期和时间值，时间戳 |



## 三、字符串类型

字符串类型指CHAR、VARCHAR、BINARY、VARBINARY、BLOB、TEXT、ENUM和SET。

| 类型       | 大小                  | 用途                            |
| :--------- | :-------------------- | :------------------------------ |
| CHAR       | 0-255 bytes           | 定长字符串                      |
| VARCHAR    | 0-65535 bytes         | 变长字符串                      |
| TINYBLOB   | 0-255 bytes           | 不超过 255 个字符的二进制字符串 |
| TINYTEXT   | 0-255 bytes           | 短文本字符串                    |
| BLOB       | 0-65 535 bytes        | 二进制形式的长文本数据          |
| TEXT       | 0-65 535 bytes        | 长文本数据                      |
| MEDIUMBLOB | 0-16 777 215 bytes    | 二进制形式的中等长度文本数据    |
| MEDIUMTEXT | 0-16 777 215 bytes    | 中等长度文本数据                |
| LONGBLOB   | 0-4 294 967 295 bytes | 二进制形式的极大文本数据        |
| LONGTEXT   | 0-4 294 967 295 bytes | 极大文本数据                    |





# MySQL的基本操作

## 一、连接MySQL数据库

Ubuntu终端下使用以下命令连接MySQL数据库：

**MYSQL -U USER_NAME -P**

```sql
mysql -u root -p
```

回车后输入密码即可。



## 二、创建MySQL数据库

使用root账号登陆，即拥有最高权限，即可使用以下命令创建新的MySQL数据库：

**CREATE DATABASE DB_NAME：**

```sql
create database db_name;
```

**MYSQLADMIN命令：**

```sql
mysql admin -u root -p create db_name
```

回车输入密码后即创建一个新的数据库db_name。



## 三、删除MySQL数据库

**DROP DATABASE DB_NAME：**

```sql
drop database db_name;
```

**MYSQLADMIN命令：**

```sql
mysqladmin -u root -p drop db_name;
```

执行以上删除数据库命令后，会出现一个提示框，来确认是否真的删除数据库。



## 四、选择MySQL数据库

**USE DB_NAME**

```sql
use db_name;
```



## 五、创建数据表

创建MySQL数据表需要以下信息：

- 表名
- 表字段名
- 定义每个表字段

创建MySQL数据表的SQL通用语法：

**CREATE TABLE TB_NAME (COLUMN_NAME COLUMN_TYPE);**

```sql
create table tb_name (column_name column_type);
```

如果你不想字段为 NULL，可以设置字段的属性为 NOT NULL， 在操作数据库时如果输入该字段的数据为NULL ，就会报错。如：

```
create table tb_name (column_nmae column_type not null);
```



## 六、删除数据表

**DROP TABLE TB_NAME：**

```sql
drop table tb_name;
```



## 七、插入数据

**INSERT INTO：**

```sql
insert into tb_name(column1,column2,..columnN) values(value1,value2,...valueN);
```

如果数据是字符型，必须使用单引号或者双引号，如："value"。



## 八、查询数据

**SELECT：**

```sql
select column_name from tb_name;
```

查询语句中可以使用一个或者多个表，表之间使用逗号(,)分割。

```
select column_name from tb1,tb2,...tbN;
```

SELECT 命令可以读取一条或者多条记录。

可以使用星号（*）来代替其他字段，SELECT语句会返回表的所有字段数据。

**WHERE子句**

如需有条件地从表中选取数据，可将 WHERE 子句添加到 SELECT 语句中。

可以在 WHERE 子句中指定任何条件，可以使用 AND 或者 OR 指定一个或多个条件。

WHERE 子句类似于程序语言中的 if 条件，根据 MySQL 表中的字段值来读取指定的数据。

```sql
select column——name from tb_name where condition1 and condition2;
```

常用操作符：

| 等于 | 不等于 | 大于 | 小于 | 大于等于 | 小于等于 |
| :--: | :----: | :--: | ---- | :------: | :------: |
|  =   | <>或!= |  >   | <    |    >=    |    <=    |



## 九、UPDATE更新

如果需要修改或更新 MySQL 中的数据，可以使用 **SQL UPDATE** 命令来操作。

```sql
update tb_name set column=new_vlue;
```

可选 **WHERE** 子句指定条件。



## 十、DELETE语句

如果需要删除 MySQL 数据表中的记录，可以使用 SQL 的 **DELETE** 命令来操作。

```sql
delete from tb_name [where condition];
```

可选 **WHERE** 子句指定条件。

如果没有指定 WHERE 子句，MySQL 表中的所有记录将被删除。



## 十一、LIKE子句

**WHERE** 子句中可以使用等号 **=** 来设定获取数据的条件。

当需要获取一列中所有含有某些字符的所有记录时，就需要在 WHERE 子句中使用 **LIKE** 子句。

 LIKE 子句中使用百分号 **%**字符来表示任意字符。

从表 tb_name 中获取所有 column_name 中含有 x 的记录：

```sql
select * from tb_name where column_name like '%x';
```



## 十二、UNION操作符

**UNION** 操作符用于连接两个以上的 **SELECT** 语句的结果组合到一个结果集合中。

多个 SELECT 语句会删除重复的数据。

```
select * from tb_name1 union [all | distinc] select * from tb_name2;
```

union中的两个参数：all | distinct

all：返回所有结果集，包含重复数据。

distinct：删除结果集中重复的数据。（默认）



## 十三、MySQL排序

如果需要对读取的数据进行排序，就可以使用 MySQL 的 **ORDER BY** 子句来设定想按哪个字段哪种方式来进行排序，再返回搜索结果。

按照表tb_name中的column字段进行排序：

```
select * from tb_name order by column [asc | desc]
```

order by子句的可选参数：asc(升序) | desc(降序)    默认asc。



## 十四、MySQL分组

**GROUP BY：**

**GROUP BY** 语句根据一个或多个列对结果集进行分组。

在分组的列上我们可以使用 COUNT, SUM, AVG,等函数。

```sql
select column_name, operate(column_name) from tb_name group by column_name;
```

operate指 **COIUNT**、**SUM**、**AVG** 等操作。

**WITH ROLLUP**

**WITH ROLLUP** 可以实现在分组统计数据基础上再进行相同的统计（SUM,AVG,COUNT…）。

```sql
select column_name from tb_name group by column_name with rollup;
```

可以使用 coalesce 来设置一个可以取代 NUll 的名称，coalesce 语法：

```sql
sqselect coalesce(a,b,c);
```

参数说明：如果a==null,则选择b；如果b==null,则选择c；如果a!=null,则选择a；如果a b c 都为null ，则返回为null（没有意义）。





# MySQL 连接的使用*

----> 使用 MySQL 的 JOIN 在两个或多个表中查询数据。

可以在 SELECT, UPDATE 和 DELETE 语句中使用 Mysql 的 JOIN 来联合多表查询。

**JOIN** 按照功能大致分为如下三类：

- **INNER JOIN（内连接,或等值连接）**：获取两个表中字段匹配关系的记录。
- **LEFT JOIN（左连接）：**获取左表所有记录，即使右表没有对应匹配的记录。
- **RIGHT JOIN（右连接）：** 与 LEFT JOIN 相反，用于获取右表所有记录，即使左表没有对应匹配的记录。

假设 DB_NAME 数据库中有两张表 tcount_tbl 和 runoob_tbl，其数据如下：

```
mysql> SELECT * FROM tcount_tbl;
+---------------+--------------+
| runoob_author | runoob_count |
+---------------+--------------+
| 菜鸟教程        | 10           |
| RUNOOB.COM    | 20           |
| Google        | 22           |
+---------------+--------------+
3 rows in set (0.01 sec)

mysql> SELECT * from runoob_tbl;
+-----------+---------------+---------------+-----------------+
| runoob_id | runoob_title  | runoob_author | submission_date |
+-----------+---------------+---------------+-----------------+
| 1         | 学习 PHP       | 菜鸟教程        | 2017-04-12     |
| 2         | 学习 MySQL     | 菜鸟教程        | 2017-04-12     |
| 3         | 学习 Java      | RUNOOB.COM    | 2015-05-01      |
| 4         | 学习 Python    | RUNOOB.COM    | 2016-03-06      |
| 5         | 学习 C         | FK            | 2017-04-05      |
+-----------+---------------+---------------+-----------------+
5 rows in set (0.01 sec)
```

### INNER JOIN

使用 **INNER JOIN** 来连接以上两张表来读取 runoob_tbl 表中所有 runoob_author 字段在 tcount_tbl 表对应的 runoob_count 字段值：

```sql
SELECT a.runoob_id, a.runoob_author, b.runoob_count FROM runoob_tbl a INNER JOIN tcount_tbl b ON a.runoob_author = b.runoob_author;
```

以上 SQL 语句等价于：

```sql
SELECT a.runoob_id, a.runoob_author, b.runoob_count FROM runoob_tbl a, tcount_tbl b WHERE a.runoob_author = b.runoob_author;
```



### LEFT JOIN

**LEFT JOIN** 与 **JOIN** 有所不同。**LEFT JOIN** 会读取左边数据表的全部数据，即便右边表无对应数据。

以 **runoob_tbl** 为左表，**tcount_tbl** 为右表:

```sql
mysql> SELECT a.runoob_id, a.runoob_author, b.runoob_count FROM runoob_tbl a LEFT JOIN tcount_tbl b ON a.runoob_author = b.runoob_author;
```

以上实例中使用了 LEFT JOIN，该语句会读取左边的数据表 runoob_tbl 的所有选取的字段数据，即便在右侧表 tcount_tbl中 没有对应的 runoob_author 字段值。



### RIGHT JOIN

RIGHT JOIN 会读取右边数据表的全部数据，即便左边边表无对应数据。

以 **runoob_tbl** 为左表，**tcount_tbl** 为右表:

```sql
SELECT a.runoob_id, a.runoob_author, b.runoob_count FROM runoob_tbl a RIGHT JOIN tcount_tbl b ON a.runoob_author = b.runoob_author;
```

以上实例中使用了 RIGHT JOIN，该语句会读取右边的数据表 tcount_tbl 的所有选取的字段数据，即便在左侧表 runoob_tbl 中没有对应的runoob_author 字段值。



# MySQL NULL值处理

MySQL 使用 **SELECT** 命令及 **WHERE** 子句来读取数据表中的数据,但是当提供的查询条件字段为 **NULL** 时，该命令可能就无法正常工作。

为了处理这种情况，MySQL提供了三大运算符:

- **IS NULL:** 当列的值是 NULL,返回 true。
- **IS NOT NULL:** 当列的值不为 NULL, 返回 true。
- **<=>:** 比较操作符，当比较的的两个值相等或者都为 NULL 时返回 true。（区别于 **=** ）

几点注意：

1、不能使用 = NULL 或 != NULL 在列中查找 NULL 值 。

2、在 MySQL 中，NULL 值与任何其它值的比较永远返回 NULL。

3、MySQL 中处理 NULL 使用 IS NULL 和 IS NOT NULL 运算符。

假设表 tb_name 中有两列字段，其中一列字段含有 NULL 值，执行以下命令：

```sql
select * from tb_name where column_name=NULL;
select * from tb_name where column_name!=NULL;
```

两条语句均没有返回值，说明 **=** 和 **!=** 不起作用。

查找表中某字段是否为 NULL 必须使用 **IS NULL** 和 **IS NOT NULL** 语句。

```sql
select * from tb_name where column_name IS NULL;
select * from tb_name where column_name IS NOT NULL;
```





# MySQL中的正则表达式*

下表中的正则模式可应用于 **REGEXP** 操作符中。

| 模式       | 描述                                                         |
| :--------- | :----------------------------------------------------------- |
| ^          | 匹配输入字符串的开始位置。如果设置了 RegExp 对象的 Multiline 属性，^ 也匹配 '\n' 或 '\r' 之后的位置。 |
| $          | 匹配输入字符串的结束位置。如果设置了RegExp 对象的 Multiline 属性，$ 也匹配 '\n' 或 '\r' 之前的位置。 |
| .          | 匹配除 "\n" 之外的任何单个字符。要匹配包括 '\n' 在内的任何字符，请使用像 '[.\n]' 的模式。 |
| [...]      | 字符集合。匹配所包含的任意一个字符。例如， '[abc]' 可以匹配 "plain" 中的 'a'。 |
| [^...]     | 负值字符集合。匹配未包含的任意字符。例如， '[^abc]' 可以匹配 "plain" 中的'p'。 |
| p1\|p2\|p3 | 匹配 p1 或 p2 或 p3。例如，'z\|food' 能匹配 "z" 或 "food"。'(z\|f)ood' 则匹配 "zood" 或 "food"。 |
| *          | 匹配前面的子表达式零次或多次。例如，zo* 能匹配 "z" 以及 "zoo"。* 等价于{0,}。 |
| +          | 匹配前面的子表达式一次或多次。例如，'zo+' 能匹配 "zo" 以及 "zoo"，但不能匹配 "z"。+ 等价于 {1,}。 |
| {n}        | n 是一个非负整数。匹配确定的 n 次。例如，'o{2}' 不能匹配 "Bob" 中的 'o'，但是能匹配 "food" 中的两个 o。 |
| {n,m}      | m 和 n 均为非负整数，其中n <= m。最少匹配 n 次且最多匹配 m 次。 |

一些MySQL正则表达式的实例：

查找name字段中以'st'为开头的所有数据：

```sql
SELECT name FROM person_tbl WHERE name REGEXP '^st';
```

查找name字段中以'ok'为结尾的所有数据：

```sql
SELECT name FROM person_tbl WHERE name REGEXP 'ok$';
```

查找name字段中包含'mar'字符串的所有数据：

```sql
SELECT name FROM person_tbl WHERE name REGEXP 'mar';
```

查找name字段中以元音字符开头或以'ok'字符串结尾的所有数据：

```sql
SELECT name FROM person_tbl WHERE name REGEXP '^[aeiou]|ok$';
```





# MySQL 事务

MySQL 事务主要用于处理操作量大，复杂度高的数据。

- 在 MySQL 中只有使用了 Innodb 数据库引擎的数据库或表才支持事务。
- 事务处理可以用来维护数据库的完整性，保证成批的 SQL 语句要么全部执行，要么全部不执行。
- 事务用来管理 **insert **, **update**, **delete** 语句。
- 一个完整的业务需要批量的DML(insert、update、delete)语句共同联合完成。

一般来说，事务是必须满足4个条件：原子性、一致性、隔离性、持久性。

- **原子性：**一个事务中的所有操作，要么全部完成，要么全部不完成，不会结束在中间某个环节。事务在执行过程中发生错误，会被回滚到事务开始前的状态，就像这个事务从来没有执行过一样。
- **一致性：**在事务开始之前和事务结束以后，数据库的完整性没有被破坏。这表示写入的资料必须完全符合所有的预设规则，这包含资料的精确度、串联性以及后续数据库可以自发性地完成预定的工作。
- **隔离性：**数据库允许多个并发事务同时对其数据进行读写和修改的能力，隔离性可以防止多个事务并发执行时由于交叉执行而导致数据的不一致。事务隔离分为不同级别，包括读未提交、读提交、可重复读和串行化。
- **持久性：**事务处理结束后，对数据的修改就是永久的，即便系统故障也不会丢失。

关于事务的一些术语

- 开启事务：Start Transaction
- 事务结束：End Transaction
- 提交事务*：Commit Transaction
- 回滚事务*：Rollback Transaction

**MYSQL 事务处理主要有两种方法：**

1、用 BEGIN, ROLLBACK, COMMIT来实现

- **BEGIN** 开始一个事务
- **ROLLBACK** 事务回滚
- **COMMIT** 事务确认

2、直接用 SET 来改变 MySQL 的自动提交模式:

- **SET AUTOCOMMIT=0** 禁止自动提交
- **SET AUTOCOMMIT=1** 开启自动提交



# MySQL ALTER命令

当需要修改数据表名或者修改数据表字段时，就需要使用到 **ALTER** 命令。

### 一、删除，添加或修改表字段

使用 **ALTER** 命令及 **DROP** 子句来删除表中的 column_name 字段：

```sql
alter table tb_name drop column_name;
```

注：如果数据表中只剩余一个字段则无法使用DROP来删除字段。

MySQL 中使用 ADD 子句来向数据表中添加列。

使用 **ALTER** 命令及 **ADD** 子句向表 tb_name 中添加 column_name 字段。

```sql
alter table tb_name add column_name column_type;
```

执行以上命令后，column_name 字段会自动添加到数据表字段的末尾。

注：记得加上字段类型 column_type。

使用 **FIRST、AFTER** 关键字来确定插入字段的位置。

```sql
alter table tb_name add column_name column_type first;	//把新增的字段设为第一列
alter table tb_name add column_name column_type after x;	//把新增的字段放在字段x后
```

注：使用 **SHOW COLUMNS** 可以查看表结构的变化。

### 二、修改字段类型及名称

如果要修改字段类型及名称, 可以在ALTER命令中使用 **MODIFY** 或 **CHANGE** 子句 。

1、使用 **MODIFY** 子句修改字段 column_name 的类型：从char(0)改为char(10)：

```sql
alter table tb_name modify column_name char(10);
```

2、使用 **CHANGE** 子句修改字段 column_name 的名字及类型：

```sql
alter tbale tb_name change column_name1 column_name2 column_newtype;
```

### 三、ALTER TABLE 对 Null 值和默认值的影响

当修改字段时，可以指定该字段是否包含值或者是否设置默认值。

指定字段 column_name 为 NOT NULL 且默认值为100:

```sql
alter table tb_name modify column_name column_type NOT NULL defaule 100;
```

修改字段 column_name 的默认值为1000：

```sql
alter table tb_name alter column_name set default 1000;
```

使用 ALTER 命令及 DROP子句来删除字段 column_name 的默认值：

```sql
alter table tb_name alter column_name drop default;
```

使用 ALTER 命令及 TYPE 子句来修改数据表类型：

```sql
alter table tb_name engine=tb_type;
```

注：查看数据表类型可以使用 SHOW TABLE STATUS 语句。

### 四、修改表名

如果要修改字段类型及名称, 可以在ALTER命令中使用 **RENAME** 子句 。

将表 tb_name0 的名字改为 tb_name1：

```sql
alter table tb_name1 rename to tb_name1;
```





# MySQL 索引



# MySQL 临时表



# MySQL 复制表



# MySQL 元数据



# MySQL 序列使用



# MySQL 处理重复数据



# MySQL及SQL注入



# MySQL 导出数据



# MySQL 导入数据



# MySQL 函数



# MySQL 运算符

