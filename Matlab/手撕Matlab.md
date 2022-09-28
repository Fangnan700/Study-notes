# 第一章：Matlab概述

## 1.1 Matlab系统环境

**MATLAB系统的组成**

- MATLAB开发环境
- MATLAB数学函数库
- MATLAB语言
- MATLAB图形处理系统
- MATLAB应用程序接口（API）



**MATLAB的搜索路径**

MATLAB将按照如下的顺序搜索命令对象：

![image-20220702185745059](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702185745059.png)



**设置MATLAB的搜索路径**

1. 使用path命令设置搜索路径

   ```matlab
   path(path, '绝对路径')
   ```

2. 使用对话框设置搜索路径

   ![image-20220702190350505](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702190350505.png)



**命令行**

在一行输入后，加上三个小数点（续行符）再按下回车，可在下一行继续输入



## 1.2 Matlab数据类型

### 1.2.1 数值数据

#### 整型

- 无符号整数：
  - 无符号8位整数
  - 无符号16位整数
  - 无符号32位整数
  - 无符号64位整数
- 带符号整数：
  - 带符号8位整数
  - 带符号16位整数
  - 带符号32位整数
  - 带符号64位整数

![image-20220702191421523](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702191421523.png)

使用转换函数可以将其它类型的数据转换成转换函数相对应的数据类型。





#### 浮点型

MATLAB中提供了单精度浮点数类型和双精度浮点数类型。

![image-20220702191802912](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702191802912.png)

MATLAB中默认数据类型是双精度型。

可以使用single函数来将其它类型的数据转换成单精度浮点数类型，使用double函数来将其它类型的数据转换成双精度浮点数类型。



注意：在MATLAB中，单精度浮点数类型不能与整数类型进行算术运算。

![image-20220702192247194](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702192247194.png)









#### 复型

复型数据即复数，包含实部和虚部两部分。

复数的实部和虚部均默认为双精度类型，虚数单位用 i 表示。

MATLAB提供对复数进行操作的相关函数：

![image-20220702192508145](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702192508145.png)





#### 无穷量

MATLAB中使用 Inf 和 -Inf 分别代表正无穷量和负无穷量。



#### 非数值量

MATLAB中使用 NaN 表示非数值量。



**数值数据的输出格式**

MATLAB中使用format命令来设置数值数据的输出格式，其语法如下：

```matlab
format 格式符
```

![image-20220702193034738](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702193034738.png)

输入format后不带格式符，则恢复默认输出格式。

format函数只影响数据的输出格式，不影响数据的精度与计算。



### 1.2.2 逻辑类型

逻辑类型的数据指的是布尔类型的数据和数据间的关系。

- 输入：非0值为真，0为假
- 输出：1为真，0为假



**关系运算符**

- 等于：==
- 大于：>
- 小于：<
- 大于等于：>=
- 小于等于：<=
- 不等于：~=



**逻辑运算符**

- 逻辑与：&
- 逻辑或：|
- 逻辑非：~



**逻辑运算函数**

- 异或运算：xor(x, y)	x和y同为假或真时返回0，否则返回1
- 判断零向量：any(x)   如果x是零向量或零矩阵（向量或矩阵中所有元素为0）则返回0，否则返回1



**其它逻辑运算函数**

![image-20220702194852636](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220702194852636.png)







### 1.2.3 字符型









## 1.3 MATLAB常用函数

MATLAB函数的调用格式：

```
函数名（函数自变量的值）
```



在MATLAB中，函数的自变量规定为矩阵变量，标量是矩阵变量的一种特殊形式。

函数在对变量进行运算时，是将函数逐项作用于矩阵的每个元素上，所以运算结果是一个与自变量同类型的矩阵。



**三角函数的应用**

MATLAB中，三角函数支持弧度和角度运算，默认以弧度运算，如：

```matlab
>> sin(pi/2)
ans = 
	1
```

若要以角度运算，就在函数名后加一个 d 来区分，如：

```matlab
>> sind(90)
ans = 
	1
```



**abs函数的应用**

abs函数可以求实数的绝对值、复数的模、字符串的ASCII码值。

```matlab
>> abs(-4)
ans = 
	4
```

```matlab
>> abs(3 + 4i)
ans = 
	5
```

```matlab
>> abs('a')
ans = 
	97
```



**取整函数的应用**

- round：四舍五入取整
- ceil：向上取整
- floor：向下取整
- fix：舍弃小数取整



**求余函数的应用**

- rem：
- mod：







