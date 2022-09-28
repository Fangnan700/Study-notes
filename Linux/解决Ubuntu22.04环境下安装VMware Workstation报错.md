# 解决Ubuntu22.04环境下安装VMware Workstation报错



**安装GCC**

```
sudo apt install gcc
```

**安装make**

```
sudo apt install make
```

**安装lib**

```
sudo apt-get install libaio1 libglib2.0-dev
```

**安装kernel modules**

手动安装内核主要是为了解决程序启动时vmware-host-modules的报错。

克隆项目至本地

```
git clone https://github.com/mkubecek/vmware-host-modules.git
```

进入项目文件夹

```
cd vmware-host-modules
```

切换至对应版本分支

```
git checkout workstation-16.2.4
```

编译vmware-host-modules

```
make
```

安装vmware-host-modules

```
sudo make install
```



