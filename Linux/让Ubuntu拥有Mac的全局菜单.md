# 让Ubuntu拥有Mac的全局菜单

用过Mac的小伙伴应该都知道，应用程序的菜单栏会显示在屏幕顶部的MenuBar中，而我在使用Ubuntu的时候就在想，能不能也让Ubuntu拥有这个看起来很高级的小玩意，于是我就在Google上发现了这个神器——Fildem。

项目地址：https://github.com/gonzaarcr/Fildem

先看效果：

![image-20221210233842627](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221210233842627.png)

![image-20221210233856801](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221210233856801.png)

![image-20221210233919030](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221210233919030.png)



废话话不多说，直接看步骤：

1、Ubuntu直接下载打包好的deb包：

```shell
wget https://github.com/gonzaarcr/Fildem/releases/download/0.6.7/fildem_0.6.7_all.deb
```

2、下载完成后安装：

```shell
sudo apt install fildem_0.6.7_all.deb
```

3、到gnome extension网站下载对应的插件：

```http
https://extensions.gnome.org/extension/4114/fildem-global-menu/
```

![image-20221210234400056](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221210234400056.png)

选择41-2版本下载。

4、下载完成后解压，并将解压后的文件夹重命名为 fildemGMenu@gonza.com 。

5、进入文件夹，编辑 metadata.json，改为下图的样子：

![image-20221210235112015](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221210235112015.png)

即在 shell-version 后追加 42, 43。

6、保存退出，将 fildemGMenu@gonza.com 文件夹移动到 ～/.local/share/gnome-shell/extensions 目录下。

7、设置开机自启：在 Stacer 中添加开机启动项 fildem，程序目录在 /usr/bin

![image-20221210235425472](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221210235425472.png)

8、保存，重启，享受！

![image-20221210235617113](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221210235617113.png)