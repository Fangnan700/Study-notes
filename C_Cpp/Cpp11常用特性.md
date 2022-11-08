# C++11 常用特性



## 右值引用与 std::move

右值引用（rvalue reference）是 C++11 的新语言特性，某些场景使用 rvalue reference 有更高的性能。

**cpp11之前的字符串拷贝**

```c++
// 创建字符串对象tmp时，在栈内存中开辟了一段内存空间，存储字符串"hello"。
std::string tmp("hello");
// 调用string类的拷贝构造函数，将tmp作为参数，创建另一个字符串对象str并赋值为tmp的值"hello"。
std::string str(tmp);
```

这里拷贝赋值开辟了一段新的内存空间，操作完成之后，tmp就不再使用了，对内存空间造成浪费。

![image-20221108161024577](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221108161024577.png)

为了优化内存空间，C++11引入右值引用这一概念。

rvalue reference使用如下：

```c++
std::string tmp(“bert”);
std::string name(std::move(tmp));
```

使用 std::move() 来进行拷贝赋值时，是直接将name指向tmp所指向的内存空间，并不另外开辟内存空间。

![image-20221108161141285](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221108161141285.png)

如此一来，便提高了程序运行的效率。







## 智能指针

























































