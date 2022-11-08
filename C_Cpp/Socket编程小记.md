# socket编程小记

## TCP通信的基本流程

![image-20221108162719257](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221108162719257.png)



## socket网络编程相关的数据结构

地址结构：

```cpp
struct sockaddr_in {
    short int sin_family; 		 /* 地址族 */
    unsigned short int sin_port; /* 端口号 */
    struct in_addr sin_addr; 	 /* ip地址 */
    unsigned char sin_zero[8];
};
```

上述结构体涉及到的另一个结构体 in_addr 如下：

```cpp
struct in_addr {
    unsigned long s_addr;
};
```

in_addr是一个结构体，可以用来表示一个32位的IPv4地址。



## socket相关的函数

socket 函数：

```cpp
int socket( int domain, int type,int protocol)
/*
功能：创建一个新的套接字，返回套接字描述符
参数说明：
domain：域类型，指明使用的协议栈，如TCP/IP使用的是PF_INET，其他还有AF_INET6、AF_UNIX
type:指明需要的服务类型, 如
SOCK_DGRAM:数据报服务，UDP协议
SOCK_STREAM:流服务，TCP协议
protocol:一般都取0(由系统根据服务类型选择默认的协议)
*/
```

bind 函数：

```cpp
int bind(int sockfd,struct sockaddr* my_addr,int addrlen)
/*
功能：为套接字绑定地址
TCP/IP协议使用sockaddr_in结构，包含IP地址和端口号，服务器使用它来指明熟知的端口号，然后等待连接
参数说明：
sockfd:套接字描述符，指明创建连接的套接字
my_addr:本地地址，IP地址和端口号
addrlen:地址长度
*/
```

listen 函数：

```cpp
int listen(int sockfd,int backlog)
/*
功能：
将一个套接字置为监听模式，准备接收传入连接。用于服务器，指明某个套接字连接是被动的监听状态。
参数说明：
Sockfd:套接字描述符，指明创建连接的套接字
backlog: linux内核2.2之前，backlog参数=半连接队列长度+已连接队列长度；linux内核2.2之后，backlog参数=已连接队列（Accept队列）长度
*/
```

accept 函数：

```cpp
int accept(int sockfd, structsockaddr *addr, int *addrlen)
/*
功能：从已完成连接队列中取出成功建立连接的套接字，返回成功连接的套接字描述符。
参数说明：
Sockfd:套接字描述符，指明正在监听的套接字
addr:提出连接请求的主机地址
addrlen:地址长度
*/
```

send 函数：

```cpp
int send(int sockfd, const void * data, int data_len, unsigned int flags)
/*
功能：在TCP连接上发送数据,返回成功传送数据的长度，出错时返回－1。send会将数据移到发送缓冲区中。
参数说明：
sockfd:套接字描述符
data:指向要发送数据的指针
data_len:数据长度
flags:通常为0
*/
```

recv 函数：

```cpp
int recv(int sockfd, void *buf, intbuf_len,unsigned int flags)
/*
功能：接收数据,返回实际接收的数据长度，出错时返回－1。
参数说明：
Sockfd:套接字描述符
Buf:指向内存块的指针
Buf_len:内存块大小，以字节为单位
flags:一般为0
*/
```

close 函数：

```cpp
close(int sockfd)
/*
功能：撤销套接字。如果只有一个进程使用，立即终止连接并撤销该套接字，如果多个进程共享该套接字，将引用数减一，如果引用数降到零，则关闭连接并撤销套接字。
参数说明：
sockfd:套接字描述符
*/
```

connect 函数：

```cpp
int connect(int sockfd,structsockaddr *server_addr,int sockaddr_len)
/*
功能： 同远程服务器建立主动连接，成功时返回0，若连接失败返回－1。
参数说明：
Sockfd:套接字描述符，指明创建连接的套接字
Server_addr:指明远程端点：IP地址和端口号
sockaddr_len :地址长度
*/
```



## 第一个socket小程序

**服务端**

```c++
// 引入相关头文件
#include <sys/types.h>
#include <sys/socket.h>
#include <stdio.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <unistd.h>
#include <string.h>
#include <stdlib.h>
#include <fcntl.h>
#include <sys/shm.h>
#include <iostream>
using namespace std;

int main() {
	
	// 定义socketfd（socket文件句柄）
	int server_sockfd = socket(AF_INET, SOCK_STREAM, 0);
	
	// 定义sockaddr_in（套接字的地址形式，是一个结构体，用于存储通信需要的信息）
	struct sockaddr_in server_sockaddr;
	server_sockaddr.sin_family = AF_INET;	// 使用TCP/IP协议族
	server_sockaddr.sin_addr.s_addr = inet_addr("127.0.0.1");	// 绑定IP
	server_sockaddr.sin_port = htons(8023);    // 绑定端口
	
	// 使用bind()函数将地址信息绑定到socket文件句柄socketfd；成功返回0,失败返回-1。
	if(bind(server_sockfd, (struct sockaddr*) &server_sockaddr, sizeof(server_sockaddr)) == -1) {
		// 打印错误信息
		perror("bind");
		// 结束程序
		exit(1);
	}

	// 使用listen()函数将服务端设置为listen状态，监听等待客户端连接；成功返回0,失败返回-1。
	if(listen(server_sockfd, 20) == -1) {
		// 打印错误信息
		perror("listen");
		// 结束程序
		exit(1);
	}

	// 创建客户端套接字
	struct sockaddr_in client_addr;
	socklen_t length = sizeof(client_addr);

	cout << "服务器启动成功，等待客户端连接！" << endl;

	// 检测是否连接成功，成功返回非负描述字符，失败返回-1
	int conn = accept(server_sockfd, (struct sockaddr*) &client_addr, &length);
	if(conn < 0) {
		// 打印错误信息
		perror("connect");
		exit(1);
	} else {
		cout << "客户端已连接！" << endl;
	}


	// 创建接收缓冲区
	char buffer[1000];

	// 循环接收数据
	while(1) {
		memset(buffer, 0, sizeof(buffer));
		int len = recv(conn, buffer, sizeof(buffer), 0);
		// 客户端发送"exit"或出现异常时结束程序
		if(strcmp(buffer, "exit") == 0 || len <= 0) {
			cout << "客户端已断开！" << endl;
			break;
		}
		cout << "客户端发送消息：" << buffer << endl;
	}
	close(conn);
	close(server_sockfd);
	return 0;
}
```



**客户端**

```c++
// 引入需要的头文件
#include <sys/types.h>
#include <sys/socket.h>
#include <stdio.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <unistd.h>
#include <string.h>
#include <stdlib.h>
#include <fcntl.h>
#include <sys/shm.h>
#include <iostream>
using namespace std;

int main() {
	
	// 创建socket文件句柄
	int sock_cli = socket(AF_INET, SOCK_STREAM, 0);

	// 定义sockaddr_in，设置要连接到的服务器信息
	struct sockaddr_in seraddr;
	memset(&seraddr, 0, sizeof(seraddr));
	seraddr.sin_family = AF_INET;
	seraddr.sin_addr.s_addr = inet_addr("127.0.0.1");
	seraddr.sin_port = htons(8023);

	// 连接服务器，成功返回0，失败返回-1
	if(connect(sock_cli, (struct sockaddr*)&seraddr, sizeof(seraddr)) < 0) {
		perror("connect");
		exit(1);
	} else {
		cout << "连接服务器成功！" << endl;
	}

	// 创建缓冲区
	char sendbuf[100];
	char recvbuf[100];

	// 发送数据
	while(1) {
		memset(sendbuf, 0, sizeof(sendbuf));
		cin >> sendbuf;
		send(sock_cli, sendbuf, strlen(sendbuf), 0);
		if(strcmp(sendbuf, "exit") == 0) {
            cout << "bye" << endl;
			break;
		}
	}
	close(sock_cli);
	return 0;
}
```



**测试效果**

![image-20221108172739260](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221108172739260.png)





























