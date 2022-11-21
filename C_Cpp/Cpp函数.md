# Cpp函数

## 函数基础

### 函数的定义

最基本的函数定义由以下几部分组成：

```
返回值类型 函数名称 (形参列表) {
	函数体;
}
```

函数进行的操作在函数体中声明。



### 函数的声明

与变量类似，一个函数只能定义一次，但可以声明多次。

函数的声明应当在头文件中完成，而函数的定义应当在源文件中完成，定义函数的源文件应当包含声明函数的头文件。



### 函数的调用

函数调用通常分为几个步骤：

1. 使用调用运算符调用函数，一般是一对圆括号，所用于一个表达式，该表达式是指向被调函数的指针，圆括号内是实参；
2. 使用实参初始化对应的形参；
3. 将控制权移交给被调函数，主调函数暂时中断，被调函数开始执行；
4. 若被调函数有返回值，则通过 return 语句将返回值返回给主调函数；
5. 将控制权移交回主调函数，使用被调函数的返回值初始化调用表达式的结果。



**注意事项**

1. 函数的形参列表可以为空，但是不能省略；
2. 实参是形参的初始值，必须一一对应；
3. 函数的任意两个形参不能同名。



### 函数的参数传递

**C++函数的参数传递有3种方式**

- 值传递
- 指针传递
- 引用传递

形参的类型决定了实参与形参交互的方式。



**值传递**

当使用值传递时，会先计算出实参的值，并为形参开辟一段新的内存空间（栈区），将实参的值拷贝到形参的内存上。也就是说，使用值传递时，函数操作的是实参的副本，并不直接操作实参，也就不能改变实参的值。

使用实例：

```cpp
#include <iostream>
using namespace std;

void function(int variable) {
    variable += 100;
}

int main() {
    int variable = 100;
    function(variable);
    cout << "The variable's value is " << variable <<  endl;
    return 0;
}
```

![image-20221116112336272](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221116112336272.png)

可以看到，使用值传递时，不会影响实参本身。



**指针传递**

当使用指针传递时，传递给形参的是实参的内存地址，使得形参和实参指向同一段内存空间，函数通过形参的地址获取数据并对其进行操作。也就是说，使用指针传递时，函数直接操作实参本身，会影响实参的值。

使用实例：

```cpp
#include <iostream>
using namespace std;

void function(int* variable) {
    *variable += 100;
}

int main() {
    int variable = 100;
    function(&variable);
    cout << "The variable's value is " << variable <<  endl;
    return 0;
}
```

![image-20221116112912693](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221116112912693.png)

可以看到，使用指针传递时，会影响实参本身。



**引用传递**

引用传递可以理解成指针传递的简化版，本质上还是指针传递。若在程序成反复使用指针传递，不仅降低了可读性，而且有可能造成意外的错误，而引用机制的出现弥补了这一不足。使用引用传递参数，仍然会影响实参本身。

使用实例：

```cpp
#include <iostream>
using namespace std;

void function(int& variable) {
    variable += 100;
}

int main() {
    int variable = 100;
    function(variable);
    cout << "The variable's value is " << variable <<  endl;
    return 0;
}
```

![image-20221116113411263](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221116113411263.png)







## 函数提高

### 函数的默认参数

在C++中，函数的形参列表中的形参是可以有默认值的。

定义含有默认参数的函数语法如下：

```
返回值类型 函数名称(形参类型 形参名称=默认值) {
	函数体;
}
```

**注意事项：**

1. 形参列表中，某个位置的形参有默认值，则该位置之后的所有形参都必须有默认值；
2. 如果在声明函数的时候，为某个形参设置的默认值，那么在函数体中就不能再为这个形参设置初始值。



### 函数的占位参数

C++中函数的形参列表里可以有占位参数，用来做占位，调用函数时必须填补该位置。

语法：

```
返回值类型 函数名(数据类型) {
	函数体;
}
```



### 函数的数组形参

因为在C/C++中，数组无法进行直接拷贝，所以将数组作为参数传递给函数时，数组名会退化成指向数组首地址的指针。也就是说，无法以值传递的形式将数组传递给函数。

正因为将数组传递给参数时，数组名已经退化成指向数组首地址的指针，因此无法将数组的附加信息（如数组大小等）传递给函数，因此在函数的形参列表中应当单独为数组的附加信息提供形参。



使用实例：

```cpp
#include <iostream>
using namespace std;

void function(int arr[], int length) {
    for(int i = 0; i < length; i++) {
        cout << "index " << i << ": " << arr[i] << endl;
    }
}

int main() {
    int arr[] = {1,2,3,4,5,6,7,8,9,10};
    function(arr, 10);
    return 0;
}
```

![image-20221116114510299](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221116114510299.png)



除了退化成指针进行参数传递之外，还可以直接通过指针传递的方式传递数组。

```cpp
#include <iostream>
using namespace std;

void function(int *arr, int length) {
    for(int i = 0; i < length; i++) {
        cout << "index " << i << ": " << arr[i] << endl;
    }
}

int main() {
    int arr[] = {1,2,3,4,5,6,7,8,9,10};
    function(arr, 10);
    return 0;
}
```



也可以通过引用传递。

```cpp
#include <iostream>
using namespace std;

void function(int (&arr)[10]) {
    int length = sizeof(arr) / sizeof(int);
    for(int i = 0; i < length; i++) {
        cout << "index " << i << ": " << arr[i] << endl;
    }
}

int main() {
    int arr[] = {1,2,3,4,5,6,7,8,9,10};
    function(arr);
    return 0;
}
```

需要注意的是，通过引用传递数组是，可以传递数组的附加信息，因此需要在形参列表中写出数组的大小，传入的数组大小必须与形参列表里的一致。

由于引用传递的本质还是指针传递，所以在函数内部使用sizeof()函数时，获取的是整个用于存储数组的内存空间的大小，而不是数组的元素个数。



### 函数重载

**函数重载的特征**

- 在同一作用域（一般是同一个类中）
- 函数名称相同
- 函数形参列表不同（形参类型、个数、顺序不同）
- 不受返回值类型影响



**函数重载的本质**

在编译阶段，同一作用域中存在同名函数时，编译器根据函数形参列表的不同为这些函数进行重命名。编译器不同，命名规则也不同。



### 函数重写

**函数重写的特征**

- 必须在不同作用域中（一般是基类与派生类中）
- 派生类中重写的函数与基类中的函数具有**相同的返回类型、相同的名称、相同的形参列表**，唯一不同的是函数具体实现



### 函数重定义

**函数重定义的特征**

- 作用域不同（一般是基类与派生类中）
- 名称必须相同
- 形参列表和返回值可以不同
- 基类中的同名函数仍然存在于派生类中



### main: 处理命令行选项

可以在命令行中，向main函数传递参数。使用方法如下：

```cpp
int main(int argc, char* argv[]) {
	函数体;
}
```

第一个参数 argc 是一个整数，表示形参数组 argv 中字符串的数量。

第二个参数 argv 是一个数组，数组元素是指向字符串的指针。

当实参传递给main函数后，argv的第一个元素指向程序的名字或者一个空字符串，接下来的元素依次传递命令行提供的实参。

最后一个指针之后的元素值保证为0。





































