# hexo+腾讯cos搭建个人博客

### 一、购买腾讯cos对象存储容器

腾讯cos对象存储服务网址：

```
https://cloud.tencent.com/product/cos
```

1、在对象存储控制台中创建新的存储桶

2、在基础配置中开启静态网站

3、开启CDN加速*



### 二、安装Git

windows：到git官网上下载安装包。官网地址：

```
https://gitforwindows.org/
```

linux：终端下使用命令安装：

```
sudo apt-get install git
```

安装好后，终端下使用 git --version 来查看一下版本，出现版本号即安装成功。



### 三、安装nodejs

windows：到nodejs官网上下载安装包。官网地址：

```
https://nodejs.org/en/download/
```

linux：终端下使用命令安装：

```
sudo apt-get install nodejs
sudo apt-get install npm
```

安装好后，终端下使用 node -v 和 npm -v 来查看是否安装成功。



### 四、安装hexo

在磁盘中创建一个文件夹用于存放博客文件，然后在这个文件夹中打开git bash。

在git bash中使用命令安装hexo：

```
npm install -g hexo-cli
```

安装好后，使用 hexo -v 查看是否安装成功。

初始化hexo：

```
hexo init blogname
```

blogname为存放博客文件的文件夹。

切换到blogname文件夹中，执行以下命令：

```
npm install
```

打开文件管理器，进入blogname文件夹可见以下文件：

```
node_modules: 依赖包
public：存放生成的页面
scaffolds：生成文章的一些模板
source：用来存放你的文章
themes：主题
 _config.yml: 博客的配置文件
```

终端中输入：

```
hexo g
hexo server
```

开启hexo服务，在浏览器中输入 localhost:4000 即可查看生成的博客。

至此，hexo本地环境配置完成。



### 五、将本地博客部署到cos

1、为hexo安装一键部署到qcloud cos插件

进入hexo项目的目录，打开git bash并输入以下命令：

```
npm install hexo-deployer-qcloud-cos --save
```

2、修改hexo配置文件

打开hexo项目目录下的_config.yml文件，修改deploy的值：

```
deploy: 
  type: cos
  appId: <账户的appID>
  secretId: <cos accessKeyId>
  secretKey: <cos accessKeySecret>
  bucket: <存储桶名称>
  region: <cos存储桶所在区域代码>
```

相关参数获取方法：

```
appId：->账号信息->基本信息
secretId和secretKey：->访问管理->用户->API密钥
region：->存储桶列表->存储桶->概览
```

3、同步本地文件

git bash中输入：

```
hexo g -d
```

上传完成，使用cos提供的url即可访问博客。

需要上传的md文件存入hexo项目文件夹的source/_posts文件夹中即可。