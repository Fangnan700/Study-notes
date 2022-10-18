# 0x00 PHP简介

## 0.1 什么是 PHP？

- PHP 是 "PHP Hypertext Preprocessor" 的首字母缩略词
- PHP 是一种被广泛使用的开源脚本语言



## 0.2 什么是 PHP 文件？

- PHP 文件能够包含文本、HTML、CSS 以及 PHP 代码
- PHP 代码在服务器上执行，而结果以纯文本返回浏览器
- PHP 文件的后缀是 ".php"



## 0.3 PHP 能够做什么？

- PHP 能够生成动态页面内容
- PHP 能够创建、打开、读取、写入、删除以及关闭服务器上的文件
- PHP 能够接收表单数据
- PHP 能够发送并取回 cookies
- PHP 能够添加、删除、修改数据库中的数据
- PHP 能够限制用户访问网站中的某些页面
- PHP 能够对数据进行加密





# 0x01 PHP基础语法

## 1.1 基本结构

PHP 脚本以 \<?php 开头，以 ?> 结尾：

```php
<?php
	//php代码
?>
```

PHP 文件的默认文件扩展名是 ".php"；PHP 文件通常包含 HTML 标签以及一些 PHP 脚本代码。

第一个PHP程序：index.php

```php
<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
</head>
<body>
    <?php
        echo "Hello World!";
    ?>
</body>
</html>
```



## 1.2 注释

PHP支持3种注释方式：

```php
<!DOCTYPE html>
<html>
<body>

<?php
// 这是单行注释

# 这也是单行注释

/*
这是多行注释块
它横跨了
多行
*/
?>

</body>
</html>
```



## 1.3 大小写敏感

PHP中的类、函数和关键字都对大小写不敏感，但变量名对大小写敏感。



## 1.4 变量

变量可以理解成一个容器，用于装载数据。

PHP中的变量名必须以美元符（$）开头，如：

```php
<?php
	$a = 1;
	$b = 'a';    
?>
```

**PHP变量的命名规则**

- 变量以 $ 符号开头，其后是变量的名称
- 变量名称必须以字母或下划线开头
- 变量名称不能以数字开头
- 变量名称只能包含字母数字字符和下划线（A-z、0-9 以及 _）
- 变量名称对大小写敏感（\$y 与 $Y 是两个不同的变量）



**弱类型语言**

PHP是一种弱类型语言，在声明变量时不用定义变量的类型，PHP会根据数据类型自动调整变量的类型，即在程序运行过程中，一个变量的类型不是固定不变的。



**变量作用域**

在PHP中，可以在脚本的任意位置声明变量，根据声明位置的不同，PHP变量拥有不同的作用域：

- local（局部）
- global（全局）
- static（静态）



## 1.5 常量

常量是单个值的标识符（名称），在脚本中无法改变该值。

有效的常量名以字符或下划线开头（常量名称前面没有 $ 符号）。

注意：与变量不同，常量贯穿整个脚本是自动全局的。

**声明常量**

- define(常量名称,  常量值);
- const 常量名 = 常量值;











## 1.6 echo和print语句

echo 和 print 之间的差异：

- echo - 能够输出一个以上的字符串
- print - 只能输出一个字符串，并始终返回 1

**提示：**echo 比 print 稍快，因为它不返回任何值。

**使用实例：**

```php
<?php
	echo "Hello World!";
	print 2 + 4;
?>
```



# 0x02 数据类型

PHP的数据类型有：

字符串、整数、浮点数、逻辑、数组、对象、NULL

使用 PHP var_dump() 函数会返回变量的数据类型和值：

```php
<?php
$a = 12;
$b = 2.1;
$c = 'A';
$d = "hello";
$e = true;
$f = null;
$g = array(1, 2, 3);
var_dump($a, $b, $c, $d, $e, $f, $g);
```



## 2.1 PHP字符串

字符串是字符序列，使用单引号或双引号包裹：

```php
<?php 
    $x = "Hello world!";
    echo $x;
?>
```

### 2.1.1 PHP字符串的常用函数

**1、strlen() 函数：strlen() 函数返回字符串的长度，以字符计**

```php
<?php 
    $x = "Hello world!";
    echo strlen($x);	//12
?>
```

**2、str_word_count() 函数：用于对字符串中的单词进行计数**

```php
<?php 
    $x = "Hello world!";
    echo str_word_count($x);	//2
?>
```

**3、strrev() 函数：用于反转字符串**

```php
<?php 
    $x = "Hello world!";
    echo strrev($x);	//!dlrow olleH
?>
```

**4、strpos() 函数：用于检索字符串内指定的字符或文本**

如果找到匹配，会返回首个匹配的字符位置；如果未找到匹配，则返回 FALSE。

```php
<?php 
    $x = "Hello world!";
    echo strpos($x, "world");	//6
	echo strpos($x, "zzz");		//
?>
```

**5、str_replace() 函数：用一些字符串替换字符串中的指定字符**

```php
<?php 
    $x = "Hello world!";
    echo str_replace("world", "kitty", $x);	  //Hello kitty!
?>
```







## 2.2 PHP整数

整数是没有小数的数字。

整数规则：

- 整数必须有至少一个数字（0-9）
- 整数不能包含逗号或空格
- 整数不能有小数点
- 整数正负均可
- 可以用三种格式规定整数：十进制、十六进制（前缀是 0x）或八进制（前缀是 0）



## 2.3 PHP 浮点数

浮点数是有小数点或指数形式的数字。



## 2.4 PHP 逻辑

逻辑是 true 或 false。



## 2.5 PHP 数组

数组在一个变量中存储多个值。

在 PHP 中，有三种数组类型：

- *索引数组* - 带有数字索引的数组
- *关联数组* - 带有指定键的数组
- *多维数组* - 包含一个或多个数组的数组



### 2.5.1 索引数组

在索引数组中，通过索引（下标）访问数组元素。

创建索引数组有两种方式：

- 自动分配索引（从0开始）

  ```php
  $arr_1 = array('张三', '李四', '王五');
  ```

- 手动分配索引（不一定从0开始）

  ```php
  $arr_2 = array();
  $arr_2[1] = 'A';
  $arr_2[2] = 'B';
  $arr_2[3] = 'C';
  ```

**获取数组长度（元素个数）**

使用count()函数可以获取数组的长度，即元素个数：

```php
$arr_1 = array('张三', '李四', '王五');
echo count($arr_1);		//3
```



### 2.5.2 关联数组

关联数组中不使用下标来标记元素，而是使用键值对的方式存储数据。

**创建关联数组**

```php
$usrAge=array("Bill"=>"35","Steve"=>"37","Elon"=>"43");
```

或：

```php
$usrAge = array();
$usrAge['Bill']="63";
$usrAge['Steve']="56";
$usrAge['Elon']="47";
```

**遍历关联数组**

```php
$usrAge=array("Bill"=>"35","Steve"=>"37","Elon"=>"43");
//使用foreach语句遍历关联数组
foreach ($usrAge as $usr=>$age) {
    echo $usr."'s age is ".$age."\n";
}
```



### 2.5.1 数组排序函数

PHP内置了多个针对数组的排序函数：

- sort() - 以升序对数组排序
- rsort() - 以降序对数组排序
- asort() - 根据值，以升序对关联数组进行排序
- ksort() - 根据键，以升序对关联数组进行排序
- arsort() - 根据值，以降序对关联数组进行排序
- krsort() - 根据键，以降序对关联数组进行排序



## 2.6 PHP 对象

对象是存储数据和有关如何处理数据的信息的数据类型。

创建对象前，必须先使用class关键字定义对象所属的类，类中包含成员变量（属性）和成员方法（行为）。



## 2.7 PHP NULL 值

特殊的 NULL 值表示变量无值。NULL 是数据类型 NULL 唯一可能的值。

NULL 值标示变量是否为空。也用于区分空字符串与空值数据库。

可以通过把值设置为 NULL，将变量清空。





# 0x03 运算符

**赋值运算符**

PHP 中基础的赋值运算符是 "="。这意味着右侧赋值表达式会为左侧运算数设置值。

PHP中还有组合的赋值运算符：

- +=：a += b  <=>  a = a + b
- -=： a -= b  <=>  a = a - b
- *=： a *= b <=>  a = a * b
- /=： a /= b  <=>  a = a / b
- %=： a %= b  <=>  a = a % b



**算数运算符**

- +：加法
- -：减法
- *：乘法
- /：除法
- %：取模



**字符串运算符**

- . ：连接字符串
- .= ：连接并赋值



**递增/递减运算符**

- ++：递增
- --：递减

两种用法：

- $a++：变量a使用后再递增
- ++$a：变量a先递增后使用
- $b--：变量b使用后再递减
- --$b：变量b先递减后使用



**比较运算符**

| 运算符  | 名称       | 描述                                           | 实例               |
| :------ | :--------- | :--------------------------------------------- | :----------------- |
| x == y  | 等于       | 如果 x 等于 y，则返回 true                     | 5==8 返回 false    |
| x === y | 绝对等于   | 如果 x 等于 y，且它们类型相同，则返回 true     | 5==="5" 返回 false |
| x != y  | 不等于     | 如果 x 不等于 y，则返回 true                   | 5!=8 返回 true     |
| x <> y  | 不等于     | 如果 x 不等于 y，则返回 true                   | 5<>8 返回 true     |
| x !== y | 不绝对等于 | 如果 x 不等于 y，或它们类型不相同，则返回 true | 5!=="5" 返回 true  |
| x > y   | 大于       | 如果 x 大于 y，则返回 true                     | 5>8 返回 false     |
| x < y   | 小于       | 如果 x 小于 y，则返回 true                     | 5<8 返回 true      |
| x >= y  | 大于等于   | 如果 x 大于或者等于 y，则返回 true             | 5>=8 返回 false    |
| x <= y  | 小于等于   | 如果 x 小于或者等于 y，则返回 true             | 5<=8 返回 true     |



**逻辑运算符**

| 运算符   | 名称 | 描述                                         | 实例                                 |
| :------- | :--- | :------------------------------------------- | :----------------------------------- |
| x and y  | 与   | 如果 x 和 y 都为 true，则返回 true           | x=6 y=3 (x < 10 and y > 1) 返回 true |
| x or y   | 或   | 如果 x 和 y 至少有一个为 true，则返回 true   | x=6 y=3 (x==6 or y==5) 返回 true     |
| x xor y  | 异或 | 如果 x 和 y 有且仅有一个为 true，则返回 true | x=6 y=3 (x==6 xor y==3) 返回 false   |
| x && y   | 与   | 如果 x 和 y 都为 true，则返回 true           | x=6 y=3 (x < 10 && y > 1) 返回 true  |
| x \|\| y | 或   | 如果 x 和 y 至少有一个为 true，则返回 true   | x=6 y=3 (x==5 \|\| y==5) 返回 false  |
| ! x      | 非   | 如果 x 不为 true，则返回 true                | x=6 y=3 !(x==y) 返回 true            |



**数组运算符**

| 运算符  | 名称   | 描述                                                         |
| :------ | :----- | :----------------------------------------------------------- |
| x + y   | 集合   | x 和 y 的集合                                                |
| x == y  | 相等   | 如果 x 和 y 具有相同的键/值对，则返回 true                   |
| x === y | 恒等   | 如果 x 和 y 具有相同的键/值对，且顺序相同类型相同，则返回 true |
| x != y  | 不相等 | 如果 x 不等于 y，则返回 true                                 |
| x <> y  | 不相等 | 如果 x 不等于 y，则返回 true                                 |
| x !== y | 不恒等 | 如果 x 不等于 y，则返回 true                                 |



**三元运算符**

语法格式：

```php
(expr1) ? (expr2) : (expr3) 
```

运算结果：对 expr1 求值为 TRUE 时的值为 expr2，在 expr1 求值为 FALSE 时的值为 expr3。



# 0x04 三大结构

## 4.1 顺序结构

PHP和其它编程语言一样，程序按照代码的先后顺序逐行执行，称为程序的顺序结构，如：

```php
<?php
echo "这是第1行代码\n";
echo "这是第2行代码\n";
echo "这是第3行代码\n";
echo "这是第4行代码\n";
echo "这是第5行代码\n";
```

运行结果：

![image-20221014194325560](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014194325560.png)



## 4.2 选择结构

选择结构通过判断某些特定条件是否满足来决定下一步的执行流程。

常见的有单分支选择结构、双分支选择结构、多分支选择结构以及嵌套的分支结构。



### 4.2.1 if语句

if 语句用于在指定条件为 true 时执行代码：

```php
<?php
$a = 1;
$b = 2;
if($a < $b) {
    echo "a小于b";
}
```



### 4.2.2 if...else 语句

if....else 语句在条件为 true 时执行代码，在条件为 false 时执行另一段代码：

```php
<?php
$a = 1;
$b = 2;
if($a < $b) {
    echo "a小于b";
} else {
    echo "a大于等于b";
}
```



### 4.2.3 if...elseif....else 语句

if....elseif...else 语句来根据两个以上的条件执行不同的代码：

```php
<?php
$a = 1;
$b = 2;
if($a < $b) {
    echo "a小于b";
} else if($a > $b){
    echo "a大于b";
} else {
    echo "a等于b";
}
```



### 4.2.4 switch...case 语句

switch...case 语句可以有选择地执行若干代码块之一，避免冗长的 if..elseif..else 代码块：

```php
<?php
$favfruit="orange";

switch ($favfruit) {
   case "apple":
     echo "Your favorite fruit is apple!";
     break;
   case "banana":
     echo "Your favorite fruit is banana!";
     break;
   case "orange":
     echo "Your favorite fruit is orange!";
     break;
   default:
     echo "Your favorite fruit is neither apple, banana, or orange!";
}
```

每一项执行结束之后都应该加上break语句，否则回导致程序继续执行下面的代码。



## 4.3 循环结构

循环结构是指在程序中需要反复执行某个功能而设置的一种程序结构。 它由循环体中的条件，判断继续执行某个功能还是退出循环。



### 4.3.1 while 循环

只要指定的条件为真，while 循环就会执行代码块：

```php
<?php
$i = 1;
$sum = 0;
while($i <= 100) {
    $sum += $i;
    $i++;
}
echo "1~100的和为:".$sum;
```

![image-20221014195556351](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014195556351.png)



### 4.3.2 do...while 循环

do...while 循环首先会执行一次代码块，然后检查条件，如果指定条件为真，则重复循环。

```php
<?php
$i = 1;
do {
    echo $i.',';
    $i++;
}while($i <= 10);
```

![image-20221014195746459](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014195746459.png)



### 4.3.3 for 循环

如果已经提前确定脚本运行的次数，可以使用 for 循环：

```php
<?php 
for ($x=0; $x<=10; $x++) {
  echo "数字是：$x <br>";
} 
```

![image-20221014200554360](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014200554360.png)



### 4.3.4 foreach 循环

foreach 循环只适用于数组，用于遍历数组中的每个键/值对：

```php
<?php
$array = array('red', 'orange', 'yellow', 'green');
foreach ($array as $val) {
    echo $val.',';
}
```

![image-20221014200845284](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014200845284.png)





# 0x05 函数

## 5.1 PHP常用内置函数

PHP为我们提供了非常丰富的内置函数，用来实现不同的功能，按功能分类如下：

### 5.1.1 数学函数

1.abs(): 求绝对值

```php
$abs = abs(-4.2);	//4.2
```



2.ceil(): 向上取整

```php
echo ceil(9.999); 	// 10
```



3.floor(): 向下取整

```php
echo floor(9.999);  // 9
```


4.fmod(): 浮点数取余

```php
$x = 5.7;
$y = 1.3;
echo fmod($x, $y);
```

5.pow(): 返回数的n次方

```php
echo pow(-1, 20);	//1
```

6.round(): 浮点数四舍五入

```php
echo round(1.95583, 2); 	// 1.96, 保留小数点后2位
```

7.sqrt(): 求平方根

```php
echo sqrt(9);	 //3
```

8.max(): 求最大值

```php
echo max(1, 3, 5, 6, 7); 	// 7
echo max(array(2, 4, 5)); 	// 5
```

9.min(): 求最小值

```php
echo min(1, 3, 5, 6, 7);	 // 1
echo min(array(2, 4, 5)); 	// 2
```



10.mt_rand(): 更好的随机数

```php
echo mt_rand(0,9);	//n
```


11.rand(): 随机数

```php
echo rand(0,9);		//n
```



12.pi(): 获取圆周率值

```php
echo pi();	//3.1415926535898
```





### 5.1.2 字符串函数

**去空格或或其他字符：**

13.trim(): 删除字符串两端的空格或其他预定义字符

```php
$str = "\r\nHello World!\r\n";
echo trim($str);
```


14.rtrim(): 删除字符串右边的空格或其他预定义字符

```php
$str = "Hello World!\n\n";
echo rtrim($str);
```


15.chop(): rtrim()的别名



16.ltrim(): 删除字符串左边的空格或其他预定义字符

```php
$str = "\r\nHello World!";
echo ltrim($str);
```

17.dirname(): 返回路径中的目录部分

```php
echo dirname("c:/testweb/home.php");  //c:/testweb
```


**字符串生成与转化：**

18.str_pad(): 把字符串填充为指定的长度

```php
$str = "Hello World";
echo str_pad($str,20,".");	//Hello World.........
```


19.str_repeat(): 重复使用指定字符串

```php
echo str_repeat(".", 13);	 //.............
```


20.str_split(): 把字符串分割到数组中

```php
print_r(str_split("Hello"));
```

![image-20221014204941128](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014204941128.png)



21.strrev(): 反转字符串

```php
echo strrev("Hello World!"); // !dlroW olleH
```



22.wordwrap(): 按照指定长度对字符串进行折行处理

```php
$str = "An example on a long word is: Supercalifragulistic";
echo wordwrap($str,15);
```
![image-20221014205037863](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014205037863.png)



23.str_shuffle(): 随机地打乱字符串中所有字符

```php
echo str_shuffle("Hello World");
```


24.parse_str(): 将字符串解析成变量

```php
parse_str("id=23&name=John%20Adams", $myArray);
print_r($myArray);
```
![image-20221014205245067](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014205245067.png)



25.number_format(): 通过千位分组来格式化数字



### 5.1.3 大小写转换

26.strtolower(): 字符串转为小写

```php
echo strtolower("Hello WORLD!");	//hello world!
```


27.strtoupper(): 字符串转为大写

```php
echo strtoupper("Hello WORLD!");	//HELLO WORLD!
```


28.ucfirst(): 字符串首字母大写

```php
echo ucfirst("hello world"); //　Hello world
```

29.ucwords(): 字符串每个单词首字符转为大写

```php
echo ucwords("hello world"); //　Hello World
```




## 5.2 用户定义函数

函数是可以在程序中重复使用的语句块。

页面加载时函数不会立即执行；函数只有在被调用时才会执行。

```php
/*
	基本格式：
	function 函数名(形参列表) [返回值类型] {
		函数体;
		[return 返回值];
	}
*/

<?php
//声明函数
function add($a, $b) {
    $c = $a + $b;
    return $c;
}
//调用函数
$sum = add(1, 2);
echo $sum;
```







# 0x06 超全局变量

PHP 中的许多预定义变量都是“超全局的”，这意味着它们在一个脚本的全部作用域中都可用。

PHP 中的超全局变量有：

- $GLOBALS
- $_SERVER
- $_REQUEST
- $_POST
- $_GET
- $_FILES
- $_ENV
- $_COOKIE
- $_SESSION



## 6.1 $GLOBALS

\$GLOBALS 全局变量用于在 PHP 脚本中的任意位置访问全局变量，PHP在名为 $GLOBALS[index] 的数组中存储了所有全局变量，变量的名字就是数组的键，这样通过在 \$GLOBAL 内以键值对的方式，就能访问任意变量。

使用实例如下：

```php
<?php
$x = 56;
$y = 72;

function add(): void{
    $GLOBALS['z'] = $GLOBALS['x'] + $GLOBALS['y'];
}

add();
echo $GLOBALS['z'];
```



## 6.2 $_SERVER

$_SERVER 超全局变量保存关于报头、路径和脚本位置的信息。

**$_SERVER 中的重要信息变量**

| 元素/代码                       | 描述                                                         |
| :------------------------------ | :----------------------------------------------------------- |
| $_SERVER['PHP_SELF']            | 返回当前执行脚本的文件名。                                   |
| $_SERVER['GATEWAY_INTERFACE']   | 返回服务器使用的 CGI 规范的版本。                            |
| $_SERVER['SERVER_ADDR']         | 返回当前运行脚本所在的服务器的 IP 地址。                     |
| $_SERVER['SERVER_NAME']         | 返回当前运行脚本所在的服务器的主机名（比如 www.w3school.com.cn）。 |
| $_SERVER['SERVER_SOFTWARE']     | 返回服务器标识字符串（比如 Apache/2.2.24）。                 |
| $_SERVER['SERVER_PROTOCOL']     | 返回请求页面时通信协议的名称和版本（例如，“HTTP/1.0”）。     |
| $_SERVER['REQUEST_METHOD']      | 返回访问页面使用的请求方法（例如 POST）。                    |
| $_SERVER['REQUEST_TIME']        | 返回请求开始时的时间戳（例如 1577687494）。                  |
| $_SERVER['QUERY_STRING']        | 返回查询字符串，如果是通过查询字符串访问此页面。             |
| $_SERVER['HTTP_ACCEPT']         | 返回来自当前请求的请求头。                                   |
| $_SERVER['HTTP_ACCEPT_CHARSET'] | 返回来自当前请求的 Accept_Charset 头（ 例如 utf-8,ISO-8859-1） |
| $_SERVER['HTTP_HOST']           | 返回来自当前请求的 Host 头。                                 |
| $_SERVER['HTTP_REFERER']        | 返回当前页面的完整 URL（不可靠，因为不是所有用户代理都支持）。 |
| $_SERVER['HTTPS']               | 是否通过安全 HTTP 协议查询脚本。                             |
| $_SERVER['REMOTE_ADDR']         | 返回浏览当前页面的用户的 IP 地址。                           |
| $_SERVER['REMOTE_HOST']         | 返回浏览当前页面的用户的主机名。                             |
| $_SERVER['REMOTE_PORT']         | 返回用户机器上连接到 Web 服务器所使用的端口号。              |
| $_SERVER['SCRIPT_FILENAME']     | 返回当前执行脚本的绝对路径。                                 |
| $_SERVER['SERVER_ADMIN']        | 该值指明了 Apache 服务器配置文件中的 SERVER_ADMIN 参数。     |
| $_SERVER['SERVER_PORT']         | Web 服务器使用的端口。默认值为 “80”。                        |
| $_SERVER['SERVER_SIGNATURE']    | 返回服务器版本和虚拟主机名。                                 |
| $_SERVER['PATH_TRANSLATED']     | 当前脚本所在文件系统（非文档根目录）的基本路径。             |
| $_SERVER['SCRIPT_NAME']         | 返回当前脚本的路径。                                         |
| $_SERVER['SCRIPT_URI']          | 返回当前页面的 URI。                                         |



## 6.3 $_REQUEST

$_REQUEST 用于收集 HTML 表单提交的数据。

**使用实例**

```php
<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <div>
        姓名:&nbsp<input type="text" name="usr_name">
        <input type="submit" value="确定">
    </div>
</form>

<?php
    echo $_REQUEST['usr_name'];
?>
</body>
</html>
```



## 6.4 $_POST

$_POST 广泛用于收集提交 method="post" 的 HTML 表单后的表单数据。

**使用实例：**

index.html

```php
<html>
<body>
<form method="post" action="index_form.php">
    <div>
        姓名:&nbsp<input type="text" name="usr_name">
        <input type="submit" value="确定">
    </div>
</form>

</body>
</html>
```

index_form.php

```php
<?php
echo $_POST['usr_name'];
```



## 6.5 $_GET

$_GET 可用于收集提交 HTML 表单 (method="get") 之后的表单数据：

**使用实例：**

index.html

```php
<html>
<body>
<form method="get" action="index_form.php">
    <div>
        姓名:&nbsp<input type="text" name="usr_name">
        <input type="submit" value="确定">
    </div>
</form>

</body>
</html>
```

index_form.php

```php
<?php
echo $_GET['usr_name'];
```



$_GET 也可以收集 URL 中的发送的数据：

index.html

```php
<html>
<body>
<a href="index_form.php/?usr_name=张三">测试 $GET</a>
</body>
</html>
```

index_form.php

```php
<?php
echo $_GET['usr_name'];
```



# 0x07 表单处理

**PHP 超全局变量 \$\_GET 和 \$_POST 用于收集表单数据（form-data）**

**使用实例：简单的登陆验证**

index.html：

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登陆页</title>
</head>
<body>
    <form id="usr_info_form" action="login_check.php" method="post">
    帐号:&nbsp<input type="text" name="usr_id">
    密码:&nbsp<input type="text" name="usr_pwd">
    <input type="submit" value="登陆">
    <input type="reset" value="重置">
</body>
</html>
```

iogin_check.php

```php
<?php

session_start();

if(isset($_POST["usr_id"]) && isset($_POST["usr_pwd"])) {
    $usr_id = $_POST["usr_id"];
    $usr_pwd = $_POST["usr_pwd"];
    if($usr_id === "root" && $usr_pwd === "root") {
        $_SESSION["username"] = $usr_id;
        echo "<h1 style='width: fit-content; margin-left: auto; margin-right: auto'>登陆成功～</h1>";
    } else if(isset($_SESSION["username"]) && $_SESSION["username"] === $usr_id) {
        echo "<h1 style='width: fit-content; margin-left: auto; margin-right: auto'>已经登陆过啦～</h1>";
    } else {
        echo "<h1 style='width: fit-content; margin-left: auto; margin-right: auto'>帐号/密码不对哦~</h1>";
    }
}
```





# 0x08 MySQL数据库

MySQL 是跟 PHP 配套使用的最流行的开源数据库系统，通过 PHP，可以连接和操作数据库。



## 8.1 连接MySQL数据库

PHP 5 及以上版本建议使用以下方式连接 MySQL :

- **MySQLi extension** ("i" 意为 improved)
- **PDO (PHP Data Objects)**



### 8.1.1 MySQLi-面向对象连接数据库

```php
<?php
// 设置数据库主机地址、MySQL数据库用户名、MySQL数据库密码
$servername = "localhost";
$username = "username";
$password = "password";

// 创建连接
$connect = new mysqli($servername, $username, $password);

// 检测连接
if($connect -> connect_error) {
    echo "连接失败：".$connect -> connect_error;
} else {
    echo "连接成功！";
}

//关闭连接
$conn->close();
```



## 8.2 创建数据库

### 8.2.1 MySQLi-面向对象创建数据库

```php
// 创建连接
$connect = new mysqli($servername, $username, $password);

// 检查数据库是否已经存在
try {
    $connect -> query("USE student");
    echo "数据库已经存在";
} catch (mysqli_sql_exception $e) {
    //创建数据库
    $db_name = "student";
    $create_sql = "CREATE DATABASE {$db_name}";
    if(mysqli_query($connect, $create_sql)) {
        echo "数据库创建成功\n";
    } else {
        echo "创建数据库时出错：".mysqli_error($connect);
    }
}
```





## 8.3 创建数据表

```php
<?php
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";
 
// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
    die("连接失败: " . $conn->connect_error);
} 
 
// 使用 sql 创建数据表
$sql = "CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP
)";
 
if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "创建数据表错误: " . $conn->error;
}
 
$conn->close();
```



## 8.4 新增数据



## 8.5 删除数据



## 8.6 修改数据



## 8.7 查询数据

```php
// 创建连接
try {
    $con = new mysqli($servername, $username, $password, $database);
    echo "数据库连接成功！\n";
} catch (mysqli_sql_exception $connect_e) {
    echo $connect_e -> getMessage();
}

// 读取数据库表的所有数据
$query_user_info_SQL = "SELECT * FROM usr_info";
// 将从数据库查询到的结果集合放入$query_user_info_RESULT中
$query_user_info_RESULT = $con -> query($query_user_info_SQL);

// 如果返回的结果集合长度不为0,则打印查询结果
if($query_user_info_RESULT -> num_rows > 0) {
    // 通过fetch_assoc()函数将结果集合放入到关联数组并循环输出
    while($row = $query_user_info_RESULT -> fetch_assoc()) {
        echo "ID: ".$row["usr_id"]."  Name: ".$row["usr_name"]."  Age: ".$row["usr_age"]."  Gender: ".$row["usr_gender"]."\n";
    }
}

// 关闭连接
try {
    $con -> close();
    echo "数据库已断开!\n";
} catch (mysqli_sql_exception $close_e) {
    echo $close_e -> getMessage();
}
```

















