# Ubuntu 22.04 安装Fcitx5中文输入法

## 一、检查系统中文环境

在 Ubuntu 设置中打开「区域与语言」—「管理已安装的语言」，然后会自动检查已安装语言是否完整。若不完整，根据提示安装即可。

![image-20220518204815508](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220518204815508.png)



## 二、安装Fcitx5

最小安装即可，需要三部分内容：

1. Fcitx 5 主程序
2. 中文输入法引擎
3. 图形界面相关

```shell
sudo apt install fcitx5
sudo apt install fcitx5-chinese-addons
sudo apt install fcitx5-frontend-gtk3 fcitx5-frontend-gtk2
sudo apt install fcitx5-frontend-qt5 kde-config-fcitx5
```



## 三、配置默认输入法

使用im-config工具配置首选项，在任意命令行输入：

```
im-config
```

根据弹出窗口的提示，将首选输入法设置为 Fcitx 5 即可。

![image-20220518213522732](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220518213522732.png)



## 四、安装扩展

在https://extensions.gnome.org 中搜索安装 Input Method Panel 扩展，美化输入法样式。

![image-20220518213809008](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220518213809008.png)

## 四、设置开机自启动

在 Tweaks中将 Fcitx 5 添加到「开机启动程序」列表中即可。

![image-20220518213837691](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20220518213837691.png)