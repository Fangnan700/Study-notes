# Linux网络编程基础API

**什么是scoket？**

在 UNIX/Linux 系统中，为了统一对各种硬件的操作，简化接口，不同的硬件设备也都被看成一个文件。对这些文件的操作，等同于对磁盘上普通文件的操作。

为了表示和区分已经打开的文件，UNIX/Linux 会给每个文件分配一个 ID，这个 ID 就是一个整数，被称为文件描述符。

UNIX/Linux 程序在执行任何形式的 I/O 操作时，都是在读取或者写入一个文件描述符。

一个文件描述符只是一个和打开的文件相关联的整数，它的背后可能是一个硬盘上的普通文件、FIFO、管道、终端、键盘、显示器，甚至是一个网络连接。所以说，在UNIX/Linux系统中，**网络连接也是一个文件**。

**socket（套接字）**

socket是在应用层和传输层之间的一个抽象层，它把TCP/IP层复杂的操作抽象为几个简单的接口供应用层调用以实现进程在网络中通信。



**Linux网络API分类：**

- socket地址API：socket最开始的含义就是一个 IP/端口对 (ip, port)，它唯一表示使用TCP通信的一端。
- socket基础API：对socket的基本操作，包括创建socket、命名socket、监听socket、接受连接、发起连接、读写数据、获取地址信息、检测带外标记，以及读取和设置socket选项。这些主要API都定义在 sys/socket.h 头文件中。
- 网络信息API：Linux提供了一套网络信息API，以实现主机名和IP地址之间的转换，以及服务名称和端口号之间的转换。这些API都定义在netdb.h头文件中。



## socket地址API

**字节序问题**

字节序，即数据在内存中的排列顺序，分为大端字节序和小端字节序。

- 大端字节序：表示整数的高位存储在内存的低地址处
- 小端字节序：表示整数的低位存储在内存的低地址处



**主机字节序和网络字节序**

现代PC大多采用小端字节序，因此小端字节序又被称为主机字节序。

为了解决不同PC机之间使用不同字节序而导致的数据错误问题，在网络通信中统一使用大端字节序进行传输，接收端再根据自身需要决定是否对数据进行转换，所以大端字节序又被称为网络字节序。



Linux提供了如下4个函数来完成主机字节序和网络字节序之间的转换：

```c++
#include <netinet/in.h>
// 长整型主机字节序转换为长整型网络字节序
unsigned long int htonl(unsigned long int hostlong);
// 短整型主机字节序转换为短整型网络字节序
unsigned short int htons(unsigned short int hostshort);
// 长整型网络字节序转换为长整型主机字节序
unsigned long int ntohl(unsigned long int netlong);
// 短整型网络字节序转换为短整型主机字节序
unsigned short int ntohs(unsigned short int netshort);
```

一般情况下，长整型函数通常用来转换IP地址，短整型函数用来转换端口号。



























































