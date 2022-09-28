# 测试使用Python实现自动刷课

万恶的学习通，万恶的网课，这不得搞搞它？

测试环境：Windows11+ VS Code + Python 3.10 + Chrome 99.0.4844 + ChromeDriver 99.0.4844

测试平台：超星学习通

## 一、环境搭建：

## 0、Google chrome

官网下载对应版本的安装包：

```
https://www.google.cn/intl/zh-CN/chrome/
```

按提示安装。

## 1、Python

官网下载对应版本的安装包：

```
https://www.python.org/
```

按提示安装，记得勾选 **add to path** 选项。

### 2、VS Code

官网下载对应版本的安装包：

```
https://code.visualstudio.com/
```

下载缓慢时，可利用国内镜像源下载：

将原url中的域名(az764295.vo.msecnd.net)替换成 **vscode.cdn.azure.cn**。

安装编写 python 的相关插件：python、code runner

settings 中搜索 run in terminal ，将其勾选，设置默认在终端运行python。

### 3、Selenium

Selenium 是一个用于Web应用程序测试的工具。

支持IE，Mozilla Firefox，Safari，Google Chrome，Opera等浏览器。

这里通过调用 selenium 下的 WebDriver 驱动 chrome浏览器达到自动观看网课的目的。

**Selenium的安装：**

终端中执行以下命令：

```
pip install Selenium
```

注：pip是一个通用的python包管理器，一般安装python时已经默认安装。

### 4、ChromeDriver

打开 chrome->帮助->关于Google chrome，查看chrome的版本号。

打开以下链接，下载与chrome版本号对应的chromedriver。

```
https://chromedriver.storage.googleapis.com/index.html
```

将chromedriver放入python安装目录下的Scripts文件夹中。



## 二、代码实现

**导入相关模块：**

```python
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
import time
```

**定义驱动程序：**

```python
driver = webdriver.Chrome(executable_path="C:\Program Files\Python310\Scripts\chromedriver.exe")
```

**定义全局变量：**

```python
account = ''
password = ''
```

这里填入登录网课平台的账号和密码。

**登录模块：**

打开学习通的登陆界面，复制其url赋值给url变量：

```python
url = "https://passport2.chaoxing.com/login?fid=&newversion=true&refer=https%3A%2F%2Fi.chaoxing.com"
```

```python
try:
        driver.find_element(By.XPATH,'/html/body/div[1]/div/div[1]/div[2]/form/div[1]/input').send_keys(account)
        driver.find_element(By.XPATH,'/html/body/div[1]/div/div[1]/div[2]/form/div[2]/input').send_keys(password)
        driver.find_element(By.XPATH,'/html/body/div[1]/div/div[1]/div[2]/form/div[3]/button').click()
        print('登录成功')
    except:
        print('登录失败')
```

按F12打开开发者工具，在Elements选项中查看页面元素，使用旁面对象选择工具选取账号输入框和密码输入框，分别复制它们的 Full Xpath，填入代码中。

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/%E7%94%A8python%E5%AE%9E%E7%8E%B0%E8%87%AA%E5%8A%A8%E5%88%B7%E8%AF%BE/2022-03-28/%E7%99%BB%E5%BD%95%E9%A1%B5Xpath.png)

.sent_keys()方法用于传递参数。

.click()方法用于模拟点击。

**选择课程模块：**

跟登录模块使用的方法一致，查找需要选择的课程对应的 Full Xpath，调用.click()方法模拟点击。

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/%E7%94%A8python%E5%AE%9E%E7%8E%B0%E8%87%AA%E5%8A%A8%E5%88%B7%E8%AF%BE/2022-03-28/%E9%80%89%E8%AF%BEXpath.png)

**播放视频模块**

你以为视频的播放按钮是那个小三角形？按照上述的查找方法进行模拟点击操作时会发现无论如何也无法播放成功。原因在于真正的播放按钮被开发人员隐藏起来了，应该查找的Full Xpath如下图：

![](https://yvling-blog-image-1257337367.cos.ap-shanghai.myqcloud.com/%E5%8D%9A%E5%AE%A2/%E7%94%A8python%E5%AE%9E%E7%8E%B0%E8%87%AA%E5%8A%A8%E5%88%B7%E8%AF%BE/2022-03-28/%E6%92%AD%E6%94%BE%E9%A1%B5Xpath.png)

没错，就是那个隐形的小小正方形......

最后只需要调用time.sleep()方法，设置时间为1500到2000秒，就可以实现自动播放了。

**完整代码如下：**

```python
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.common.by import By
import time

driver = webdriver.Chrome(executable_path="C:\Program Files\Python310\Scripts\chromedriver.exe")
account = ''
password = ''

linestr = open("mooc_url.txt","r")

for i in range(0,124):
    url = linestr.readline()
    driver.get(url=url)
    driver.maximize_window()

    try:
        driver.find_element(By.XPATH,'/html/body/div[1]/div/div[1]/div[2]/form/div[1]/input').send_keys(account)
        driver.find_element(By.XPATH,'/html/body/div[1]/div/div[1]/div[2]/form/div[2]/input').send_keys(password)
        driver.find_element(By.XPATH,'/html/body/div[1]/div/div[1]/div[2]/form/div[3]/button').click()
        print('登录成功')
    except:
        print('登录失败')                                  

    time.sleep(1)

    driver._switch_to.frame("iframe")
    try:
        driver.find_element(By.XPATH,'/html/body/div/div[1]').click()
        print('播放成功')
    except:
        print('播放失败')

    time.sleep(1200)
linestr.close()
driver.close()
```

这里我直接摘取不同章节的课程url保存到文本文件中，从文件中读取调用。

关于学习通的视频答题，目前无解。。。
