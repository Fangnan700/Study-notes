# Java网络编程笔记



## 什么是网络编程？

网络编程是指编写运行在多个设备（计算机）的程序，使这些设备通过网络连接起来，实现设备间的相互通信。

Java实现网络编程，可以通过调用Java提供的java.net包所提供的类和接口，而不必关心底层的实现。

java.net 包中提供了两种常见的网络协议的支持：

- **TCP**：TCP一种面向连接的、可靠的、基于字节流的传输层通信协议，TCP 层是位于 IP 层之上，应用层之下的中间层。
- **UDP**：UDP 是位于传输层的一个面向无连接的协议。提供了应用程序之间要发送数据的数据报。



## Java中的Socket编程

Socket（套接字）使用TCP协议提供了两台计算机之间的通信机制。 在Socket模式下实现通信，客户端程序创建一个套接字，并尝试连接服务器的套接字。当连接建立时，服务器会创建一个属于客户端的 Socket 对象。客户端和服务器可以通过对这个 Socket 对象的写入和读取来进行通信。

使用Socket套接字实现TCP通信的一般步骤：

1. 服务端创建一个 ServerSocket 对象，表示通过服务器上的端口进行通信。
2. 服务端调用 ServerSocket 类的 accept() 方法，该方法将一直等待，直到客户端连接到服务器上给定的端口。
3. 客户端创建一个 Socket 对象，指定服务器地址和端口号来请求连接。
4. Socket 类的构造函数将客户端连接到指定的服务器地址和端口。如果通信建立，则在客户端创建一个 Socket 对象与服务器进行通信。
5. 通信建立后，在服务器端，accept() 方法返回服务器上一个新的 socket 引用，该 socket 连接到客户端的 socket，服务端通过这个socket对象与客户端进行通信。

**连接建立后，通过使用 I/O 流进行通信，每一个socket都有一个输出流和一个输入流，客户端的输出流连接到服务器端的输入流，而客户端的输入流连接到服务器端的输出流。**



## 服务端

### ServerSocket类

服务器应用程序通过使用 java.net.ServerSocket 类以获取一个端口,并且侦听客户端请求。

**构造方法**

ServerSocket 类有四个构造方法：

| **序号** | **方法描述**                                                 |
| -------- | ------------------------------------------------------------ |
| 1        | **public ServerSocket(int port) throws IOException** 创建绑定到特定端口的服务器套接字。 |
| 2        | **public ServerSocket(int port, int backlog) throws IOException** 利用指定的 backlog 创建服务器套接字并将其绑定到指定的本地端口号。 |
| 3        | **public ServerSocket(int port, int backlog, InetAddress address) throws IOException** 使用指定的端口、侦听 backlog 和要绑定到的本地 IP 地址创建服务器。 |
| 4        | **public ServerSocket() throws IOException** 创建非绑定服务器套接字。 |































