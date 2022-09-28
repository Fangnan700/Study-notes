---
title: Java学习笔记
date: 2022-06-26 09:29:54
tags: [Java, 学习笔记]
keywords: java,学习笔记
categories:
- Java
image: 
top: 0
---

一些Java的学习笔记。

<!-- more -->





# 零、Java预备知识

## 0.1 Java程序执行原理

机器语言：由0和1组成的代码，计算机底层电路通过通电与否表示1或0

JRE (JavaRuntimeEnvironment)，Java运行环境，也就是Java平台。所有的Java 程序都要在JRE下才能运行。

JDK (Java Development Kit)，java开发工具包，是程序开发者用来编译、调试java程序用的开发工具包。

JVM (JavaVirtualMachine)，Java虚拟机，是JRE的一部分。它是一个虚构出来的计算机，是通过在实际的计算机上仿真模拟各种计算机功能来实现的。JVM有自己完善的硬件架构，如处理器、堆栈、寄存器等，还具有相应的指令系统。Java语言最重要的特点就是跨平台运行。使用JVM就是为了支持与操作系统无关，实现跨平台。

核心类库：Java封装好的程序代码，是JRE的一部分，可供程序员调用。

Java是编译型语言，先将源代码编译成.class文件，然后由JVM加载进行解释执行。



## 0.2 Java程序开发步骤

```
编写代码（.java源文件） -> 编译代码（.class字节码文件） -> 送入JVM运行代码
```

Java代码使用javac程序进行编译。

Java程序中的类名必须和文件名一致，否则报错。



## 0.3 Java跨平台工作原理

**跨平台：**一次编译，处处可用。

![image-20220625164819840](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220625164819840.png)



## 0.4 字面量

字面量，即数据在程序中的书写格式。

![image-20220625193035070](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220625193035070.png)



## 0.5 IDEA的使用

1、IDEA的项目结构

![image-20220625203931928](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220625203931928.png)

```
project > module > package > class
```

这些结构的划分，是为了方便管理项目技术和文件。



2、使用步骤

- 创建Project空项目


- 创建Module模块
- 创建Package包
- 创建class类
- 在class类中编写代码
- 编译运行



## 0.6 数的进制

二进制：只有0和1，按照逢二进一的方式表示数据。

八进制：有0～7，按照逢八进一的方式表示数据。

十进制：有0～9，按照逢十进一的方式表示数据。

十六进制：有0～9和A～F,按照逢十六进一的方式表示数据。



**0.6.1、十进制转换成二进制**

除二取余倒排。

![image-20220626065817079](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220626065817079.png)



**0.6.2 二进制转换成十进制**

将二进制数从右到左依次编号位0、1、2、3 …… n

十进制数 = 对n个由二进制位上的数（0或1）x 2^n得到的数组成的数列求和

 ![image-20220626071957698](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220626071957698.png)



**0.6.3 二进制转换成八进制**

把二进制数按3位为一组的方式进行分组（2^3=8），再将每一组数分别转换成对应的十进制数，得到的结果就是对应的八进制数。



**0.6.4 二进制转换为十六进制**

把二进制数按4位为一组的方式进行分组（2^4=8），再将每一组数分别转换成对应的十进制数或字母，得到的结果就是对应的十六进制数。



其余进制的转化类似，进制间转换时，最好先转换成十进制再进一步转换。

数据在计算机底层均以二进制的方式存储。

Java中二进制数以0B或0b开头，八进制数以0开头，十六进制数以0X或0x开头。



## 0.7 计算机中的单位

计算机中的最小单位是 位，也叫比特（bit），每个bit可以表示0或1两种状态。

计算机中的基本单位是 字节（byte），1字节由8个比特（bit）组成。

*计算机中表示信息含义的最小单位是 字节。



## 0.8 ASCII编码表

ASCII编码表：美国信息交换标准编码。规定了现代英文、数字、字符的数字编码。

![image-20220626070954383](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220626070954383.png)







# 一、Java的主类结构

Java程序的基本组成单元是类，类中包含属性和方法。

每个程序必须包含一个main()方法，含有main()方法的类称为主类。

第一个Java程序：

```java
package helloworld;								//包声明
public class helloworld {						//类声明
    public static void main(String[] args){		//方法声明
        System.out.println("hello world!");
    }
}
```

Java对大小写敏感。



## 1.1 包声明

package为包关键字，用于声明类所在的包。

```Java
package helloworld;
```



## 1.2 声明成员变量和局部变量

在类中声明的变量为全局变量（成员变量）

在方法中声明的变量为局部变量



## 1.3 编写主方法

main()方法为类中的主方法，是程序开始执行的地方。

main()方法声明：

```Java
public static void main(String[] args){
    
}
```

其中：public为权限修饰符，static为静态修饰符，void为返回值修饰符。

String[] args为字符串类型的数组，是main()方法的参数



## 1.4 导入API类库

在Java中可以使用import关键字导入相关的类。





# 二、基本数据类型

Java中有8中基本数据类型：

```
1、数值型：
	①整数类型：byte、short、int、long
	②浮点类型：float、double
2、字符型
3、布尔型
```

Java中默认的整数数据类型是int，即在程序中定义的整数字面量，系统默认为int类型。

Java中默认的浮点数数据类型是double，即在程序中定义的整数字面量，系统默认为double类型。



## 2.1 整数类型

整数类型可正可负，在Java中有三种表示形式：八进制、十进制、十六进制

| 数据类型 | 内存空间（bit） | 取值范围                                 |
| -------- | --------------- | ---------------------------------------- |
| byte     | 8               | -128~127                                 |
| short    | 16              | -32768~32767                             |
| int      | 32              | -2147483648~2147483647                   |
| long     | 64              | -9223372036854775808~9223372036854775807 |

应用实例：

```Java
package test01;

public class test01 {
    public static void main(String[] args) {
        byte mybyte = 124;
        short myshort = 32564;
        int myint = 123456;
        long mylong = 123558945;
        long result = mybyte + myshort + myint + mylong;
        System.out.println("The result is:"+result);
    }
}
```



## 2.2 浮点类型

| 数据类型 | 内存空间（bit） | 取值范围                        |
| -------- | --------------- | ------------------------------- |
| float    | 32              | 1.4E-45~3.4028235E38            |
| double   | 64              | 4.9E-324~1.7976931348623157E308 |

应用实例：

```Java
package test01;

public class test01 {
    public static void main(String[] args) {
        float myfloat = 3.215f;
        double mydouble = 6.5698d;
        double result = myfloat + mydouble;
        System.out.println("The result is:"+result);
    }
}
```

注意：Java中使用float类型的小数，须在小数后面加F或f，否则报错。double类型的小数后可加D或d也可不加。



## 2.3 字符类型

1、char类型

char类型用于存储单个字符，占用16字节内存空间。

定义字符型变量时，使用单引号表示单个字符，双引号表示字符串。

Java中字符采用unicode无符号字符编码(0~65536)，将编码转换成字符时需使用char类型显式转换。

使用实例：

```Java
package test01;

public class test01 {
    public static void main(String[] args) {
        char word1 = 'A', word2 = '@';
        int addr1 = 123, addr2 = 4523;
        System.out.println("A在unicode表中的顺序位置是："+(int)word1);
        System.out.println("@在unicode表中的顺序位置是："+(int)word2);
        System.out.println("在unicode表中第123位的是："+(char)addr1);
        System.out.println("在unicode表中第4523位的是："+(char)addr2);
    }
}
```

2、转义字符

转义字符是一类特殊的字符变量，以反斜杠'\\'开头，后跟一个或多个字符，表示特定含义：

| 转义字符 | 含义                      |
| -------- | ------------------------- |
| \ddd     | 1~3位八进制数据表示的字符 |
| \uxxxx   | 4位十六进制数据表示的字符 |
| \\'      | 单引号字符                |
| \\\      | 反斜杠字符                |
| \t       | 垂直制表符                |
| \r       | 回车                      |
| \n       | 换行                      |
| \b       | 退格                      |
| \f       | 换页                      |



## 2.4 布尔类型

布尔类型又称逻辑类型，通过boolean关键字进行变量的定义。

布尔类型的变量只有true和false两个值，分别代表'真'和'假'。

布尔类型的变量常用于流程控制中作为判断条件。

使用实例：

```Java
boolean myboolean = true;
```





# 三、变量与常量

程序执行过程中可以被改变的量成为变量，不能被改变的量成为常量。

变量就是用来存储某个数据的内存区域，可以理解为一个“盒子”，且里面存储的数据可以改变。

## 3.1 标识符和关键字

1、标识符，即名字，是用于表示类、方法、变量、常量、数组、文件等的有效字符序列。

标识符不能以数字开头，不能使用保留的关键字。

2、关键字，Java中共有47个保留关键字。

| byte       | break        | boolean   | assert     | abstract |
| ---------- | ------------ | --------- | ---------- | -------- |
| const      | class        | char      | catch      | case     |
| continue   | default      | do        | double     | else     |
| enum       | extends      | final     | finally    | float    |
| for        | goto         | if        | implements | import   |
| instanceof | int          | interface | long       | native   |
| new        | package      | private   | protected  | public   |
| return     | strictfp     | short     | static     | super    |
| switch     | synchronized | this      | throw      | throws   |
| transient  | try          | void      | volatile   | while    |
| TRUE       | FALSE        | null      |            |          |



## 3.2 声明变量

语法格式：

```
type name;
type name = value;
```

![image-20220625212055858](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220625212055858.png)





## 3.3 声明常量

语法格式：

```
final type name = value;
```

当使用final定义的常量属于"成员变量"时，必须在定义时对其赋值，否则报错。



## 3.4 变量的有效范围

1、成员变量：

在类中定义的变量成为成员变量，其作用范围为整个类。

类的成员变量可分为静态变量和动态变量两类：

```Java
class var{
    int x = 100;			//定义实例变量
    static int y = 200;		//定义静态变量
}
```

静态变量的作用范围可以跨类，甚至可以在整个程序的范围之内。

静态变量在其它类中可以以"类名.静态变量名"的方式调用。

2、局部变量：

在方法内部进行定义的变量为局部变量，其作用范围为当前方法内部。

局部变量可以与成员变量同名，此时成员变量被隐藏，成员变量在当前方法中暂时失效。

局部变量的生命周期取决于其所在的方法，方法被调用时，虚拟机为其局部变量分配内存，方法调用结束后，内存空间释放。

成员变量和局部变量的作用范围：

```Java
package test01;

public class test01 {
    int side = 1;
    public static void main(String[] args) {
        int side = 2;
        System.out.println(side);
    }
}
```

输出为：2



## 3.5 常量

**什么是常量**

- 常量是使用了 public static final 修饰的成员变量，必须有初始值，且程序执行过程中这个值不能被修改



**常量的执行原理**

- 在编译阶段执行“宏替换”，即把常量全部替换成其代表的字面量







# 四、运算符

运算符是一些特殊的符号，主要用于数学运算、赋值、逻辑比较等方面。

## 4.1 赋值运算符

**基本赋值运算符**

赋值运算符为"="，它是一个二元运算符（对两个操作数进行处理），功能为将右边的数值赋给左边的变量。

赋值运算符遵循四则运算法则。

同一行表达式中含有多个赋值号时，从右往左执行。



**扩展赋值运算符**

| 运算符 | 说明                   |
| ------ | ---------------------- |
| +=     | a += b  <=>  a = a + b |
| -=     | a -= b  <=>  a = a - b |
| *=     | a *= b  <=>  a = a * b |
| /=     | a /= b  <=>  a = a / b |
| %=     | a %= b  <=>  a = a % b |

扩展赋值运算符中，隐含着强制类型转换，最终数据类型与赋值号前的变量数据类型相同。

```java
int a = 1;
double b = 2.1;
a += b;  <=>  a = (int)(a + b);
```



## 4.2 算数运算符

| 运算符 | 说明 | 实例 | 结果 |
| ------ | ---- | ---- | ---- |
| +      | 加法 | 1+1  | 2    |
| -      | 减法 | 3-2  | 1    |
| *      | 乘法 | 2*5  | 10   |
| /      | 除法 | 9/3  | 3    |
| %      | 取余 | 5%2  | 1    |

注意：

"+"和"-"还可做数据的正负符号，以及字符串的连接符。---> “能算就算，不能算就在一起”

```java
public class linker {
    public static void main(String[] args) {
       int a = 5;
       System.out.println(a + 5);
       System.out.println(a + 'b');
       System.out.println(a + 'b' + "bc");
       System.out.println(a + 'b');
       System.out.println(a + "b");
    }
}
```

![image-20220627133914207](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220627133914207.png)

由运行结果可以发现：当字符使用单引号包括时，会转换成int类型后参与运算，而使用双引号包括时，则直接参与运算。



做除法运算时除数不能为0，否则报错。

如果两个整数做除法，则结果一定是整数，因为表达式中最高类型为整型。

**案例：**将一个三位整数拆分为百位、十位、各位并分别输出。

```java
public class operator {
    public static void main(String[] args) {
        int number = 126;
        int hundred, ten, individual;
        hundred = number / 100;
        ten = (number % 100) / 10;
        individual = number % 10;
        System.out.printf("%d's hundred position is:%d, ten position is:%d, individual position is:%d", number, hundred, ten, individual);
    }
}
```

![image-20220627110848063](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220627110848063.png)





## 4.3 自增和自减运算符

自增运算符和自减运算符均为一元运算符，可置于操作数前或后。操作数必须为整型或浮点型。

自增运算符：

```Java
a++;		//使用a后让其加1
++a;		//使用a前让它加1
```

自减运算符：

```java
b--;		//使用b后让它减1
--b;		//使用b前让它减1
```

**自增自减运算符的扩展案例**

int k = 3;
int p = 5;
int rs = k++ + ++k - --p + p-- - k-- + ++p + 2;

问：运算结束时，k、p、rs的值各为多少？

运算过程：

``` 
k : 3 -> 4 |  4 -> 5   |         |         | 5 -> 4  |         |       |  =  4
p : 5      |           | 5 -> 4  |  4 -> 3 |         | 3 -> 4  |       |  =  4
rs:  (k++) |  + (++k)  |  - --p  |  + p--  |  - k--  |  + ++p  |  + 2  |  =  9
rs:    3   |  +   5    |  -  4   |  +  4   |  - 5    |  +  4   |  + 2  |  =  9
```

=> k = 4， p = 4，rs = 9



## 4.4 比较运算符

比较运算符用于变量间的比较，返回值为boolean型（true或false）。

```
大于： >
小于： <
等于： ==
大于等于： >=
小于等于： <=
不等于： !=
```



## 4.5 逻辑运算符

逻辑运算符包括"与"、"或"、"非"，其操作对象必须为boolean类型，返回值也为boolean类型。

逻辑运算符可以把多个布尔运算的结果放在一起运算，最终返回一个布尔值。

| 运算符   | 名称     | 说明                   |
| -------- | -------- | ---------------------- |
| &、&&    | 逻辑与   | 两者同为真才是真       |
| \|、\|\| | 逻辑或   | 两者有一个为真就是真   |
| !        | 逻辑非   | 你真我假、你假我真     |
| ^        | 逻辑异或 | 找不同，两者不同就是真 |

"&"和"&&"的区别：

"&"为非短路运算，"&&"为短路运算。即"&"不论第一个表达式的真伪都会判断第二个表达式的真伪，而"&&"在第一个表达式为伪时就不再判断第二个表达式的真伪。

"|"和"||"的区别：

"|"为非短路运算，"||"为短路运算。即"|"不论第一个表达式的真伪都会判断第二个表达式的真伪，而"||"在第一个表达式为真时就不再判断第二个表达式的真伪。

```java
public class logical_operators {
    public static void main(String[] args) {
        int a = 10;
        int b = 20;
        System.out.println(a > 100 && ++b > 10);
        System.out.println(b);
        System.out.println(a > 100 & ++b > 10);
        System.out.println(b);
    }
}
```

![image-20220628140806978](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220628140806978.png)

实际开发中，最常用的是：&&、||、!。



## 4.6 位运算符*

位运算符除"按位与"和"按位或"之外，其余只能用于整数的运算。

整型数值在计算机中以二进制的形式存储，位运算是针对二进制位的直接操作。

1、"按位与"运算（&）

运算法则：若数a、b的对应位都为1，结果才是1，否则为0。若两数精度不同，结果精度与精度高的数相同。

2、"按位或"运算（|）

运算法则：若数a、b的对应位都为0，结果才是0，否则为1。若两数精度不同，结果精度与精度高的数相同。

3、"按位取反"运算（~）

"按位取反"也叫"按位非"。将对应位的0改成1，1改成0。

4、"按位异或"运算（^）

运算法则：若数a、b的对应位相同(同为0或同为1)时，结果为0，否则为1。

5、移位操作

左移：<<		右移：>>		无符号右移：>>>

左移：将运算符左边的数值对应的二进制数，按照运算符右边的指定位数向左移动，右边移空的二进制位填充0。

右移：右移时，若最高位是0，则移空的二进制位填充0；若最高位是1，则移空的二进制位填充1。

无符号右移：不论最高位是0还是1，移空的二进制位均填充0。

*适用位移运算符的数据类型有：byte、short、char、int、long



## 4.7 三元运算符

三元运算符的使用格式：

```Java
条件表达式?值1:值2
```

运算法则：若条件表达式为真，则整个表达式取值1，否则取值2。

```java
public class ternary_operator {
    public static void main(String[] args) {
        int score = 78;
        String resp = score >= 60 ? "Passing" : "Failue";
        System.out.println(resp);
    }
}
```



## 4.8 运算符的优先级

增量/减量运算 > 算数运算 > 比较运算 > 逻辑运算 > 赋值运算



## *4.9 补充：键盘录入技术

实现键盘录入的三个步骤：

1. 导包：告诉程序去jdk的哪个包中找对应的方法。
2. 获取键盘扫描器对象
3. 等待接收用户输入

实例：

```java
import java.util.Scanner;

public class scanner {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("input your name please:");
        String name = sc.next();
        System.out.println("input your age please:");
        int age = sc.nextInt();
        System.out.printf("your name is %s, your age is %d\n", name, age);
        sc.close();
    }
}
```



# 五、数据类型转换

两种数据类型转换的方式：隐式转换和显式转换。

## 5.1 隐式类型转换

**自动类型转换**

从低级类型到高级类型的转换（类型范围小到类型范围大的转换），系统将自动进行，这种转换成为隐式类型转换（自动类型转换）。

可以理解为：可存储数据范围较小的数据类型，可安全地转换为可存储数据范围较大的数据类型，例如：

```java
public class type_trans {
    public static void main(String[] args) {
        byte variable_byte = 20;
        int variable_int = variable_byte;
        System.out.println(variable_int);
    }
}
```

以上代码可正常运行且数据精度无损。

而这段代码则有报错产生：

```java
public class type_trans {
    public static void main(String[] args) {
        int variable_int = 1000;
        byte variable_byte = variable_int;
        System.out.println(variable_byte);
    }
}
```

![image-20220626203333764](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220626203333764.png)

由此：可存储数据范围较大的数据类型，不能直接转换为可存储数据范围较小的数据类型。

数值类型将涉及类型转换，按精度由低到高排序为：

byte < short < int < long < float < double



**表达式中的自动类型转换**

在运算表达式中，小范围的数据类型会被自动转换成大范围的数据类型后才参与运算过程。

注意事项：

- 运算表达式的最终结果的数据类型由表达式中的最大范围的数据类型决定。
- 在运算表达式中，byte、short、char类型直接转换成int类型参与运算。

```java
public class type_trans {
    public static void main(String[] args) {
        int a = 100;
        double b = 99.9;
        System.out.println(getType(a + b));
    }

    public static String getType(Object o) {
        return o.getClass().toString();
    }
}
```





## 5.2 显式类型转换

把高精度变量的数值赋给低精度变量时，必须使用显式类型转换（强制类型转换）

语法格式：(要转换为的类型)要转换的值

```Java
int a = (int)45.3;
float b = (float)98;
```

使用显式类型转换时**可能会造成精度损失**。

除boolean外的类型都可以使用显式类型转换。





# 六、代码注释

## 6.1 单行注释

单行注释标记："//"

注释范围：从"//"开始到换行结束。

```Java
int a = 10;			//定义整型变量a并将10赋值给a
```



## 6.2 多行注释

多行注释标记："/* */"

```Java
/*
	注释内容1
	注释内容2
	……
*/
```

在多行注释中可以嵌套单行注释，但不可以嵌套多行注释。



## 6.3 文档注释

文档注释标记："/** */"

文档注释内容会被Javadoc工具读取作为 Javadoc 的内容。

注释的特点：注释在.java文件被编译成.class文件时，注释会被忽略舍去。



# 七、流程控制

## 7.1 复合语句

Java复合语句以区块为单位，由"{"开始，到"}"结束。

复合语句为局部变量创造了作用域，在该作用域内某个变量被创建，则该变量只能在这个作用域内使用，在作用域外使用会报错。

## 7.2 条件语句

### 7.2.1 if语句

1.简单的if语句

语法格式：

```Java
if(布尔表达式){
    语句序列
}
```

使用实例：

```Java
package test01;

public class test01 {
    public static void main(String[] args){
         int a = 45;
         int b = 23;
         if (a > b){
             System.out.println(a+">"+b);
         }
    }
}
```



2.if...else语句

语法格式：

```Java
if(布尔表达式){
    语句序列1
}
else{
    语句序列2
}
```

使用实例：

```Java
package test01;

public class test01 {
    public static void main(String[] args){
         int a = 12;
         int b = 23;
         if (a > b){
             System.out.println(a+">"+b);
         }
         else{
             System.out.println(a+"<"+b);
         }
    }
}
```

*if...else语句可以使用三元运算符简化：

```Java
if(a>0){
	b=a;
}
else{
    b=-a;
}
```

等价于：

```Java
b=a>0?a:-a;
```



3.if...else if多分支语句

语法格式：

```Java
if(条件表达式1){
    语句序列1
}
else if(条件表达式2){
    语句序列2
}
......
else if(条件表达式n){
    语句序列n
}
```



### 7.2.2 switch多分支语句

语法格式：

```Java
switch(表达式){
    case 常量值1:
        语句序列1
        break;
    case 常量值2:
        语句序列2
        break;
    ......
    default:
        语句序列n
        break;
}
```

switch语句表达式中的值和常量值必须为整型、字符型或字符串型。

实例：

```java
import java.util.Scanner;

public class switch_structure {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        System.out.println("please input the day of week");
        String day = sc.next();
        switch (day) {
            case "monday" :
                System.out.println("finish the coding task");
                break;
            case "tuesday" :
                System.out.println("learn python");
                break;
            case "wednesday" :
                System.out.println("coding");
                break;
            case "thursday" :
                System.out.println("learn golang");
                break;
            case "friday" :
                System.out.println("go to the party");
                break;
            case "saturday" :
                System.out.println("sleep");
                break;
            case "sunday" :
                System.out.println("emo");
                break;
            default :
                System.out.println("error");
                break;
        }
        sc.close(); 
    }
}
```

**switch语句的注意事项**

- 表达式的类型可以是byte、short、int、char、String，不支持double、float和long。（浮点数在计算机中的存储表示是不精确的，所以不支持）
- case给出的值不允许重复，且只能是字面量，不能是变量。
- 每一个分支后都要带上break，否则会出现穿透现象。

switch的穿透性：如果代码执行到没有break的语句块，执行完后将直接进入下一个语句块，且不会进行任何条件匹配，直到遇到break才跳出分支。



**if语句和switch语句的对比**

- if适合做区间匹配
- switch适合做值匹配







## 7.3 循环语句

### 7.3.1 while循环

![image-20220629215044094](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220629215044094.png)

语法格式：

```Java
while(条件表达式){
    语句序列
    迭代语句
}
```

实例：已知有一张足够大的纸，厚度为0.1毫米，需要对折多少次后达到珠穆朗玛峰的高度（8848.86米~884860毫米）

```java
public class qomolangma {

    public static void main(String[] args) {
        double height = 0.1;
        int count = 0;
        while (height <= 8848860) {
            count += 1;
            height *= 2;
        }
        System.out.println(count);
    }    
}
```



### 7.3.2 do...while循环

![image-20220629220530866](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220629220530866.png)

语法格式：

```Java
do {
    语句序列
    迭代语句
}while(条件表达式);
```

while和do...while的区别：

1、while语句的条件表达式后没有";"，do...while语句的条件表达式后有";"。

2、while语句是先判断再执行，do...while语句是先执行再判断。



### 7.3.3 for循环

![image-20220629095603159](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220629095603159.png)

1、for语句

语法格式：

```Java
for(初始化表达式;循环条件表达式;循环后表达式) {
    语句序列
}
```

使用实例：输出0~100所有的偶数

```Java
package test01;

public class test01 {
    public static void main(String[] args){
         for (int i = 0;i<=100;i++){
             if (i%2==0){
                 System.out.println(i);
             }
         }
    }
}
```

2、foreach语句

foreach语句是for语句的简化，类似python中for循环遍历可迭代对象的使用。

foreach本身并不是一个关键字，只是习惯上将这种格式的for语句称为foreach语句：

```Java
for (元素变量x:遍历对象obj) {
    引用了x的Java语句
}
```

foreach语句在遍历数组时提供了极大的方便：

```Java
package test01;

public class test01 {
    public static void main(String[] args) {
         int arr[] = {1,2,3,4,5};
         for (int x:arr){
             System.out.println(x);
         }
    }
}
```



**使用while循环还是for循环的问题**

已知需要循环几次的情况下，用for循环

未知需要循环几次但已知循环终止条件时用while循环





### 7.3.4 循环控制

1、break语句

使用break语句除了可以跳出switch结构，还可以跳出while、do...while结构和for结构，结束循环。

一般来说，在循环的嵌套中，break语句只跳出包含它的最小层，即只跳出一层结构。

使用标签功能，可以使break跳出外层循环，其语法格式如下：

```Java
标签名:循环体{
    break 标签名;
}
```

2、continue语句

continue语句只结束本次循环，重新回到循环的测试部分进行下一轮循环。

continue语句也支持标签功能，其语法格式如下：

```Java
标签名:循环体{
    continue 标签名;
}
```

3、死循环

无干预时，循环将无休止地执行。实现方式有三种形式：

1. for循环形式

   ```java
   for (;;) {
   	代码块
   }
   ```

2. while循环形式

   ```java
   while (true) {
   	代码块
   }
   ```

3. do...while循环形式

   ```java
   do {
   	代码块
   } while (true);
   ```





## *7.4 补充：随机数Random类

Random类用于在程序中产生一个随机数。

使用步骤：

1. 导包：告诉程序去jdk的哪个包中找对应的方法
2. 获取随机数对象
3. 调用随机数对象

基本使用方法：

```java
import java.util.Random;	//导包：告诉程序去jdk的哪个包中找对应的方法

public class random {
    public static void main(String[] args) {
        Random rd = new Random();		//获取随机数对象
        int data = rd.nextInt(10);		//调用随机数对象，取值区间为[0,10)
        System.out.println(data);        
    }
}
```

使用Random类获取指定区间随机数的方法：减加法。

例如：要生成25~100之间的随机数。

Random产生随机数的范围是0\~X，所以先把指定区间的起始位置减至0，即减去25，25~100 -> 0~75。

再把产生的随机数加上减去的值，即rd.nextInt(75) + 25。

```java
import java.util.Random;	//导包：告诉程序去jdk的哪个包中找对应的方法

public class random {
    public static void main(String[] args) {
        Random rd = new Random();		//获取随机数对象
        int data = rd.nextInt(75) + 25;		//调用随机数对象，取值区间为[0,75)，产生的随机数范围为25~100
        System.out.println(data);        
    }
}
```



随机数应用实例：猜数字游戏

```java
import java.util.Scanner;
import java.util.Random;

public class guess_the_number {
    public static void main(String[] args) {
        int right_number;
        int input_number;
        Scanner sc = new Scanner(System.in);
        Random ra = new Random();
        right_number = ra.nextInt(100);
        System.out.println("The right number is between 0 and 100, please enter your number");
        while (true) {
            input_number = sc.nextInt();
            if (input_number == right_number) {
                System.out.println("bingo!");
                break;
            }
            else if (input_number < right_number) {
                System.out.println("your number is smaller than the right number");
            }
            else if (input_number > right_number) {
                System.out.println("your number is bigger than the right number");
            }
            else {
                System.out.println("your input is wrong");
            }
        }
        sc.close();
    }
}
```

![image-20220629225353554](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220629225353554.png)



# 八、字符串

## 8.1 String类

char类型只能表示单个字符，而在Java中，字符串作为对象来处理，通过java.lang包中的String类来创建字符串。



### 8.1.1 声明字符串

在Java中，字符串必须使用双引号包围。

声明字符串的语法格式：

```Java
String str;
```



### 8.1.2 创建字符串

String，指的是java.lang.String类，String类定义的变量可以指向字符串对象，并提供了若干操作字符串的方法。

Java中所有字符串文字都是String类的对象。

String类的对象在创建后不能被更改。

![image-20220706221631461](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220706221631461.png)

在字符串的拼接运算中，是在堆内存开辟一段新的内存空间，将原来的字符串与新的字符串拼接后形成新的字符串对象并存入，再将这段内存空间的地址赋值给字符串变量，而原来的字符串对象仍然不被改变，所以说String类的对象在创建后不能被更改。





String类的常用构造方法：

1、使用双引号定义：

```java
String str = "this is a string";
```

2、使用String类的无参数构造器定义字符串（基本不用）

```java
String str = new String()
```

2、用一个字符数组创建一个字符串 public String(char arr[])：

```Java
char arr[] = {'h','e','l','l','o',',','w','o','r','l','d','!'};
String str = new String(arr);
```

3、String(char[],int start,int len)

提取字符数组中的一部分内容来创建字符串，char[]为要提取的字符数组，start为起始下标，len为截取长度。

```Java
char arr[] = {'a','b','c','d','e','f','g'};
String str = new String(arr,2,3);
```

4、根据字节数组的内容来创建一个字符串 public String(bytes b[])

```java
bytes b[] = {97, 98};	//这里会将字节数组中的数值按照ASCII码表转换成字符，再将字符拼接起来形成字符串
String str = new String(b);
```



**面试常考的问题**

![image-20220706222931341](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220706222931341.png)

两种创建字符串对象的方式有何区别？

- 以双引号（“ ”） 方式定义的字符串存储在字符串常量池中，相同的内容只会存储一份
- 使用构造器new对象，每new一次都会创建一个新的对象存储在堆内存中



![image-20220706223908057](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220706223908057.png)

![image-20220706224518816](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220706224518816.png)







### 8.1.3 常用的String类API

**获取字符串长度**

- public int length();

```java
String str = "YangMengxue";
int str_length = str.length();	// >> 11
```



**字符串内容的比较**

Java中，字符串内容不能直接用 **==** 来比较，而Java提供了用于字符串内容比较的API：

- public boolean equals(Object str);	比较字符串内容是否一致。
- public boolean equalsIgnoreCase(Object str);    忽略大小写比较字符串内容是否一致。

注：忽略大小写的内容比较常用于验证码的校验。



**获取字符串中指定索引位置的字符**

- public char charAt(int index);

遍历字符串实例：

```java
public class charAt_str {
    public static void main(String[] args) {
        String str = "ABCDEFG";
        for (int i = 0; i < str.length(); i++) {
            System.out.println(str.charAt(i));
        }
    }
}
```



**把字符串转换为字符数组**

- public char[] toCharArray();

```java
String str = "ABCDE";
char str_array[] = str.toCharArray();	// >> ['A', 'B', 'C', 'D', 'E']
```



**截取字符串内容**

- public String substring(int beginIndex, int endIndex);

截取范围是：[beginIndex, endIndex)

```java
String str = "ABCDEFG";
System.out.println(str.substring(2, 4));	// >> C D
```



**敏感词替换**

- public String replace(CharSequence target, CharSequence replacement);

target为被替换的字符串，replacement为要替换为的字符串。

```java
public class str_replace {
    public static void main(String[] args) {
        String str = "金三胖是个大傻逼!";
        System.out.println(str.replace("大傻逼", "***"));
    }
}
// >> 金三胖是个***!
```



**判断字符串中是否包含某段字符**

- public boolean contains(CharSquence s);

```java
String str = "金三胖是个大傻逼!";
System.out.println(str.contains("金二胖"));	// >> false
System.out.println(str.contains("金三胖"));	// >> true
```





# 九、集合

## 9.1 集合概述

**什么是集合？**

集合与数组类似，是一种容器，用于装数据。

集合的大小不固定，可以动态分配，所存储的数据类型也不固定。

集合提供了许多常用的功能，可以直接调用对应的方法。



## 9.2 ArrayList

**什么是ArrayList？**

ArrayList是集合的一种，支持索引。



**ArrayList对象的获取**

使用ArrayList类的无参数构造器：public ArrayList()，创建一个空的集合对象

```java
ArrayList list = new ArrayList();
```



**向ArrayList中添加元素**

- public boolean add(elemType e);    将元素e添加到该集合的末尾
- public void add(int index, elemType e);    将元素e添加到集合的指定位置



**输出ArrayList集合中的元素**

直接打印ArrayList变量即可，Java会根据ArrayList变量中存储的集合地址找到对应的元素并全部输出，不需要使用循环进行遍历。

- 补充：对于基本类型的变量，直接打印会输出变量中存储的值；对于引用类型的变量，直接打印会输出该变量指向的内存空间所存储的值



## 9.3 ArrayList对泛型的支持

**什么是泛型？**

- ArrayList<Parameter>是一个泛型类，可以通过Parameter参数在编译阶段约束该集合只能操作某种类型的数据。

如：

```java
ArrayList<Integer>	//该集合只能操作整型数据
ArrayList<String>	//该集合只能操作字符串型数据
```

注意：集合中只能存储引用类型的数据，不支持基本数据类型。即集合中存储的元素都是独立的对象。

```java
import java.util.ArrayList;

public class new_ArrayList {
    public static void main(String[] args) {
        ArrayList list1 = new ArrayList();	//未添加类型约束条件，该集合可以操作任意类型的数据
        list1.add("A");
        list1.add(1);
        list1.add(1.25);
        list1.add(true);
        list1.add('a');
        System.out.println(list1);

        ArrayList<String> list2 = new ArrayList<String>();	//添加了类型约束条件
        list2.add(1);	//这一行报错，因为约束了该集合只能操作字符串类型的数据
        list2.add("a");
        System.out.println(list2);
    }
}
```





## 9.4 ArrayList的常用API

**获取指定索引位置的元素值**

```java
public elemType get(int index);
```



**获取集合的元素个数**

```java
public int size();
```



**删除集合指定索引位置处的元素并返回该元素**

```java
public elemType remove(int index);
```



**删除集合中的指定元素，删除成功返回true，删除失败返回false**

```java
public boolean remove(Object o);
```



**修改集合指定位置的值，并返回被修改的元素**

```java
public elemType set(int index, elemType e);
```



**判断元素是否在集合中**

```java
public boolean contains(Object o);
```















# 十、数组

## 10.1 数组概述

**什么是数组**

数组是具有相同数据类型的一组数据的集合。

在Java中，将数组看作一个对象，虽然基本数据类型不是对象，但由基本数据类型组成的数组却是对象。

根据数组的维数可将数组分为一维数组、二维数组……



## 10.2 一维数组

### 10.2.1 一维数组的内存实现

![image-20220630092950260](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630092950260.png)

数组名本质上是一个指针变量，指向内存中一片连续内存空间的起始地址，这片连续的内存空间用于存储数组元素，所以数组是引用类型。

使用代码直接打印数组名称时，得到的就是该数组的起始地址：

```java
public class init_array {

    public static void main(String[] args) {
        int array[] = new int[] {1, 2, 3, 4, 5, 6, 7};
        System.out.println(array);
    }
}
```

![image-20220630093324579](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630093324579.png)



***补充：Java的内存分配**

Java的内存可分为：

1. 栈内存
2. 堆内存
3. 方法区
4. *本地方法栈
5. *寄存器

![image-20220630153304528](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630153304528.png)

![image-20220630153415339](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630153415339.png)





### 10.2.2 静态初始化一维数组

完整语法格式：

```java
DataType arrayName[] = new DataType[] {Element1, Element2, Element3, ......};
```

简化语法格式：

```java
DataType arrayName[] = {Element1, Element2, Element3, ......};
```



### 10.2.3 动态初始化一维数组

数组的动态初始化： 在定义数组的时候只确定数组的名称和长度，并把数组元素全部用默认值填充。

![image-20220630094025527](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630094025527.png)

完整语法格式：

```java
DataType arrayName[] = new DataType[100];
```

动态初始化时，数组元素的默认值规则：

![image-20220630095425036](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630095425036.png)





### 10.2.4 遍历一维数组的元素

1. 常规的遍历方式，即已知数组中的元素个数，使用下标逐个遍历：

   ```java
   public class visit_array {
   
       public static void main(String[] args) {
           int day_number[] = new int[] {31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31};
           //使用for循环遍历数组
           for (int i = 0; i < 12; i++) {
               System.out.println((i + 1) + "月有" + day_number[i] + "天" );
           }
       }
   }
   ```

2. 数组中的元素个数未知时，可获取数组长度作为参数来进行遍历：

   ```java
   public class visit_array {
   
       public static void main(String[] args) {
           char alphabet[] = new char[] {'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N'};
           //使用.length来获取数组元素的个数
           for (int j = 0; j < alphabet.length; j++) {
               System.out.println(alphabet[j]);
           }
       }
   }
   ```




### 10.2.5 数组常见问题

1. 访问元素位置超过最大索引，执行时报错：ArrayIndexOutOfBoundException(数组索引越界异常)
2. 数组变量中没有存储数组地址，即数组变量值为NULL，执行时报错：NullPointerException(空指针异常)
2. 把数组作为实参传入方法时，传入的是数组的引用，而不是复制的数组





# 十一、方法

## 11.1 什么是方法

方法是一种语法结构，可以把一段代码封装成一个功能，方便重复调用。（可以理解为C语言中的函数）



## 11.2 定义方法

![image-20220630160609908](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630160609908.png)



## 11.3 调用方法

方法必须调用才能跑起来，其调用格式如下：

```
方法名（参数列表）；
```

```java
public class methods {
    public static void main(String[] args) {
        int a1 = 3, b1 = 5;
        int c1 = sum(a1, b1);	//调用方法sum，传入参数a1和b1
        System.out.println(c1);
    }
    
    public static int sum(int a, int b) {	//定义方法sum	
        int c = a + b;	//方法体代码
        return c;		//返回值c
    }
}
```

定义方法时，若声明了方法的返回值类型，则方法必须返回该类型的值，否则报错。



## 11.4 方法的调用流程

- 方法未被调用的时候，在方法区中的字节码文件（.class文件）中存放
- 方法被调用时，进入栈内存中运行

![image-20220630191731242](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630191731242.png)



## 11.5 方法的参数传递机制

- 实参：在方法内部定义的变量
- 形参：在定义方法时，声明在方法参数列表中的变量

Java的参数传递机制：值传递

Java在转递实参给方法的形参时，传递的不是实参变量本身，而是实参变量中存储的值。



### 11.5.1 基本类型的参数传递

![image-20220630192905032](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630192905032.png)

由此可见：基本类型的参数传递过程中，实参的值并不会被方法所改变。





### 11.5.2 引用类型的参数传递

![image-20220630193757691](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630193757691.png)

在引用类型的参数传递过程中，传递给方法的是变量所存储的值，即该变量指向的内存空间地址，所以方法的形参得到的值就是实参所指向的内存空间，所以方法在操作引用类型的变量时，实际操作的就是实参所指向的内存空间所存储的数据，所以在引用类型的参数传递过程中，实参的值可能会被方法所改变。

（这里实际上就是地址传递，结合C语言中的指针来理解即可）



## 11.6 方法重载

**什么是方法重载**

同一个类中，出现多个方法具有相同的名称，但它们的形参列表不同，那么这些方法就叫做重载方法。

虽然多个方法的名称相同，但在程序中调用方法时，Java会根据参数的不同调用不同的方法，所以不会导致方法之间的冲突。

例如：

```java
public class method_overloading {

    public static void main(String[] args) {
        fire();
        fire("Tokyo");
        fire("Tokyo", 500);        
    }

    public static void fire() {
        System.out.println("fire!");
    }

    public static void fire(String location) {
        System.out.println("fire to " + location);
    }

    public static void fire(String location, int n) {
        System.out.println("fire " + n + " cannonball to " + location);
    }
}
```

![image-20220630211747642](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220630211747642.png)

**方法重载的作用**

可读性好，名称相同提示是同一类型的功能，通过形参从不同实现功能差异化。



**重载方法的识别技巧**

若在同一个类中，若干个方法的名称都相同，但它们的形参列表不同，那么它们就都是重载方法。

注意：形参列表不同指的是形参的类型、数量、顺序不同，而不是形参的名称不同。



## 11.6 return关键字

- return关键字可用于返回当前方法的返回值
- return关键字单独使用时，可立即结束并跳出当前方法；且return关键字单独使用时可以在任何方法中使用







# 十二、面向对象基础

## 12.1 面向对象概述

面向对象，即把所有预处理的问题和抽象成不同的对象，同时了解这些对象具有哪些相应的属性以及展示这些对象的行为，以解决这些对象面临的一些 实际问题。程序开发中引入了面向对象设计的概念，其实质上就是对现实世界中的对象进行建模操作。

面向对象编程可以理解为使用不同的对象来编程。



**对象**

对象是事物存在的实体，是现实世界中所存在的事物。



**类**

类是对同一种事物的统称，具有相同属性的实体可统称为一类。



**类和对象的关系**

类是对象所具有的共同特征的描述，而对象是其中的一个实例。有了类之后，才可以根据类来创建实例，即通过类来创建对象。



面向对象编程具有以下特点：

- 封装性
- 继承性
- 多态性



**封装**

封装是面向对象编程的核心思想。将对象的属性和行为封装起来，以类作为载体。类通常对用户隐藏细节，即用户不需要知道类的内部是如何运行的。

![image-20220702125503084](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702125503084.png)



**继承**

继承性主要利用特定对象之间的共有属性。在程序设计中，继承可以理解为：针对新出现的需求，可以从已经定义好的类中，选择性的保留一些属性和行为，并根据新的需求添加新的属性和行为，形成一个新的对象。通过复用已经定义好的类，可以大大降低系统出现故障的概率，同时提高开发的效率。

继承关系：父类和子类

![image-20220702150352520](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702150352520.png)

继承关系可以用树结构来表示，父类与子类之间存在层次关系。

另外：子类的所有实例都是父类的实例，但不能说父类的实例都是子类的实例。



**多态**

多态就是将父类的属性和行为应用于子类的特征。

可以简单理解为：同一个类可以被多个子类的对象所复用。



## 12.2 类

设计对象的前提是要先设计一个类。类可以理解为对象的设计图。

- 在Java中对象的属性也称为成员变量，成员变量对应于类对象的属性。
- 在Java语言中使用成员方法对应于类对象的行为。

Java中类的使用：

![image-20220702151401577](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702151401577.png)



实例：定义一个类并使用这个类来创建一个对象

文件1：car类

```java
public class car {
    //成员变量
    String name;
    double price;

    //成员方法
    public void start() {
        System.out.println("the car is alredy started!");
    }

    public void run() {
        System.out.println("the car is running!");
    }
}
```

文件2：App类（主类）

```java
public class App {
    public static void main(String[] args) throws Exception {
        System.out.println("Hello, World!");

        //调用car类来创建对象
        car c = new car();

        //使用car类创建的新对象
        c.name = "WuLing";
        c.price = 56000.0;
        System.out.println(c.name);
        System.out.println(c.price);
        c.start();
        c.run();
    }
}
```

两个文件应当放在同一目录下。

程序运行结果：

![image-20220702152745704](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702152745704.png)



类的复用：

```java
public class App {
    public static void main(String[] args) throws Exception {
        System.out.println("Hello, World!");

        System.out.println("调用car类来创建对象");
        car c1 = new car();

        c1.name = "奔驰";
        c1.price = 56000.0;
        System.out.println(c1.name);
        System.out.println(c1.price);
        c1.start();
        c1.run();

        System.out.println("-----------------------");
        System.out.println("复用car类来创建一个新的对象");
        car c2 = new car();

        c2.name = "大众";
        c2.price = 288000.0;
        System.out.println(c2.name);
        System.out.println(c2.price);
        c2.start();
        c2.run();
    }
}
```

![image-20220702153741134](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702153741134.png)

由此可见，同一个类可用于创建不同的对象，对象之间互不干扰，体现了多态性。



**关于类的注意事项**

- 一个Java文件中可以定义多个class类，但只能由一个是public修饰符，且使用public修饰符的class类的类名必须与文件名相同
- （实际开发中建议一个Java文件只定义一个类）



**权限修饰符**

Java中的权限修饰符主要包括private、public和protected。

修饰符控制着对类和类的成员变量以及成员方法的访问。

三种修饰符的区别如下：

- private：成员变量和成员方法只能在本类中被使用，在子类中不可见，并且对其他包的类也是不可见的。
- public：成员变量和成员方法除了可以在本类使用之外，还可以在子类和其他包的类中使用。
- protected：类将隐藏其内的所有数据，以免用户直接访问它。

![image-20220702155045673](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702155045673.png)







## 12.3 对象的内存机制

![image-20220702160704583](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702160704583.png)

创建对象的执行流程：

- 将Test类加载到方法区

- 将main方法加载到栈内存中开始执行程序

- 将Car类加载到方法区

- 引用变量c1被加载到栈内存中

- new Car()会创建一个Car类的对象，在堆内存中开辟一段空间，成员变量会直接在堆内存中开辟空间存储，而成员方法则会在堆内存中开辟一段空间，用于存储成员方法在方法区中的地址，而不会将成员方法完整的加载到堆内存中

- 将新对象在堆内存中开辟的空间地址赋值给变量c1

  ……





**两个变量指向同一个对象**

![image-20220702161158424](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702161158424.png)





## 12.4 构造器

**什么是构造器？**

构造器定义在类中，可以用于初始化一个对象并返回对象的地址。如：

```java
Goods g = new Goods();
```

以上代码中的Goods()就是一个构造器。



![image-20220706140924732](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220706140924732.png)

实例：

```java
public class Constructors {		//在Constructors类中分别定义一个无参数构造器和一个有参数构造器
    String str;
    public Constructors () {	//无参数构造器
        System.out.println("调用无参数构造器A");
    }
    public Constructors (String x) {	//有参数构造器
        str = x;
        System.out.println("调用有参数构造器" + x);
    }
}
```

```java
public class App {
    public static void main(String[] args) {
        Constructors c1 = new Constructors();	//调用无参数构造器新建一个对象c1
        c1.str = "A";
        System.out.println(c1.str);
        Constructors c2 = new Constructors("B");	//调用有参数构造器新建一个对象c2并传入参数“B”
        System.out.println(c2.str);
    }
}
```



**构造器的注意事项**

- 任何类在被定义之后，就默认带有一个无参数构造器。初始化对象时，成员变量均以默认值填充。
- 若在类中自定义一个有参数构造器，则默认的无参数构造器就会被覆盖，若要继续使用无参数构造器，就必须手动写一个无参数构造器。







## 12.5 this关键字

this关键字出现在构造器和方法中，代表了当前对象在内存中的地址。

```java
public class this_keyword {		//this_keyword类
    public this_keyword() {		//无参数构造器
        System.out.println("无参数构造器中的this:" + this);
    }
    public void func() {		//成员方法
        System.out.println("成员方法中的this:" + this);
    }
}
```

```java
public class App {
    public static void main(String[] args) {
        this_keyword th = new this_keyword();		//调用this_keyword类中的无参数构造器
        th.func();									//调用this_keyword类中的成员方法
        System.out.println("变量th存储的值:" + th);	//打印变量th中存储的值
    }
}
```

![image-20220706144010151](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220706144010151.png)

由程序运行结果可知：this关键字代表的是当前对象的地址。



**this关键字的应用**

this关键字可用于指定访问当前对象的成员变量，如：

```java
public class this_keyword {
    String name;
    public this_keyword(String name) {
        this.name = name;
    }
}
```

```java
public class App {
    public static void main(String[] args) {
        this_keyword th3 = new this_keyword("可莉");
        System.out.println(th3.name);
    }
}
```





## 12.6 封装

**封装的原则**

对象代表什么，对象中就要封装对应的数据，并提供对应的行为（方法）。

使用封装的思想，面向对象编程时，需要解决什么问题，就找到对应的对象，调用该对象的方法即可。

![image-20220706155315930](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220706155315930.png)



**如何更好的封装**

- 使用private关键字对类的成员变量进行修饰，使成员变量不能被其它的类访问
- 为每个成员变量提供使用public关键字修饰的方法，对成员变量进行取值和赋值

实例：

```java
public class student {
    //定义私有成员变量
    private String name;
    private int age;
    
    //定义公共成员方法，对成员变量进行取值和赋值
    public void setAge(String name, int age) {
        if (age >= 0 && age <= 200) {
            this.name = name;
            this.age = age;
        }
        else {
            System.out.println("请检查输入的年龄!");
        }
    }
    
    public String[] getAge () {
        String info[] = new String[2];
        info[0] = this.name;
        info[1] = Integer.toString(age);	//Integer.toString方法用于将数字转换为字符串
        return info;
    }
}
```

```java
public class student_test {
    public static void main(String[] args) {
        student stu = new student();	//创建一个student类的新对象stu
        stu.setAge("root", 18);			//调用stu中的setAge方法对stu的成员变量进行赋值
        System.out.println(stu.getAge()[0] + "'s age is " + stu.getAge()[1]);	//调用stu中的getAge方法对stu的成员变量进行取值
    }
}
```

使用封装的思想，可以确保对对象的成员变量的操作都是符合规范的，确保了成员变量的安全。





## 12.7 标准JavaBean

**什么是JavaBean？**

JavaBean，即实体类，JavaBean的对象可用于在程序中封装数据。



**标准JavaBean的格式**

- 成员变量使用private修饰符
- 为每个成员变量提供配套的setter方法和getter方法，用于对成员变量的赋值和取值
- 必须提供一个无参数构造器



实例：

```java
public class user {
    //定义使用private修饰的成员变量
    private String name;
    private int age;
    private double height;

    //定义配套的set方法和get方法
    public void setName(String name) {
        this.name = name;
    }
    public String getName() {
        return this.name;
    }

    public void setAge(int age) {
        this.age = age;
    }
    public int getAge() {
        return this.age;
    }

    public void setHeight(double height) {
        this.height = height;
    }
    public double getHeight() {
        return this.height;
    }

    //定义无参数构造器
    public user() {

    }

    //(可选)定义有参数构造器
    public user(String name, int age, double height) {
        this.name = name;
        this.age = age;
        this.height = height;
    }
}
```

```java
public class user_test {
    public static void main(String[] args) {
        System.out.println("使用无参数构造器创建对象并封装一个用户信息");
        user u1 = new user();
        u1.setName("user_1");
        u1.setAge(18);
        u1.setHeight(168);
        System.out.printf("%s's age is %d and his height is %.2f\n", u1.getName(), u1.getAge(), u1.getHeight());
        System.out.println();
        System.out.println("使用有参数构造器创建对象并封装一个用户信息");
        user u2 = new user("user_2", 20, 165);
        System.out.printf("%s's age is %d and his height is %.2f\n", u2.getName(), u2.getAge(), u2.getHeight());
        System.out.println();
    }
}
```

![image-20220706164147618](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220706164147618.png)





## 12.8 成员变量和局部变量的区别



| 区别         | 成员变量                           | 局部变量                               |
| ------------ | ---------------------------------- | -------------------------------------- |
| 类中位置不同 | 类中的方法外                       | 类中的方法内                           |
| 初始化值不同 | 有默认值，无需初始化               | 无默认值，需要初始化                   |
| 内存位置不同 | 堆内存                             | 栈内存                                 |
| 生命周期不同 | 随对象创建而创建，随对象消失而消失 | 随方法调用而存在，随方法运行结束而消失 |
| 作用域不同   | 不好界定                           | 在方法的大括号内                       |





# 十三、面向对象进阶

## 13.1 static静态关键字

- static表示静态，可用于修饰成员变量和成员方法
- static修饰成员变量时，表示该成员变量在内存中只存储一份，并且可以被共享访问和修改



**成员变量的分类**

- 静态成员变量：由static修饰，属于类，在内存中只存储一份，可以被共享访问和修改。

  访问静态成员变量的方式：

  - 类名. 静态成员变量名	（静态成员变量时随着类的加载而加载的，所以可以直接通过类名来访问）
  - 对象名. 静态成员变量名     （不推荐）

- 实例成员变量：无static修饰，属于对象，存在于每一个对象中。

  访问实例成员变量的方式：

  - 对象名. 实例成员变量名    （必须创建对象后才能访问）



**成员方法的分类**

- 静态成员方法：由static修饰，属于类，建议使用类名来访问
  - 同一个类中，调用静态成员方法时，可以省略类名（可以类比C语言中对函数的调用）
- 实例成员方法：无static修饰，属于对象，只能用对象名来访问（因为类存在，对象不一定存在）





## 13.2 静态成员变量和实例成员变量的内存机制

**栈内存和堆内存的区分**

- 栈内存是方法执行时所占用的空间，所以方法执行时创建的局部变量存储在栈内存中
- 栈内存保存的是变量本身的值，对于基本类型的变量，保存的就是对应的数据；而对于引用类型的变量，保存的是指向对应数据的地址，真正的数据保存在堆内存中



**静态成员变量和实例成员变量的加载**

- 当类被加载到方法区的同时，静态成员变量被同步加载到堆内存中
- 当使用该类创建对象时，在堆内存中开辟用于存储对象的空间，同时将实例成员变量加载到该对象的空间内





## 13.3 静态成员方法和实例成员方法的内存机制

**静态成员方法和实例成员方法的加载**

- 当类被加载到方法区的同时，静态成员方法会被同步加载到方法区中该类所在的区域
- 创建对象时，对象本身被加载到堆内存中，而属于该对象的实例成员方法会被加载到方法区中该类的区域，对象保存的是指向该成员方法的地址
- 当调用成员方法时，方法均被加载到栈内存中执行





## 13.4 static访问的注意事项

- 静态方法只能访问静态成员，不能直接访问实例成员
- 实例方法既可以访问静态成员，也可以访问实例成员
- 静态方法中不能使用this关键字，因为this关键字代表的是当前对象在堆内存中的地址





## 13.5 static应用：工具类

**什么是工具类**

- 类中都是静态方法，每个方法都以完成一个共用的功能为目的，可以被开发人员共同使用的类



**实例**

生成随机验证码：

```java
//validation_code.java
import java.util.Random;

public class validation_code {
    public static String create_validation_code() {
        Random ra = new Random();
        String validatation_code = "";
        String data = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        for (int i = 0; i < 4; i++) {
            validatation_code += data.charAt(ra.nextInt(data.length()));
        }
        return validatation_code;
    }
}
```

```java
//login.java
public class login {
    public static void main(String[] args) {
        System.out.println(validation_code.create_validation_code());
        System.out.println(validation_code.create_validation_code());
        System.out.println(validation_code.create_validation_code());
        System.out.println(validation_code.create_validation_code());
        System.out.println(validation_code.create_validation_code());
    }
}
```

上面代码中的 validation_code.java 就是一个工具类。



**使用工具类的好处**

- 调用方便
- 提高了代码的复用性



**为什么工具类不使用实例方法**

因为静态方法可以被共享访问，且属于类，可以通过类名直接访问；

若使用实例方法，因为实例方法属于对象，每次访问方法都必须新建一个对象，通过对象来访问，造成内存空间的浪费。

建议创建工具类时，将构造器设置为私有，则外部不能创建该工具类的对象，避免了内存的浪费





## 13.6 static应用：代码块

**什么是代码块**

代码块是类的五大成分之一，定义在类中的方法外。

*类的五大成分：成员变量、构造器、方法、代码块、内部类



**代码块的分类**

- 静态代码块：static{}
  - 使用static关键字修饰，随着类的加载而加载，自动触发，只执行一次
  - 使用场景：在类加载时对静态数据进行初始化
- 构造代码块：{}
  - 每次创建对象，调用构造器执行时，都会先执行这段代码（在执行构造器之前）
  - 使用场景：初始化实例资源





## 13.7 static应用：单例设计模式

**什么是设计模式**

- 开发过程中对问题的最优解法被称为设计模式
- 设计模式共有20多种，对应开发过程中可能遇到的20多种问题



**设计模式要学什么**

- 这种模式用来解决什么问题
- 遇到这种问腿时，怎么使用这种模式



**什么是单例模式**

- 保证系统中应用该模式的类永远只有一个实例，即使用该模式的类永远只能创建一个对象

例如：操作系统中的“任务管理器”，只需要一个对象就能完成相关的任务。这么做可以节省内存空间。



### 13.7.1 饿汉单例设计模式

**什么是饿汉单例设计模式**

- 在用类创建对象的时候，对象已经提前创建好了



**设计步骤**

1. 定义一个类，把构造器设置为私有
2. 定义一个静态成员变量存储预先创建好的对象

实例：

```java
public class single_instance {
    //使用静态成员变量存储预先创建好的对象，保证外部获取的对象永远都是这一个
    public static single_instance instance = new single_instance();

    //把构造器私有化，使得外部无法使用该类创建对象，保证单例设计模式
    private single_instance() {

    }
}
```

```java
public class App {
    public static void main(String[] args) throws Exception {
        single_instance s1 = single_instance.instance;
        single_instance s2 = single_instance.instance;
        System.out.println(s1 == s2);	// >> true
    }
}
```

输出结果为true，说明变量s1和变量s2所存储的值相同，即s1和s2存储的地址相同，都指向堆内存中预先定义好的对象。







### 13.7.2 懒汉单例设计模式

**什么是 懒汉单例设计模式**

- 在需要这个对象的时候，才会创建这个对象（延迟加载对象）



**设计步骤**

- 定义一个类，将构造器设置为私有
- 定义一个静态成员变量，用于将来存储对象
- 提供一个用来返回对象的方法

实例：

```java
public class lazy_bones {
    //定义一个静态成员变量，用于将来存储对象
    public static lazy_bones lazy_bones_instance;

    //将构造器私有化，使得外部无法创建对象，保证单例设计模式
    private lazy_bones() {

    }

    //提供一个用于返回对象的方法
    public static lazy_bones get_nistance() {
        if (lazy_bones_instance == null) {		//只有静态成员变量为空的时候才会创建对象，保证单例的特征
            lazy_bones_instance = new lazy_bones();
        }
        return lazy_bones_instance;
    }
}
```

```java
public class App {
    public static void main(String[] args) throws Exception {
        lazy_bones s1 = lazy_bones.get_nistance();
        lazy_bones s2 = lazy_bones.get_nistance();
        System.out.println(s1 == s2);
    }
}
```







## 13.8 继承

**什么是继承**

- Java中提供了一个关键字 extends，通过这个关键字，可以让一个类与另一个类建立起父子关系
- 子类可以直接获得父类的公共属性和公共方法

例如：

```java
public class Student extends People{} 
```

- Student是People的子类，继承了People类的公共属性和方法，可以直接拿来使用。



**为什么要使用继承**

- 提高代码的复用性，解决代码重复的问题



**继承的设计规范**

- 各子类都具有的共同特征（共有属性、共有方法）放在父类中定义
- 子类独有的属性和方法应该在子类中单独定义



**实例**

![image-20220708175119999](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220708175119999.png)

```java
public class people {	//people类用于存储老师和学生共有的属性和方法
    String name;
    int age;
    public void query_course() {
        System.out.println(this.name + "在查看课表");
    }
}
```

```java
public class teacher extends people {	//teacher类继承于people类，可直接获得people类中的属性和方法
    String department;
    public void release() {
        System.out.println("老师" + name + "发布问题");
    }
}
```

```java
public class student extends people{	//student类继承于people类，可直接获得people类中的属性和方法
    String stu_class;
    public void write() {
        System.out.println("学生" + name + "填写听课反馈");
    }
}
```

```java
public class App {
    public static void main(String[] args) throws Exception {
        student stu = new student();
        stu.name = "王同学";
        stu.stu_class = "3班";
        stu.write();
        
        teacher te = new teacher();
        te.name = "李老师";
        te.department = "物理组";
        te.release();
    }
}
```





**继承的注意事项**

- 子类可以继承父类的属性和方法，但不能继承父类的构造器
- Java是单继承模式，一个类只能继承于一个直接父类，即一个类不能有多个父类
- Java不支持多继承，但支持多层继承，即一个类是一个类的子类的同时也可以是另一个类的父类
- Java中所有的类都是Object类的子类



**继承模式下访问成员变量/成员方法**

- 在子类中访问成员变量/成员方法满足：就近原则

  - 就近原则，子类中有该成员就是用子类中的，子类中没有就找父类，父类中也没有就报错

- 若子类和父类中有重名的成员，默认使用的是子类中的成员，若要访问父类中的成员，则按照以下格式：

  - ```java
    super.父类成员
    ```





**方法重写**

- 在继承体系中，子类中出现和父类中一模一样的方法声明，称子类的这个方法是重写的方法
- 应用场景：子类需要父类的功能，但父类中的该功能不完全满足子类的需求，此时子类可以重写父类中的方法
- @Override重写注解
  - @Override放在重写的方法上方，用于校验重写的方法是否正确
  - 加上@Override之后如果重写错误，编译阶段会报错
- 方法重写的注意事项
  - 重写方法的名称、形参列表必须和被重写方法一致
  - 私有方法不能被重写
  - 静态方法不能被重写





**子类继承父类后构造器的特点**

- 子类中所有的构造器默认都会先访问父类中的无参构造器，再执行自己。原因如下：
  - 子类在初始化的时候，有可能需要使用父类中的数据，若父类没有完成初始化，则无法使用父类中的数据，导致出错
  - 子类在初始化之前，先调用父类的午餐构造器，保证父类数据空间初始化完成
  - 子类构造器的第一行默认是 super(); ，代表父类的无参数构造器，即使不写也默认存在





**继承后子类访问父类的有参数构造器**

- super调用父类有参构造器的作用：
  - 初始化继承自父类的成员变量
  
- 语法格式：在子类中的构造器

  ```
  public 子类有参构造器名（形参1，形参2，……）{
  	super（形参1，形参2，……）;
  }
  ```

  

![image-20220710143901230](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220710143901230.png)

 







## 13.9 包

**什么是包**

- 包用于分类管理不同的类，相当于文件夹。使用包有利于程序的维护和管理

- 建包的语法格式：

  ```java
  package package_name;
  ```

  放在类的第一行，且package_name应与该类所在的文件夹（包）名字相同。建包过程一般由idea自动完成。



**导包**

- 相同包下的类可以直接调用，不同包下的类必须导包后才能调用

- 导包的语法格式：

  ```java
  import package_name.class_name;
  ```

- 静态导入可以直接导入某个类的静态方法或者是静态变量，导入后，相当于这个方法或是类在定义在当前类中，可以直接调用该方法。

  ```java
  import static com.test.ui.Student.test;
  
  public class Main {
      public static void main(String[] args) {
          test();
      }
  }
  ```

  





## 13.10 权限修饰符

![image-20220710150951033](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220710150951033.png)







## 13.11 final关键字

**什么是final**

- final关键字是最终的意思，可以修饰类、方法和变量
- final修饰的类，表示这个类是最终类，不能被继承
- final修饰的方法，表示这个方法是最终方法，不能被重写
- final修饰的变量，表示这个变量在第一次被赋值后，不能再次被赋值，即只能赋值一次



**final关键字修饰变量的注意事项**

- final修饰基本类型的变量：变量存储的数据值不能被改变
- final修饰引用类型的变量：变量存储的地址值不能被改变，但地址所指向的对象内容可以改变





## 13.12 枚举

**什么是枚举**

- 枚举是Java中的一种特殊类



**枚举的作用**

- 做信息的标志和信息的分类



**定义枚举的格式**

```
修饰符 enum 枚举名{
	该枚举类的实例名称
}
```

例如：

```java
enum Season{
	SPRING,SUMMER,AUTUMN,WINTER;
}
```



**枚举的特征**

- 枚举类都继承类枚举类型：java.lang.Enum
- 枚举类都是最终类，不能被继承
- 枚举类的构造器都是私有的，不能对外创建对象
- 枚举类的第一行默认都是列举枚举对象的名称，列举类几个对象，该类就只能有几个对象
- 枚举类相当于是多例模式



**枚举的使用\***







## 13.13 抽象类

**什么是抽象类**

- 在Java中，abstract是抽象的意思，可以修饰类和方法
- 使用abstract修饰的类称为抽象类；使用abstract修饰的方法称为抽象方法。声明抽象方法时不能写方法体。

```java
public abstact class Animal {
	public abstract void run();
}
```



**抽象类的作用**

- 类是对象的完整设计图
- 抽象类可以理解为对象的不完整设计图，一般作为父类，让子类来继承



使用场景：

当父类知道子类要完成某些行为，但每个子类对该行为的实现方式不同时，父类就把该方法定义成抽象方法，由子类继承之后对该方法进行重写。



注：

- 如果生命一个抽象方法，就必须把承载这个方法的类声明为抽象类
- 抽象方法没有方法体，所以抽象方法本身没有任何意义，抽象方法只有被重写之后，才有意义







## 13.14 接口

**什么是接口**

- 接口是一种规范，是抽象类的延伸，可以理解为纯粹的抽象类
- 接口用于约束某些行为，必须按照接口设置好的规则来实现
- 接口默认都是公开的，即接口中的变量和方法必须被定义为public或abstract形式
- 接口中定义的任何字段都是static和final的



**接口的定义格式**

```
public interface 接口名 {
	常量
	抽象方法
}
```

JDK8之前，接口中只有常量和抽象方法



**接口的基本使用**

- 接口是一种规范的思想，需要使用类来实现，即被类实现

  ```
  修饰符 class 实现类名 implements 接口1, 接口2, 接口3,... {
  	
  }
  ```

- 接口可以被类单实现，也可以被类多实现。即，一个实现类可以同时实现多个接口，同时继承多个接口的规范

实例：

- 接口：

  ```java
  public interface Sport_man {
      void trainning();
      void compete();
  }
  ```

- 实现类：

  ```java
  public class Pingpong_man implements Sport_man{
      String name;
  
      public Pingpong_man(String name) {
          this.name = name;
      }
  
      @Override
      public void trainning() {
          System.out.println(this.name + "正在训练");
      }
      @Override
      public void compete() {
          System.out.println(this.name + "正在比赛");
      }
  }
  ```

- 主类：

  ```java
  public class test {
      public static void main(String[] args) {
          Pingpong_man pm = new Pingpong_man("张继科");
          pm.trainning();
          pm.compete();
      }
  }
  ```

由实例可以看出，接口的做用就是比抽象类更为抽象的一种类，它是一种规范，约束开发人员实现某些具有共同特性的行为时，遵守相同的规范。

注意：一个类实现一个接口时，必须把接口的方法全部重写，否则这个类应该被定义为抽象类。





**接口与接口的关系**

- 接口之间可以实现多继承，即一个接口可以同时继承多个接口

接口多继承的作用：合并多个接口，便于子类实现







## 13.15 多态

**什么是多态**

- 多态就是指同类型的对象在执行同一个行为时，会表现出不同的行为特征



**多态的常见形式**

```
父类类型 对象名称 = new 子类构造器;
接口 对象名称 = new 实现类构造器;
```



**多态中成员访问的特点**

- 方法调用：编译看左边，运行看右边
- 变量调用：编译看左边，运行也看左边
- 多态是指行为的多态



**实现多态的前提**

- 有继承/实现的关系；有父类的引用指向子类的对象；有方法的重写



**多态的作用**

- 在多态的形式下，右边的对象可以实现解耦合，即减少对父类的依赖，便于扩展和维护
- 在定义方法时，使用父类型作为参数，该方法就能接受这个父类的一切子类对象



**多态的局限性**

- 多态下不能访问子类的独有行为



**多态的综合案例**

![image-20220714093108446](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220714093108446.png)

接口：

```java
package USB;

//使用接口来表示usb设备的guifan
public interface usb {
    void connet();
    void disconnet();
}
```

实现类：键盘

```java
package USB;

//定义实现类，表示键盘设备，它继承于usb接口
public class keyboard implements usb {
    //定义该键盘的名称，私有化进行封装
    private String name;
    //重写接口中的方法
    @Override
    public void connet() {
        System.out.println("键盘已插入");
    }
    @Override
    public void disconnet() {
        System.out.println("键盘已拔出");
    }
    //键盘的独有功能
    public void input() {
        System.out.println("键盘设备：" + this.name + "正在输入");
    }
    //封装时，提供setter和getter方法
    public void setName(String name) {
        this.name = name;
    }
    public String getName() {
        return this.name;
    }
    //提供无参构造器
    public keyboard() {

    }
    //提供有参构造器
    public keyboard(String name) {
        this.name = name;
    }
}
```

实现类：鼠标

```java
package USB;

public class mouse implements usb {
    //定义该鼠标的名称，私有化进行封装
    private String name;
    //重写接口中的方法
    @Override
    public void connet() {
        System.out.println("鼠标已插入");
    }
    @Override
    public void disconnet() {
        System.out.println("鼠标已拔出");
    }
    //鼠标的独有功能
    public void click() {
        System.out.println("鼠标设备：" + this.name + "正在点击");
    }
    //封装时，提供setter和getter方法
    public void setName(String name) {
        this.name = name;
    }
    public String getName() {
        return this.name;
    }
    //提供无参构造器
    public mouse() {

    }
    //提供有参构造器
    public mouse(String name) {
        this.name = name;
    }
}
```

主类：

```java
package USB;

public class test {
    public static void main(String[] args) {
        computer computer_1 = new computer("电脑1");
        
        usb u1 = new keyboard("键盘1");
        computer_1.install(u1);

        usb u2 = new mouse("鼠标1");
        computer_1.install(u2);
    }
}
```

测试效果：

![image-20220714100834513](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220714100834513.png)







## 13.16 内部类

**什么是内部类**

- 内部类就是定义在一个类里面的类，外层的类可以理解为为宿主，里层的类可以理解为为寄生

```java
public class People {
	public Heart {
		
	}
}
```

上面代码中的Heart类就称为内部类



**内部类的使用场景**

- 当一个事物的内部需要使用一个完整的结构进行描述，而这个内部的完整结构又只为其外部的这个事物提供服务时，这个内部的完整结构就可以通过内部类来设计
- 内部类可以访问其外部类的成员，包括私有成员
- 内部类提供了更好的封装性。一般情况下，外部类只能使用public来修饰，否则无法访问，但内部类可以使用private、protected进行修饰



**内部类的分类**

- 静态内部类（了解）

  - 由static修饰，属于外部类本身；静态内部类的特点与使用与普通类完全一致

  - 静态内部类的宿主是外部类

  - ```java
    public class Outer {
    	public static class Inner {
    	}
    }
    ```

  - 使用静态内部类来创建对象的格式

    ```java
    //格式：外部类名.内部类名 对象名 = new 外部类名.内部类的构造器。例如：
    Outer.Inner ob = new Outer.Inner()
    ```

    

- 成员内部类（了解）

  - 无static修饰，属于外部类的对象

  - 成员内部类的宿主是外部类的对象

  - jdk16之前，成员内部类中不允许定义静态成员，jdk16之后成员内部类中可以定义静态成员

  - ```java
    public class Outer {
        public class Inner {
        }
    }
    ```

  - 使用成员内部类创建对象的格式

    ```java
    //格式：外部类名.内部类名 对象名 = new 外部类构造器.new 内部类构造器。例如：
    Outer.Inner ob = new Outer().new Inner()
    ```

    

- 局部内部类（了解）

  - 局部内部类在方法、代码快、构造器等执行体中定义

- 匿名内部类（重点）

  - 匿名内部类本质上是一个没有名字的局部内部类，定义在方法、代码块中

  - 匿名内部类的作用是方便创建子类对象，最终达到简化代码的目的

  - 匿名内部类的格式

    ```java
    new 类名() {
    	重写的方法
    }
    ```

  - 匿名内部类写出来就会产生一个匿名内部类的对象







## 13.17 Object类

**什么是Object类**

- java中的所有类都是Object类的子类，Object类是java中最顶级的父类
- Object类的所有方法都可以直接使用



**Object类的常用API**

- public String toString()
  - 默认用于返回当前对象在堆内存中的地址信息：类的权限名@内存地址
  - 用于让子类重写，以便返回当前对象的内容

- public Boolean equals(object o)
  - 用于判断当前对象与对象o的地址是否相同，相同返回true,不同则返回false
  - 比较两个对象的地址是否相同，可以直接使用 == 来完成，所以equals存在的意义是让子类重写，以便比较两个对象的内容是否相同








## 13.18 StringBuilder类

**什么是StringBuilder**

- StringBuilder是一个可变字符串类，可以理解为一个对象容器
- StringBuilder提高了字符串的操作效率，如拼接、修改等



**StringBuilder的构造器**

- public StringBuilder()：创建一个空白的可变字符串对象，不包含任何内容
- public StringBuilder(String str)：创建一个指定字符串内容的可变字符串对象



**StringBuilder的常用方法**

- public StringBuilder append(任意类型)：添加数据并返回StringBuilder对象本身
- public StringBuilder reverse()：将对象内容反转
- public int length()：返回对象内容的长度
- public String toString()：把StringBuilder类型的对象转换成String类型的对象



**小知识：链式编程**

```java
StringBuilder sb = new StringBuilder();
sb.append("A");
sb.append(123);
sb.append(true);
sb.append(3.14);
System.out.println(sb);
```

```java
StringBuilder sb = new StringBuilder();
sb.append("A").append(123).append(true).append(3.14);
System.out.println(sb);
```

上边两段代码是等效的。



**StringBuilder性能更高的原理**

![image-20220716111132769](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220716111132769.png)

![image-20220716111159499](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220716111159499.png)

StringBuilder操作过程中，产生的对象更少。





## 13.19 Math类

Math类是一个工具类，提供了基本的数学运算方法。

Math不提供构造器。



**Math类的常用方法**

1、abs(x)  返回x这个数的绝对值。

2、copySign(x,y)  返回第一个参数的量值，第二参数的符号。

3、signum(x)  如果x大于0则返回1.0，小于0则返回-1.0，如果等于0则返回0.0

4、exp(x)  返回e的x次幂。

5、expm1(x)  返回e的x次幂 - 1。

6、ceil(x)  返回最近的且大于x的整数。

7、floor(x)  返回最近的且小于x的整数。

8、hypot(x,y)  返回x²+y²的二次方根。

9、sqrt(x)  返回x的二次方根。

10、cbrt(x)  返回x的立方根。

11、log(x)  返回以e为底的对数。

12、log10(x)  返回以10为底的对数。

13、log1p(x) 返回ln(x+1)

14、max(x,y)  返回较大值。

15、min(x,y)  返回较小值。

16、rint(x)  四舍五入，返回double值。如果居中0.5，则会取偶数。

17、round(x)  与rint用法相同，float返回值为int，double返回值为long。





## 13.20 System类

- System类的功能是通用的，直接使用类名进行调用即可；System类不能被实例化，即不能使用System类创建对象。



**System类的常用方法**

- public static void exit(int status)：终止当前运行的虚拟机，参数为0时表示正常退出，参数非0时表示异常退出
- public static long currentTimeMillis()：以毫秒值形式返回当前系统的时间（从1970-01-01 0:00到当前时刻经过的毫秒总数）
- public static void arraycopy(数据源数组q, 数据源数组的起始索引, 目的地数组, 目的地数组的起始索引, 拷贝个数)：拷贝数组





## 13.21 BigDecimal类

- BigDecimal类用于解决浮点数运算失真的问题



**使用步骤**

- 创建BigDecimal对象来封装浮点数

  ```java
  public static BigDecimal valueOf(double val);
  ```

- 调用BigDecimal类的API来对封装好的对象进行运算



**BigDecimal的常用API**

- public BigDecimal add(BigDecimal b)：加法
- public BigDecimal substract(BigDecimal b)：减法
- public BigDecimal multiply(BigDecimal b)：乘法
- public BigDecimal divide(BigDecimal b)：除法







# 十四、日期与时间



## 14.1 Date类

- Date类的对象代表的是系统当前的日期和时间



**Date类的构造器**

- public Date()：用于创建一个Date对象，代表系统当前的日期和时间
- public Date(long time)：把毫秒值转换成时间对象



**Date类的常用方法**

- public long getTime()：获取对象时间的毫秒值
- public long setTime(long time)：设置对象的时间为给定时间毫秒值对应的日期时间



## 14.2 日期时间格式化

**SimpleDateFormat的构造器**

- public SimpleDateFormat()：使用默认格式创建一个SimpleDateFormat对象
- public SimpleDateFormat(String pattern)：使用指定格式创建一个SimpleDateFormat对象



**SimpleDateFormat的格式化方法**

- public final String format(Date date)：将日期格式化成日期/时间字符串
- public final String format(Object time)：将时间毫秒值式格式化成日期/时间字符串

![image-20220716211702544](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220716211702544.png)

**另：EEE 表示星期几，a 代表上午或下午**

- public Date parse(String source)：从给定的字符串解析文本生成日期时间(被解析的时间字符串形式必须与要解析成的格式完全一致)



![image-20220717204411976](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220717204411976.png)

![image-20220717204541096](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220717204541096.png)

![image-20220718084410996](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220718084410996.png)

![image-20220718094057248](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220718094057248.png)





# 十五、包装类

**什么是包装类**

- 包装类就是8种基本数据类型所对应的引用类型

| 基本数据类型 | 引用数据类型 |
| ------------ | ------------ |
| byte         | Byte         |
| short        | Short        |
| int          | Integer      |
| long         | Long         |
| char         | Char         |
| float        | Float        |
| double       | Double       |
| boolean      | Boolean      |



**包装类的作用**

- Java中的一切都是对象，但8中基本数据类型不是对象，所以为这8中基本数据类型提供了对应的引用类型，可当作对象使用
- Java中的集合和泛型只支持包装类型，不支持基本数据类型



**基本类型和包装类型的转换**

- 自动装箱：基本类型的数据和变量可以直接赋值给包装类型的变量
- 自动拆箱：包装类型的变量可以直接赋值给基本类型的变量



**包装类的特有功能**

- 包装类的变量默认值可以是null,容错率更高
- 可以把基本类型的数据转换成字符串类型（用处不大）
  - 调用toString()方法得到字符串结果
- 可以把字符串类型的数据转换成真实的数据类型（用处很大）
  - Integer.parseInt("整型数据")
  - Double.parseDouble("浮点型数据")







# 十六、正则表达式

**什么是正则表达式**

- 正的表达式可以用一些规定好的字符来制定规则，并用这个规则来校验数据的合法性。

![image-20220718111031490](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220718111031490.png)



**实例：校验手机号码和电子邮箱**

```java
import java.util.Scanner;

public class Test2 {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);
        checkPhoneNumber(sc);
        checkEmail(sc);
        sc.close();
    }

    public static void checkPhoneNumber(Scanner sc) {
        while (true) {
            System.out.println("请输入手机号码:");
            String phoneNumber = sc.next();
            if (phoneNumber.matches("1[3-9]\\d{9}")) {
                System.out.println("手机号码格式正确!");
                break;
            }
            else {
                System.out.println("手机号码格式错误!");
            }
        }
    }

    public static void checkEmail(Scanner sc) {
        while (true) {
            System.out.println("请输入邮箱地址:");
            String email = sc.next();
            if (email.matches("\\w{1,30}@[a-zA-Z0-9]{2,20}(\\.[a-zA-Z0-9]{2,20}){1,2}")) {
                System.out.println("邮箱格式正确!");
                break;
            }
            else {
                System.out.println("邮箱格式错误!");
        }
        }
    }
}
```







# 十七、Arrays类

- Arrays类是数组操作的工具类，用于操作数组元素



**Arrays类的常用API**

- public static String toString(type  arrayName[])：返回数组内容
- public static void sort(type  arrayName[])：对数组进行排序（默认为升序）
- public static <T> void sort(类型 arrayName[], Comparator<? super>c)：使用比较器对象来自定义排序
- public static int binarySearch(int arrayName[], int key)：二分查找，找到则返回索引，否则返回-1
  - 若key不在数组中，返回的下标是key在数组中应该在的位置下标取负数后-1




**Arrays类对comparator比较器的支持**

- 自定义比较器只支持对引用对象的排序

```java
public static <T> void sort(类型 arrayName[], Comparator<? super>c)
//参数1：被排序的数组对象，必须是引用类型的元素
//参数2：匿名内部类对象，代表的是比较器
```

```java
import java.util.Arrays;
import java.util.Comparator;
//默认升序排序的写法
public class Test2 {
    public static void main(String[] args) {
        Integer arr[] = new Integer[] {12,32,23,2,45,9,87,55,31};
        Arrays.sort(arr, new Comparator<Integer>() {	//使用匿名内部类重写一个比较方法，返回值用于判断左右两个数的大小
            @Override									//Arrays类中的sort方法根据比较器的返回值来判断是否需要交换两个数
            public int compare(Integer o1, Integer o2) {
                if (o1 > o2)
                    return +1;
                else if ( o1 < o2)						//中间是判断的规则，反过来写就是降序排序
                    return -1;
                else
                    return 0;
            }
        });
        System.out.println(Arrays.toString(arr));
    }
}
```

以上代码也可以简写成：

```java
import java.util.Arrays;
import java.util.Comparator;
//默认升序排序的写法
public class Test2 {
    public static void main(String[] args) {
        Integer arr[] = new Integer[] {12,32,23,2,45,9,87,55,31};
        Arrays.sort(arr, new Comparator<Integer>() {	//使用匿名内部类重写一个比较方法，返回值用于判断左右两个数的大小
            @Override									//Arrays类中的sort方法根据比较器的返回值来判断是否需要交换两个数
            public int compare(Integer o1, Integer o2) {
				return o1 - o2;
            }
        });
        System.out.println(Arrays.toString(arr));
    }
}
```
















































