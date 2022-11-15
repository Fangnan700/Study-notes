# [ACTF2020 新生赛] Include

打开靶机发现页面只有一个 tips 超链接：

![image-20221014105551492](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014105551492.png)

打开超链接，发现页面并无特殊之处：

![image-20221014105756613](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014105756613.png)

注意到url中出现 ?file=flag.php ，考虑是PHP伪协议漏洞，于是构造payload：

```
?file=php://filter/read=convert.base64-encode/resource=flag.php
```

使用burpsuite的repeater模块加载构造好的payload：

![image-20221014110540400](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014110540400.png)

发现response中返回了一串字符串，经过base64解码，拿到flag：

![image-20221014110640434](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221014110640434.png)





# 补充知识：PHP伪协议

php://协议是php中独有的一个协议，可以作为一个中间流来处理其他流，进行任意文件的读取。

php://内包含若干协议：

| 协议                    | 作用                                                         |
| ----------------------- | ------------------------------------------------------------ |
| php://input             | 可以访问请求的原始数据的只读流，在POST请求中访问POST的`data`部分，在`enctype="multipart/form-data"` 的时候`php://input `是无效的。 |
| php://output            | 只写的数据流，允许以 print 和 echo 一样的方式写入到输出缓冲区。 |
| php://fd                | 允许直接访问指定的文件描述符。例如 `php://fd/3` 引用了文件描述符 3。 |
| php://memory php://temp | 一个类似文件包装器的数据流，允许读写临时数据。两者的唯一区别是 `php://memory` 总是把数据储存在内存中，而 `php://temp` 会在内存量达到预定义的限制后（默认是 `2MB`）存入临时文件中。临时文件位置的决定和 `sys_get_temp_dir()` 的方式一致。 |
| php://filter            | 一种元封装器，设计用于数据流打开时的筛选过滤应用。对于一体式`（all-in-one）`的文件函数非常有用，类似 `readfile()`、`file()` 和 `file_get_contents()`，在数据流内容读取之前没有机会应用其他过滤器。 |



**这里用到的 php://filter协议：**

用于读取源代码并进行base64编码输出，参数说明如下：

resource=<要过滤的数据流> 这个参数是必须的。它指定了你要筛选过滤的数据流；

read=<读链的筛选列表> 该参数可选。可以设定一个或多个过滤器名称，以管道符（|）分隔；

write=<写链的筛选列表> 该参数可选。可以设定一个或多个过滤器名称，以管道符（|）分隔。



```
?file=php://filter/read=convert.base64-encode/resource=
```

这种构造方式非常常见，用于获取文件源码。



**文件包含漏洞**

文件包含漏洞的产生原因是在通过 PHP 的函数引入文件时，由于传入的文件名没有经过合理的校验，从而操作了预想之外的文件，就可能导致意外的文件泄露甚至恶意的代码注入。





































