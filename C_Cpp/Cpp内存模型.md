![image-20221116142144027](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221116142144027.png)





# C++内存模型

## 内存分区

C++程序在执行时，将内存大方向划分为4个区域：

- 代码区：存放函数体的二进制代码，由操作系统进行管理的
- 全局区：存放全局变量和静态变量以及常量
- 栈区：由编译器自动分配释放，存放函数的参数值，局部变量等
- 堆区：由程序员分配和释放，若程序员不释放，程序结束时由操作系统回收



## 程序运行前后的内存分配

**程序运行前**

在程序启动但还未正式运行前，操作系统将开辟一段内存空间，加载程序并为内存进行分区，存放程序运行需要的不同数据。

在程序正式运行前，主要分为两个区域：

- 代码区： 存放 CPU 执行的机器指令。代码区有以下特点：
  - 共享：代码区内的数据可以被公开访问，使得对于频繁被执行的程序，只需要在内存中有一份代码即可，提高内存利用率，避免浪费。
  - 只读：防止程序代码被篡改
- 全局区：存放全局变量、静态变量和字符串以及由const修饰的常量。全局区内存在程序运行结束后由操作系统自动释放。



**程序运行时**

在程序正式运行时，操作系统又会新开辟两个内存空间，分别是栈区和堆区。主要用于存放程序运行时产生的数据。

- 栈区： 由编译器自动分配释放，存放函数的参数值，局部变量等。
- 堆区：由程序员手动分配释放，例如使用new操作符创建对象时，开辟的就是堆内存。



**验证**

```c++
#include <iostream>
using namespace std;

// 全局变量
int global_variable_a = 100;
int global_variable_b = 200;

// 全局常量
const int global_constant_a = 100;
const int global_constant_b = 200;

// 全局静态变量
static int global_static_a = 100;
static int global_static_b = 200;

int main() {

    // 局部变量
    int a = 100;
    int b = 200;

    // 局部静态变量
    static int static_a = 100;
    static int static_b = 200;

    // new操作符开辟的内存
    int* new_a = new int(100);
    int* new_b = new int(200);

    cout << "全局变量内存区：" << &global_variable_a << endl;
    cout << "全局变量内存区：" << &global_variable_b << endl;
    cout << endl;

    cout << "全局常量内存区：" << &global_constant_a << endl;
    cout << "全局常量内存区：" << &global_constant_b << endl;
    cout << endl;

    cout << "全局静态内存区：" << &global_static_a << endl;
    cout << "全局静态内存区：" << &global_static_b << endl;
    cout << endl;

    cout << "局部变量内存区：" << &a << endl;
    cout << "局部变量内存区：" << &b << endl;
    cout << endl;

    cout << "局部静态内存区：" << &static_a << endl;
    cout << "局部静态内存区：" << &static_b << endl;
    cout << endl;

    cout << "new操作符开辟的内存区：" << &new_a << endl;
    cout << "new操作符开辟的内存区：" << &new_b << endl;
    cout << endl;

    return 0;
}
```

![image-20221111192426873](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221111192426873.png)































