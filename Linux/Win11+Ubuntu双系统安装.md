



# 准备工作

## 一、系统镜像下载

此次安装使用**Windows11 21H2**版本和**Ubuntu 20.04**版本。

Windows 11下载地址：

[https://next.itellyou.cn/Original/#cbp=Product?ID=42e87ac8-9cd6-eb11-bdf8-e0d4e850c9c6](https://next.itellyou.cn/Original/#cbp=Product?ID=42e87ac8-9cd6-eb11-bdf8-e0d4e850c9c6)

Ubuntu 20.04下载地址：

https://ubuntu.com/download/desktop



## 二、相关工具

准备两个16G以上的U盘，一个使用微PE工具制作成PE启动盘后拷入Windows11的镜像文件，另一个使用Rufus工具写入Ubuntu20.04镜像文件，配置如下：

```
分区类型：GTP
目标系统类型：UEFI(非CSM)
```

写入方式使用默认的以iso模式写入即可，如遇引导问题再切换至以DD模式写入。



# 系统安装

## 一、系统分区

此次安装在空白硬盘上进行，若已安装有Windows系统且要保留，跳过Windows安装即可。

在PE系统下使用DiskGenius对磁盘进行分区，此次配置如下:

​    1、ESP：300Mb（用于放置系统引导文件）

​    2、NTFS：220Gb （用于安装Windows11）

​    3、空白： 256Gb （用于后续安装Ubuntu）



## 二、安装Windows11

从BIOS中使用制作好的PE启动盘启动，进入PE环境，使用Windows安装器进行安装：

①镜像文件选择拷至U盘的Windows11.iso文件

②EFI安装目录选择设置好的ESP分区

③Windows安装目录选择设置好的NTFS分区

④系统版本按需求选择，推荐使用Windows11专业版

⑤系统镜像应用完成后重启进入Windows11的安装界面，按引导进行即可。

完成基本安装后关机。



## 三、安装Ubuntu20.04

从BIOS中使用制作好的UbuntuU盘启动，进入Ubuntu安装界面。

选择最小安装，取消安装Ubuntu时更新。

安装类型选择“其他选项”，否则可能会导致已安装的Windows系统丢失。

设置分区，一般划分一个分区挂载到根目录即可。

安装启动引导器的设备选择安装Windows划分的ESP分区。





# 系统优化

## 一、Windows11

### 1、系统激活

开始相关设置之前，首先应对系统进行激活。已有微软账户并且可用账号关联激活的跳过。这里使用HEU KMS Activator进行激活，使用前应将Windows安全中心相关组件关闭。然后打开在线KMS服务器选项，点击开始即可。



### 2、系统升级

使用微软账号登录后，通过系统升级工具将系统升级至最新版本，可避免一些已知的bug。



### 3、驱动安装

安装系统时大部分驱动已自动适配，这里使用笔记本官方提供的驱动进行二次安装，主要保证CPU、显卡、电源管理等功能正常。在设备管理器中查看，无感叹号或未识别设备即可。



### 4、卸载无用软件

推荐使用"geek"来卸载系统中的多余软件，卸载结束后会自动扫描残余项，卸载更为彻底。



### 5、清理电脑垃圾，优化系统

刚安装的系统经过安装、升级之后，系统中存在着许多无用的文件，将它们删除。

①使用Dism++释放系统空间

打开Dism++，选择空间回收，勾选所有项，清理

②使用Wise Registry Cleaner清理注册表和优化系统

打开Wise Registry Cleaner，选择深度扫描，勾选所有项，点击开始清理。

切换到系统优化，勾选所有项，点击一键优化。



## 二、Ubuntu

###  1、更换软件源

由于ubuntu默认源是国外的服务器，上下行速度均较慢，所以需要将软件源更换至国内的镜像站。

国内常用的镜像站有：

1）清华开源镜像站：https://mirrors.tuna.tsinghua.edu.cn/

2）科大开源镜像站：https://mirrors.ustc.edu.cn/

3）阿里巴巴开源镜像站：https://developer.aliyun.com/mirror/

4）网易开源镜像站：http://mirrors.163.com/

注：不同版本的Linux镜像源不同，不同版本的ubuntu镜像源也有区别，要注意与版本与源的匹配。

 打开文件管理器，找到以下目录：

```
/etc/apt
```

将sources.list文件复制到文档目录备份

在apt文件夹中打开终端，输入以下代码：

```
sudo gedit sources.list
```

打开sources.list文件，将里面所有内容删除，然后把刚才找到的源地址复制进去，保存。

回到终端，输入以下命令：

```
sudo apt-get update
sudo apt-get upgrade
```

至此，软件源更换完成，软件包更新完成。



### 2、显卡驱动安装

众所周知，linux对显卡的兼容始终不太友好，使用开源驱动电脑续航简直不能再短了，所以需要安装专有驱动。

直接在启动器中找到附加驱动，打开后选择最新版本的驱动，应用更改即可。



###  **3、双系统时间同步**

安装完双系统之后会发现一个问题：Ubuntu下显示时间是正常的，但重启进入Windows系统时发现，Windows系统的时间慢了，而且不多不少刚好8个小时。这是因为Windows与Liunx看待系统硬件时间的方式不一样。Windows把计算机硬件时间当作地方时(Local time)，即东八区时间。但Linux把计算机硬件时间当作世界统一时间(UTC)，所以Linux系统时间会在硬件时间基础上增加电脑设置的时区数(东八区就加上8)。所以Linux时间设置正确，相对应的Windows时间就会慢8小时。

解决方法如下：

打开Linux终端，输入以下命令：

```
sudo apt-get update
sudo apt-get install ntpdate
sudo ntpdate time.windows.com
sudo hwclock --localtime --systohc
```

之后重启即可。



### 4、系统界面美化

需要用到的工具和网站：

主题修改工具：GNOME Tweaks 通过以下命令安装：

```
sudo apt-get update
sudo apt-get install gnome-tweak-tool
```

主题下载网站：https://www.opendesktop.org/s/Gnome/browse/

扩展安装网站：https://extensions.gnome.org/

**1）桌面样式修改**

使用火狐浏览器打开扩展安装网站，点击"Click here to install browser extension"

安装完之后浏览器右上角会有个脚丫子。

重新打开浏览器，打开扩展安装网站，分别搜索安装以下三个插件 ：

```
user themes、dash to dock、hide top bar
```

安装方法：点击搜索到的插件，进入详情页，点击右上角的开关即可。

打开主题下载网站，下载相关主题：

“Full Icon Themes”指的是桌面图标主题

“GDM Themes”指的是登陆界面主题

“GRUB Themes”指的是引导菜单主题

“GTK3/4 Themes”指的是桌面窗口主题。

将主题下载至一个文件夹，然后在此文件夹打开终端，输入以下命令：

```
sudo cp BigSurIcon.tar.xz /usr/share/icons
sudo cp WhiteSur-dark.tar.xz /usr/share/themes
```

切换至icons文件夹

```
cd /usr/share/icons
```

将压缩包解压

```
sudo xz -d BigSurIcon.tar.xz
sudo tar xfv BigSurIcon.tar![点击并拖拽以移动](data:image/gif;base64,R0lGODlhAQABAPABAP///wAAACH5BAEKAAAALAAAAAABAAEAAAICRAEAOw==)
```

切换至themes文件夹

```
cd /usr/share/themes
```

将压缩包解压

```
sudo xz -d WhiteSur-dark.tar.xz
sudo tar xfv WhiteSur-dark.tar
```

打开“优化”程序，在“外观”中将应用程序、图标、shell分别设置为刚才安装好的主题即可。

在“优化”程序中找到扩展程序一栏，确保上述插件处于开启状态。



**2）引导菜单样式修改**

回到下载的文件夹，将GRUB主题的压缩文件解压到当前文件夹，然后点击进入，发现有一个文件夹和一个脚本文件，在此文件夹打开终端，输入以下命令：

```
sudo bash install.sh
```

按提示往下即可。

至此，系统的桌面壁纸、任务栏、图标以及系统引导菜单的样式都已设置完毕。



**3）登录界面背景修改**

还有一项设置，就是登陆界面的背景的修改。

Ubuntu默认的登陆界面是一片紫，实在难看，我们可以通过一个脚本来对其进行修改。脚本下载地址：[https://gitcode.net/mirrors/thiggy01/ubuntu-20.04-change-gdm-background?utm_source=csdn_github_accelerator&from_codechina=yes](https://gitcode.net/mirrors/thiggy01/ubuntu-20.04-change-gdm-background?utm_source=csdn_github_accelerator&from_codechina=yes)

将下载好的脚本解压，进入其文件夹，打开终端，输入以下命令：

```
sudo chmod 777 change-gdm-background
sudo ./change-gdm-background /path/to/image/aswca.jpg
```

这里将/path/to/image/aswca.jpg替换为想要的图片路径及名称即可。

执行完成后提示注销重新登陆，这里建议直接重启，否则会无限循环在登陆界面。

重启之后就会得到一个看起来像极了Mac的Linux系统，看起来舒服多啦！
 

**至此，Windows11和Ubuntu20.04就安装好啦，Enjoy it！**