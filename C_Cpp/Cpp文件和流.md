# C++文件和流

C++ 的 I/O 发生在流中，流是字节序列。如果字节流是从设备（如键盘、磁盘驱动器、网络连接等）流向内存，这叫做输入操作。如果字节流是从内存流向设备（如显示屏、打印机、磁盘驱动器、网络连接等），这叫做输出操作。



## C++的I/O库头文件

|   头文件    |                          函数和描述                          |
| :---------: | :----------------------------------------------------------: |
| \<iostream> | 该文件定义了 **cin、cout、cerr** 和 **clog** 对象，分别对应于标准输入流、标准输出流、非缓冲标准错误流和缓冲标准错误流。 |
| \<iomanip>  | 该文件通过所谓的参数化的流操纵器（比如 **setw** 和 **setprecision**），来声明对执行标准化 I/O 有用的服务。 |
| \<fstream>  | 该文件为用户控制的文件处理声明服务。我们将在文件和流的相关章节讨论它的细节。 |



**iostream**

iostream库提供了最基本的流操作：

**cout**

预定义的对象 cout 是 iostream 类的一个实例。

cout 对象”连接”到标准输出设备，与流插入运算符 << 结合使用

```c++
cout << "message" << endl;
```

**cin**

预定义的对象 cin 是 iostream 类的一个实例。

cin 对象附属到标准输入设备，与流提取运算符 >> 结合使用

```c++
cin >> variable;
```



若要使用C++操作文件，就需要另一个标准库 fstream，它定义了三个新的数据类型：

| 数据类型 |                             描述                             |
| :------: | :----------------------------------------------------------: |
| ofstream |   该数据类型表示输出文件流，用于创建文件并向文件写入信息。   |
| ifstream |        该数据类型表示输入文件流，用于从文件读取信息。        |
| fstream  | 该数据类型通常表示文件流，且同时具有 ofstream 和 ifstream 两种功能，这意味着它可以创建文件，向文件写入信息，从文件读取信息。 |



在操作文件前，要先打开一个文件流。

C++使用open()函数打开文件，其标准语法如下：

```c++
void open(const char *filename, ios::openmode mode);
```

注：第一参数指定要打开的文件的名称和位置，第二个参数定义文件被打开的模式

|  模式标志  |                             描述                             |
| :--------: | :----------------------------------------------------------: |
|  ios::app  |             追加模式。所有写入都追加到文件末尾。             |
|  ios::ate  |                  文件打开后定位到文件末尾。                  |
|  ios::in   |                      打开文件用于读取。                      |
|  ios::out  |                      打开文件用于写入。                      |
| ios::trunc | 如果该文件已经存在，其内容将在打开文件之前被截断，即把文件长度设为 0。 |



文件操作结束后，应当使用close()函数关闭文件流。



**对文件的读写实例：**

```c++
#include <iostream> // 基本输入输出流
#include <fstream>  // 文件流，用于处理文件
using namespace std;

int main() {
    // 创建文件操作句柄
    ofstream ft_out;
    // 以写模式打开文件
    ft_out.open("test_file", ios::out);
    // 读取键盘输入
    string data_out;
    cin >> data_out;
    // 将输入的数据写入文件
    ft_out << data_out << endl;
    // 关闭文件流
    ft_out.close();

    // 创建文件操作句柄
    fstream ft_in;
    // 以读模式打开文件
    ft_in.open("test_file", ios::in);
    // 读取文件数据
    string data_in;
    ft_in >> data_in;
    // 打印读取到的信息
    cout << data_in << endl;
    // 关闭文件流
    ft_in.close();
    return 0;
}
```







































