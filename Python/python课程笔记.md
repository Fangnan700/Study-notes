---
title: Python学习笔记
date: 2022-03-01 09:29:54
tags: [Python, 学习笔记]
keywords: python
categories:
- Python
image: https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/python%E5%AD%A6%E4%B9%A0%E7%AC%94%E8%AE%B0/2022-03-26/python.jpg
top: 0
---

一些python的学习笔记。

<!-- more -->

# 一、基本数据类型

nunber、string、list、tuple、dict、set

### 1、number类型

主要包含:int、float、bool
bool类型在python中归纳为int的一个子类，值有两个：True / False

### 2、string类型

主要包含:字母、数字、下划线、汉字等
一般使用单引号或双引号来包裹字符或字符串。
可用三个单引号包裹多行字符串：

```python
 ‘’‘
 ABCD
 abcd
 ’‘’
```

### 3、list类型

列表用[]来表示,[]中可放字符、字符串、数字或是嵌套列表

### 4、tuple类型

元组使用()来表示,()中可放字符、字符串、数字或是嵌套元组。
元组是特殊的列表,其元素不可更改

### 5、dict类型

一般情况下，key使用字符串，需用引号括起来

### 6、set类型

集合使用{}表示，{}里直接放值
如：{123,abc,编程}







# 二、input输入函数

1、参数是提示信息
2、输入的内容使用变量接收。如：password = input("请输入密码：")
3、input函数执行完毕后返回的是字符串类型
4、input函数执行时，输入结束后按下回车键input()才会结束，进而执行下一段代码







# 三、python的数据类型转换

转换形式：int --> string    string --> int    bool --> int
在python中，字符串和整型不能直接进行数学运算

### 	1、int(x,base=10) 将其它类型转换为整型

参数： 1、x,要转换的数据变量  2、base = 10,以十进制（默认）转换为整型
不是所有类型都可通过int()转换为整型，如“python”转换时会报错。一般是数字字符串转换为整型 

### 	2、str(x) 将其它类型转换为字符串类型

参数： x,要转换的数据变量

### 	3、float(x) 将其它类型转换为浮点型

参数： x,要转换的数据变量
不是所有类型都可通过int()转换为整型，如“python”转换时会报错。一般是数字字符串转换为浮点型

### 	4、bool(x) 将其它类型转换为布尔型

python中bool类型有两个值：True 和 False（注意首字母大写）
数字0、空字符串、空列表、空元组、空字典、空集合等为False，其余为True
隐式类型转换，不通过bool()进行转换，一般用于条件表达式：如：“ 3>4 ” 为False，“1+1=2”为True

### 	5、list(x) 将其它类型转换为列表

 如：

```python
tup = (1,2,3)      //此时tup类型为tuple
list(tup)          //将tup类型转换为list
```

不是所有类型都可通过list()转换为列表，一般是字符串或元组转换为列表

### 	6、tuple(x) 将其它类型转换为元组

一般情况下，是字符串和列表转换为元组

注: type(x)可返回变量x的类型 







# 三、python的算术运算符

 	'+'(加法)   '-'(减法)   '*'(乘法)  '/'(除法)  '%'(取余或求模)  '**'(幂)  '//'(取整)

### 	算术运算符在字符串中的应用

```
 “hello" + "world" = "helloworld" (拼接字符串)
```

注意：python中，数字和字符串不能进行加法运算，只能是字符串和字符串拼接







# 四、python的赋值运算符

1、简单的赋值运算符: "=",表示把右边的值赋给左边的变量,和数学中的等好不同
2、复合运算符:  

```
'+='  '-='  '*='  '/='  '%='  '**='  '//='
```

 注意：pyhon中不支持‘++’ ‘--’操作







# 五、python的关系运算符

```
'>'  '<'  '>='  '<='  '=='  '!='
```

除数字外，字符串也可使用关系运算符进行操作，字符串比较时通过ASCLL码值进行比较







# 六、python的成员运算符

'in'(在指定序列中找到指定值则返回True,否则返回False)
'not in'(指定值不在指定序列中返回True,否则返回False)







# 七、python的逻辑运算符

'and'(且运算)  'or'(或运算)  'not'(非运算)

```
A and B ==> A和B同时为真时返回True,只要有一个为假,则返回False
A or B  ==> A和B有一个为真即返回True,同时为假才返回False
not A   ==> 对原来的结果取反
```

python的逻辑运算符可以操作任何类型的表达式，不论表达式是否为bool类型。

同时，其运算的结果也不一定为bool类型。

##### 	短路运算

python中的‘and’和‘or’不一定会计算右边表达式的值，有时只需计算左边表达式即可得出结果
‘and'和’or‘会将其中一个表达式的值作为最终结果，而不是True或False
​    





# 八、python的流程控制

####     1、顺序结构:

程序从头到尾执行每一条语句。不重复、不跳过任何一行代码。

####     2、分支结构(选择结构):

让程序有选择地执行某段代码。

######         单分支语句：  

```
if 条件:
	代码块  			//这里强制缩进,是python的语法特点,不需要花括号。
```

​        执行流程:若条件成立,则执行缩进的代码块,否则跳过。



######     	双分支语句：

```
if 条件:
	代码块1
else:
    代码块2
```

执行流程:若条件成立,则执行代码块1,否则执行代码块2。


######     	三元运算符:

三元运算符是对if..else..语句的简化
三元运算符的写法：

```
max = a if a > b else b
```

运算流程:若a>b成立,则把a赋给max,否则把b赋给max 



######     	多分支语句:

```
if 条件1:
	代码块1
elif 条件2:
	代码块2
elif 条件3:
    代码块3
else:
    代码块4
```

多分支语句中，只会执行其中满足条件的一项



######     if语句的嵌套

```
if 条件1:
	if 条件1.1:
		代码块1
	elif 条件1.2:
		代码块2:
	else:
        代码块3
else:
	if 条件2.1:
		代码块4
	else:
        代码块5
```

pass关键字,在python中没有任何意义,只用来实现单纯的占位,保证语句完整



#### 3、循环结构

######     while循环

语法：

```
初始条件
while 判断条件:
	代码块
    更新条件
```

break和continue关键字：

break指跳出循环不再执行。

continue指跳出此次循环，继续执行下一次循环。
​    

######     for循环

python中的for循环与其它语言不同，指的是for...in...循环。
语法：

```
for 元素 in 可迭代对象:         --->      for i in range(m,n)
	代码块                                   代码块
```

注意: 
1、python中的可迭代对象一般指字符串、列表、元组、集合等
2、python中使用for..in..循环时,一般需配合一个内置类range。
range可生成一个指定区间的序列。语法:range(m,n)  //生成区间为[m,n)的序列(左闭右开)
循环的嵌套:实际应用中，循环的嵌套层级不会超过三层







# 九、python的字符串

###     1、字符串的声明：

使用一对单引号/双引号/三引号进行声明
例如:

```
str1 = 'hello world'
str2 = "hello python"
str3 = '''hello code'''
```



### 	2、字符串的嵌套规则:

外层是单引号,内层只能是双引号。外层是双引号,内层只能是单引号。



### 	3、字符串的转义字符: 

\  (让符号失去原有的意义)

例如：

```
如要单独输出双引号,则应使用\""代替
\''   -->表示转义单引号
\""   -->表示转义双引号
\n    -->表示换行
\t    -->表示制表符(相当于tab键的作用)
```



### 	4、特殊字符

"r": 字符串前加r表示原样输出
"f": 字符串前加f表示支持花括号语法，即在字符串中嵌入变量
例如:  

```
name = "张三"
age = 18
print(f"我的名字是{name},年龄是{age}")
==>我的名字是张三,年龄是18
```



### 	5、字符串的下标和切片

下标(索引):表示第几个元素,默认从0开始。可通过下标获取指定位置的元素
例如：

```
str = "hello world"
print(str[4])
==>o
```

切片:从字符串中复制指定的一段内容,生成一个西的字符串
切片的语法:

```
str[start:end:step]
str表示要切片的字符串
start表示开始下标(包含开始下标的数据)
end表示结束下标(不包含结束下标的数据)
step表示步长，默认为1
```



### 	6、字符串的常见功能

#####     	1> 统计字符串长度 len()

例如: len(str)

#####     	2> 在整个字符串中,统计子串出现的次数 count()

例如: str.count(str1)  --> 统计在字符串str中，子串str1出现的次数

#####     	3> 字符串的大小写转换: upper() lower() swapcase() title()

例如: 

```
str1.upper()     -->将str1中的小写字母转换为大写字母
str2.lower()     -->将str1中的大写字母转换为小写字母
str3.swapcase()  -->将字符串中的大写字母转换为小写字母，小写字母转换为大写字母
str4.title()     -->将单词的首字母转换为大写
```

#####     	4> 查找字符串出现的位置: find() index()

find() 查找子串在字符串中第一次出现的位置。若找到，返回下标，否则返回-1。
例如: str.find("str1")  --> 寻找str1在str中第一次出现的位置
​        	

在指定范围内查找: str.find("x",start.end)

rfind() 查找子串在字符串中最后一次出现的位置。若找到，返回下标，否则返回-1。

index() 和find()功能类似，区别是若未找到即报错。

rindex() 和rfind()功能类似，区别是若未找到即报错。

#####   	  5> 字符串的提取: strip() lstrip() rstrip()

strip() 去除字符串两边的指定字符，默认为空格
例如: str.strip("x") -->去除str两边的x

lstrip() 只去除字符串左边的指定字符
rstrip() 只去除字符串右边的指定字符

#####     	6> 字符串的分割和合并: split() join()

split() 以指定字符对字符串进行风格，默认为空格
例如: str.split()

join() 合并字符串
例如: str.join(tup)  -->用str对tup进行拼接

#####    	 7> 字符串的替换和判断: 

replace() isupper() islower() isdigit() isTitle() isalpha()

replace() 将字符串中的指定内容进行替换
参数1:要替换的内容  参数2:替换后的内容  参数3:控制替换的次数
例如: str.replace("A","B",1)  -->将字符串str中的A替换成B，次数为1
isupper() 检测字符串中的字母是否全为大写，返回值为布尔型(True/False)
用法: str.isupper()

islower() 检测字符串中的字母是否全为小写，返回值为布尔型(True/False)
用法: str.islower()

isdigit() 检测字符串是否只由数字组成，返回值为布尔型(True/False)
用法: str.isdigit()

isTitle() 检测字符串中单词的首字母是否全为大写。

isalpha() 检测字符串中的字符是否全为字母、汉字或数字组成。



### 	7、字符串的编码、解码及ascii码的转换

//常用编码格式: GBK UTF-8

####     	1> encode() 编码

str.encode('utf-8')  --> 以UTF-8格式对字符串str进行编码

####     	2> decode() 解码

str.decode('gbk')    --> 以GBK格式对字符串str进行解码

####     	3> chr() 将ascii码值转换为对应的字符

chr(97)  --> ascii码'97'对应的字符为a

####     	4> ord() 将字符转换为对应的ascii码值

ord('a')  --> 97



### 	8、字符串的格式化输出

通过%占位符的方式进行输出

```
%     -->   占位符
%d    -->   表示整数
%f    -->   表示浮点数
%.2f  -->   表示按两位小数输出(小数位数可控)
%c    -->   表示单个字符
%s    -->   表示字符串
```

例如: 

```
name = '张三'
print("my name is:%s" %name)    //这里与C语言的区别在对变量的引用,需用%加持。
```

注:这里也可在字符串前加f，使其支持花括号语法进行占位。







# 十、列表(相当于C中的数组)

列表可以一次性保存多个数据,每一个数据叫做一个元素。列表使用[]来表示。
列表的索引可正可负,正数表示从左往右,负数表示从右往左。

#### 	定义列表:

```
list1 = ['A','1','你好']
```

 	列表中的元素可以是不同的数据类型，也可以是一个新的列表，即列表的嵌套。
 	获取/修改列表的元素是通过下标进行的，下标从0开始。

#### 	

#### 	遍历列表:

##### 	方式一

```
for i in list1:
	......
```

##### 	方式二(可同时遍历索引和值)

```
for index,value in enumerate(list1):
        ......
```

####     

#### 	列表的常见操作：

##### 	1、合并列表(通过'+'实现)

```
list1 = ['A','B','C']
list2 = ['a','b','c']
list3 = list1 + list2
```

##### 	2、判断指定元素是否在列表中

(通过成员运算符'in'或'not in'进行检查,返回值为True/False)

```
if 'str' in list1:
	......
```

#####     3、列表的切片

```
list1[start:end:step]
```

#####     4、列表元素的添加

方法一: append() 向列表尾部追加元素

```
list1.append("x")  		//向列表list1尾部追加元素x
```

 注意: 

1、append()追加单个元素时，直接把要追加的内容放到函数内即可。
2、append()一次性追加多个元素，需要以列表的形式追加，但原来的列表会变成二维列表。

​    

方法二: extend() 可以在列表尾部一次性追加多个元素且不改变原列表的维度，但仍需以列表的形式追加。

```
list1.extend(['x','y'])
```

用extend()追加一个元素，会对元素做一次拆分后追加



方法三: insert() 向列表的指定位置添加指定元素

```
list1.insert(参数1,"参数2")  	//参数一:追加的位置(某个下标前)  参数二:追加的内容
```

若要一次性追加多个元素，需要以列表的形式追加，但会改变原列表的维度。

#####     5、列表元素的删除

方法一: pop() 删除指定位置的元素

```
list1.pop(参数)  		//参数为要删除元素的下标。不填参数时默认删除最后一个元素
```

方法二: remove() 删除指定元素

```
list1.remove(参数)  	//参数为要删除的元素
```

方法三: clear() 清空列表

```
list1.clear()  		//清空整个列表
```

#####     6、列表元素的排序、反转和获取

######         列表的排序

方法一: sort()

```
list1.sort()  				//对原列表中的元素进行排序,默认为升序,不会生成新列表
list1.sort(reverse=True)  	//降序排列,传入参数reverse=True
```

方法二: sorted()

```
list2 = sorted(list1)  		//对原列表(list1)进行排序,默认为升序,会生成一个新列表,传递给list2。
list2 = sorted(list1,reverse=True)  //降序排列,传入参数reverse=True
list2 = sorted(list1,key=len)  		//添加key=len(排序依据),按照元素长度进行排序
```

######         列表的翻转

reverse() 翻转列表元素

```
 list1.reverse()
```

######         获取列表长度(获取列表的元素个数)

len()

```
len(list)
```

######         获取列表中元素的最大值/最小值

max() / min()

```
max(list) / min(list)
```

######         获取指定元素的索引

index()

```
list.index(x)  //获取元素x在列表list中的下标
```

#####     7、列表的嵌套

列表中的元素还是列表(相当于二维数组)，称为二维列表
访问二维列表的方式与C中访问而为数组元素的方式相同，即: 

```
list[m][n]
```

#####     8、列表生成式

```
1> list1 = list(range(start,end,step))   						//生成指定区间内整数组成的列表
2> list2 = [i ** 2 for i in range(start,end,step)]  	   //生成指定区间内整数的平方组成的列表
3> list3 = [i for i in range(start,end,step) if i %2 == 0]    //生成指定区间内的偶数组成的列表
```







# 十一、字典

字典相当于C语言中的结构体
字典用花括号标识
字典由键(key)和值(value)组成，健和值一一对应，由":"连接。不同键值对间用","隔开

```
dict1 = {"name":"张三", "age":18, "school":"清华大学"}
```

###     访问字典中的元素: 

```
1、通过索引的方式访问 --> 	dict1['key']
2、通过get()        -->     dict1.get('key')
```

### 	修改字典中的元素: 

```
dict1['key'] = '更改为的值'
```

### 	向字典中添加元素: 

```
dict1['新增加的key'] = '新增加的值'
```

### 	删除字典中的元素: 

```
1、pop()  		--> 	dict1.pop('key')  	//key为要删除元素的键
2、popitem() 	--> 	dict1.popitem() 	//删除字典的最后一对key:value
3、clear()   	--> 	dict1.clear()   	//清空字典
```

### 	字典的获取:

 	len() 获取字典的长度

```
len(dict1)  --> 统计键值对的个数
```

 	keys() 获取字典中所有的key

```
dict1.keys()
```

 	values() 获取字典中所有的value

```
dict1.value()
```

 	items() 获取字典中所有的key和value

```
dict1.items()
```

### 	遍历字典:

#### 	方式一:  直接遍历字典

```
for i in dict1:     //遍历字典中所有的key
	......
```

#### 	方式二:  enumrate()

```
for k,v in enumrate(dict1):     //遍历字典中所有的key及其下标
	......
```

#### 	方式三:  items()

```
for k,v in dict1.items():       //遍历字典中所有的key和value
	......
```

#### 	方式四： values()

```
for v in dict1.values():        //遍历字典中所有的value
	......
```

#### 	方式五:  keys()

```
for k in dict1.keys():          //遍历字典中所有的key
	......
```



### 	合并字典

 	update方法

```
dict1.update(dict2)         //把字典dict2追加到字典dict1后部
```







# 十二、集合

集合(set)是python中的一种数据类型，和数学中的集合类似

###      集合的特点：

1、无序     2、无重复

#### 		创建集合:

```
set1 = {value1, value2,....}    	//集合和字典的区别就是集合只有值(value),没有键(key)
```

注意:集合不能通过下标访问或修改(无序性)

#### 		获取集合的长度: len()

```
len(set1)   		//获取集合中的元素个数
```

#### 		向集合中添加元素: add()  update()

```
set1.add(value)     //向集合set1中添加值value,add()方法一次只能添加一个元素
set1.update(list)   //向集合set1中添加多个值,以列表list的形式添加
```

#### 		删除集合中的元素: pop()  remove()  discard()  clear()

```
set1.pop()              //随机删除集合中的一个元素
set1.remove(value)      //删除集合中值为value的元素,若删除不存在的元素会报错  
set1.discard(value)     //删除集合中值为value的元素,若删除不存在的元素不会报错
set1.clear()            //清空集合
```

#### 		遍历集合:

```
for i in set1:
	......
```







# 十三、元组

元组和列表类似，本质上是一种有序的集合。
元组和列表有区别: 

1、定义元组使用()，定义列表使用[]
2、元组中的元素不可修改，列表中的元素可修改

### 	创建元组:

```
tup = (value1, value2, ......)      //元组中的元素可以为任意类型
```

若创建元组时元组中只有一个元素,需要在该元素的后面加上一个逗号,否则不会被识别为元组

### 	访问元组: (和列表类似)

通过下标访问 tup[x]

### 	合并元组: 

 	通过‘+’来实现

```
tup = tup1 + tup2
```

### 	判断元素是否在元组中:

 	使用成员运算符‘in / not in‘

### 	元组的切片:

```
tup[start:end:step]
```

### 	获取元组的长度:

```
len(tup1)
```

### 	获取元组中元素的最大值/最小值:

```
max(tup)/min(tup)
```

### 	其它数据类型转换为元组

#### 	 tuple()

```
tup = tuple(list1)      //将列表list1转换为元组后传递给tup
```

### 	遍历元组:(与遍历列表类似)

#### 	直接遍历:

```
for v in tup1:
	......
```

#### 	enumrate():

```
for i,v in enumerate(tup1):     同时遍历元组的元素及其下标
	......
```







# 十四、赋值、浅拷贝、深拷贝

###      赋值: 本质上就是对象的引用

```
list1 = ['a', 'b', 'c']
list2 = list1
```

如此赋值，实际上是让list2指向list1中元素在内存的地址，即list1和list2共同指向内存中的同一个地方，所以当修改list1中的值时，list2的值也会被修改

### 	浅拷贝:

为了解决上述问题，可以使用浅拷贝(copy)的方法:
使用浅拷贝，需导入copy模块: import copy

```
import copy
list1 = [value1, value2, ......]
list2 = list1.copy()        			//如此操作后,开辟了一段新的内存空间,list1和list2的值就互不影响
```

浅拷贝可以解决一维列表的复制问题
对于二维列表，使用浅拷贝后，外部列表分别位于内存的不同空间，但内部列表的元素仍位于同一内存空间

### 	深拷贝:

使用深拷贝(deepcopy)可以解决二维(多维)列表修改元素时不能独立处理的问题。同样需要导入copy模块

```
import copy
list1 = [value1, value2, ......]
list2 = copy.deepcopy(list1)        //注意深拷贝的语法，与浅拷贝不同
```







# 十五、函数

函数要解决的问题: 1、重复的代码    2、程序的维护
===> 函数就是把在项目中经常使用的功能代码提取出来并封装，方便后续不同地方的调用。

### 	函数的基本语法:

```
def 函数名(参数1, 参数2, ......):
	函数体
```

 	使用def关键字来声明函数
 	函数由两部分组成: 声明部分和实现部分
 	函数定义时的参数，叫做形参，可写可不写，取决于函数功能
 	函数体要缩进
 	函数在使用前必须调用，调用格式: 函数名()
 	函数的调用必须在函数定义之后

### 	函数调用时的注意事项:

 	在同一个文件中，若出现定义的函数名相同的情况，后面定义的函数会覆盖前面定义的函数
 	若将函数名复制给一个变量，就可以通过这个变量来调用函数
 	函数必须先定义后使用

### 	函数的参数:

 	定义函数时传递的参数叫作形参
 	调用函数时传递的参数叫作实参，实参会取代形参的位置
 	若在定义函数时有形参，则在调用函数时必须传入实参，且实参和形参的数量必须相同

### 	函数中参数的类型:

 	a.必须参数  -->  在调用函数时,必须以正确的顺序传递参数
 	b.关键字参数  -->  使用关键字参数调用函数，允许实参和形参的顺序不一致

```
def f(x,y):
	......
f(y=value1, x=value2)
```

 	c.默认参数  -->  定义函数时若定义了默认参数，在调用时可以不传递实参，使用默认参数，而传递实参后，会覆盖默认参数。默认参数应置于参数列表末尾。

```
def f(x,y=5):
	......
f(6)				#函数f在定义时有两个形参，但有一个参数被定义为了默认函数，所以在调用该函数时可以只传递一个实参
```

​	 d.不定长参数:

```
*args 用来接收多个未知参数，得到的是一个元组。
def f(*args):        //如此定义后,调用函数时可以同时传递任意多个参数。不定长参数应置于参数列表末端。
	......

**kwargs 用来接收多个关键字参数，得到的是一个字典。在传递参数时，必须是以key=value的形式。
def f(**kwargs):
	......
f(key1=value1, key2=value2, ......)
```

### 	函数的返回值:

 	函数按照有无返回值分为两类: a.有返回值  b.无返回值
 	函数的返回值需要使用‘return’关键字进行返回,函数在哪里调用，函数的返回值就返回到哪里
 	函数的返回值使用，可以使用变量接收，也可以直接打印输出

```
def f():
	......
    return x
```

 	函数中的代码执行到return关键字之后就停止，return关键字之后的语句不会执行
 	函数中没有return关键字或没有数据返回，则默认返回 NULL
 	return 可以一次性返回多个数据，数据之间使用逗号隔开，返回的结果是一个元组

### 	函数的嵌套:

函数之间可以相互嵌套，即自定义函数内部可以调用其它函数

### 	匿名函数：

函数按照有无名字，分为两类: 有名函数和匿名函数
匿名函数是一个使用lambda定义的表达式，比普通函数简单。
lambda表达式中包含参数、函数体、返回值

```
num1 = lambda num:num ** 2      //参数为num.返回值为num**2
```

### 	回调函数：？

 	把一个函数f()作为一个参数传递到另一个函数中，那么f()称为回调函数

```
def f():
	......
def g(func):
    func()
g(f)            	//把函数f作为参数传入函数g,实现函数g对函数f的调用
```

### 	闭包函数：？

若一个函数内部嵌套了另一个函数，则外部函数称作外函数，内部的函数称作内函数
闭包: 若在一个外部函数中定义了一个内部函数，且外部函数的返回值是这个内部函数，则这个内部函数成为闭包
最简单的闭包:

```
def outer():
    def inner()
        ......
    return inner      		//注意: 这里返回的是函数体,不是函数的调用
fn = outer()            	//这里使变量fn指向inner函数
fn()                   		//这里就相当于调用的inner函数
```

闭包函数的特点: 内部函数可以使用外部函数的变量,闭包函数主要应用于装饰器函数的实现

### 	函数的作用域

分支语句和循环语句不存在作用域的问题，它们内部定义的变量可以在外部直接访问
函数内部定义的变量，在函数外部不能直接访问
函数内部可以直接访问函数外部的变量
若要在函数内部修改函数外部的变量，需要使用global关键字将函数内部的变量变为全局变量







# 十六、filter和map方法

filter在python3中是一个内置类,但仍以函数的方式调用
filter() 内置类有两个参数,第一个参数是一个函数,第二个参数是一个可迭代对象
filter()的返回值是一个filter类型的对象

map和filter的功能类似
map() 有两个参数,第一个参数是一个函数,第二个参数是一个可迭代对象
map()的返回值是一个map类型的对象
filter()适用于对可迭代对象中元素的筛选,map()适用于对可迭代对象中元素的处理







# 十七、装饰器

装饰器可以在程序运行过程中，动态地添加功能

###  	装饰器的常规写法:

```
def f1():
        ......
#这里的outer()就是一个装饰器,用于修改某个函数的功能
def outer(fn):               #fn表示形参，实际调用装饰器时，传入的实参是原函数的名字
	def inner():
	   	fn()				 #调用原函数
       	补充的功能语句         #给原函数添加功能
	return inner			 #闭包函数的写法，返回的是函数体，不是函数的调用，不加括号
  
f1 = outer(f1)
f1()
```

###  	装饰器的简化写法：

@ + 装饰器名称

```
def outer(fn):               #fn表示形参，实际调用装饰器时，传入的实参是原函数的名字
	def inner():
	   	fn()				 #调用原函数
       	补充的功能语句         #给原函数添加功能
	return inner			 #闭包函数的写法，返回的是函数体，不是函数的调用，不加括号

@outer       	#等价于f1 = outer(f1)，这是简化写法，表示给函数f1添加一个装饰器
def f1():		#使用简化写法时，原函数定义必须在装饰器函数下面，否则报错
	......
f1()			#经装饰器修饰、添加功能后，再次调用原函数
```

### 装饰器的其它用法：

##### 1、一个装饰器函数修饰多个函数

```
def outer(fn):
	def inner(*args):			#这里使用不定长参数，使得传入的原函数带有多少个参数都可以
		fn(*args)
		补充的功能语句
	return inner
@outer							#每次修饰前都调用一次装饰器函数即可
def f1(parameter1，parameter2)
	......
@outer
def f2(parameter1,parameter2,parameter3)
	......
f1(parameter1,parameter2)
f2(parameter1,parameter2,parameter3)
```

##### 2、一个原函数有多个装饰器函数修饰

```
def outer1(fn):					#定义第一个装饰器
	def inner1():
		fn()
		补充的功能语句
	return inner

def outer2(fn):					#定义第二个装饰器
	def inner2():
		fn()
		补充的功能语句
	return inner2

@outer1							#在定义原函数前，调用要使用的装饰器
@outer2							#修饰的顺序是：从离原函数近的装饰器开始
def f():						#不论有多少个装饰器，原函数只执行一次
	......
```







# 十八、python中的模块

### 1、模块的介绍及引用

##### 	python模块的简单介绍：

python中的模块可理解为具有不同功能的.py文件，但不是所有.py文件都能被当作模块导入使用。

能作为模块导入使用的.py文件必须遵循命名规则

python提供了很多内置模块可直接使用

##### 	常见的内置模块：

os、sys、re、math、random、datetime、time、calendar、hashlib、hmac等

##### 	调用模块的方式：

第一种：直接使用import关键字导入模块

```
import 模块名称
```

导入某个模块后，可以使用该模块下的方法

第二种：

```
from 模块名 import 该模块下的方法名
```

这种方法可以直接导入指定的方法，调用此方法时可直接使用，不用以模块.方法的方式使用

第三种：

```
from 模块名 import *		#此处的星号表示该模块下的所有方法和变量名
```

第四种：

```
import 模块名 as 别名   #as表示给导入的模块起一个新的名称，调用时可以直接使用别名
```

第五种：

```
from 模块名 import 方法名 as 别名   #as表示给导入的方法起一个新的名称，调用时可以直接使用别名
```



### 2、math模块的使用

math模块保存了数学运算的相关方法，主要用于数学运算的操作

使用前需要导入：

```
import math
```

math模块的常用方法：

```
math.fabs(x)			#取绝对值
math.ceil(x)			#向上取整
math.floor(x)			#向下取整
math.pi					#圆周率的值
math.pow(x,y)			#计算x的y次方
math.factorial(x)		#计算x的阶乘
......
```



### 3、os模块的使用

os模块主要用于获取系统的功能，操作文件或文件夹

使用前需要导入：

```
import os
```

os模块的常用方法：

```
os.curdir						 #获取当前目录
os.getcwd()						 #获取当前路径
os.mkdir("路径+文件夹名称")	    #创建文件夹，只能创建不存在的文件夹，不能创建已存在的文件夹
os.rmdir("路径+文件夹名称")	 	#删除文件夹，只能删除空文件夹
os.rename("原来的名字","新名字")    #重命名
os.remove("路径+文件名")			  #删除文件
os.path.join("路径1","路径2")	   #拼接路径
os.path.getsize("路径+文件名")	  #获取文件大小
os.path.isfile("路径+文件名")	  #判断是否为文件，返回值为True/False
os.path.isdir("路径+文件名")		  #判断是否为文件夹，返回值为True/False
os.path.exists("路径+文件名")	  #判断文件/文件夹是否存在，返回值为True/False
```

