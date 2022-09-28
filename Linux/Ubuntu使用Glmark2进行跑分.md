# Ubuntu使用Glmark2进行跑分

Glmark2 是一个基于 OpenGL 2.0 和 OpenGL ES 2.0 开发的benchmark程序，主要用于对GPU的基准测试。



## 安装和运行 Glmark2



### 安装依赖的开发工具

```
apt-get -y install git g++ build-essential pkg-config
```



### 安装依赖的程序库

```
apt-get -y install libx11-dev libgl1-mesa-dev
apt-get -y install libjpeg-dev libpng-dev
```



### 获取 glmark2 源代码 到当前 glmark2-test/ 目录

```
git clone https://github.com/glmark2/glmark2.git glmark2-test
```



### 编译 glmark2

```
cd glmark2-test
```

```
./waf configure --with-flavors=x11-gl --prefix=/opt/glmark2 --data-path=/opt/glmark2/data
```

```
./waf build -j 4
```

```
# 将编译好的文件安装到 Release 目录
./waf install --destdir=$PWD/Release
```



### 安装 glmark2

```
cp -RP ./Release/opt /
```



### 运行 glmark2

```
/opt/glmark2/bin/glmark2 
```

**运行过程**

![image-20220813221339435](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220813221339435.png)

**测试结果**

![image-20220813221430645](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220813221430645.png)



### 卸载glmark2

由于上面的安装方法是纯净的,可执行程序和数据文件没有安装到系统目录里，所以卸载方式很简单，直接删除安装目录即可。

```
rm -rf /opt/glmark2
```









