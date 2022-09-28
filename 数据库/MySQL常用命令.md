# MySQL常用命令



## 登陆数据库服务器

```shell
mysql -u 用户名 -p
```

输入命令后按回车，之后输入MySQL用户的密码登陆。

![image-20220816143659517](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816143659517.png)



## 退出数据库服务器

```sql
exit;
```



## 查询数据库服务器中的所有数据库

```sql
show databases;
```

![image-20220816143833663](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816143833663.png)



## 切换至某个数据库

```sql
use 数据库名;
```

![image-20220816144128109](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816144128109.png)



## 查看某个数据库中的所有数据表

切换至某个数据库后：

```sql
show tables;
```

![image-20220816145838679](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816145838679.png)



## 在数据库服务器中创建数据库

```sql
create database 数据库名;
```

![image-20220816144946029](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816144946029.png)



## 在数据库中创建数据表

```sql
create table 数据表名 (字段名 字段类型);
```

![image-20220816145633815](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816145633815.png)

创建字段时，需要写出字段名和字段的数据类型；可以同时创建多个字段，不同字段之间用逗号隔开。



## 查看数据表的结构

```sql
describe 数据表名;
```

![image-20220816150002264](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816150002264.png)

其中：

- Field：字段名。
- Type：字段中的数据类型。
- Null：是否允许为空。
- Key：约束。
- Default：默认值。
- Extra：额外内容。



## 向数据表中添加数据记录

```sql
insert into 数据表名 values (数据记录);
```

![image-20220816150622447](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816150622447.png)

注意：所填写的数据记录应当和表中已有的字段数量、类型相对应。



## 删除数据表中的数据记录

```sql
delete from 数据表名 约束条件;
```

![image-20220816151919592](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816151919592.png)

在MySQL中，语句的约束条件一般使用 'where' 进行连接。



## 修改数据表中的数据记录

```sql
update 数据表名 set 字段名 = 新的数据值 约束条件;
```

![image-20220816152317010](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816152317010.png)



## 查询数据表中的数据记录

**1、查询所有数据记录**

```sql
select * from 数据表名;
```

![image-20220816150832778](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220816150832778.png)