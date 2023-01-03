# 基于OpenAI实现的个人助理

最近OpenAI所开发的ChatGPT非常火，于是我也去体验了一下。

在玩过之余，就想着能不能把它移植到系统环境，成为一个日常的个人助理，帮助我解决学习、开发或者摸鱼时的种种需求。

于是，看过官方文档之后，发现官方提供了GPT模型的API，那还等什么，开始coding......

项目已开源：[git@github.com:Fangnan700/OpenAI-based-personal-assistant.git]()



## 0x00 注册OpenAI帐号

这步是最基础的，网址如下：

```http
https://openai.com/api/
```

（需要科学上网，具体的注册方法网上一大把，这里不再赘述）

![image-20221216234912593](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221216234912593.png)



## 0x01 获取API密钥

注册成功后，进入个人帐号管理页面：

![image-20221216235054152](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221216235054152.png)

选择左侧的 “API keys”，点击 “Create new secret key”，获取API密钥，记得要保存好，页面关闭后将无法再查看。



## 0x02 搭建运行环境

这里可以在虚拟环境中运行，也可以在实体环境中运行，由于我使用的是Linux系统，所以这里我选择配置在虚拟环境中，通过shell脚本运行程序。

这里主要是Linux下的操作步骤，Windows下另寻教程

**一、安装python环境**

```shell
sudo apt install python
```

**二、安装pip**

```shell
sudo apt installl pip
```

**三、安装openai依赖包**

```shell
sudo pip install openai
```



## 0x04 编写代码

```python
import openai

// 这里填写从OpenAI官网获取的API密钥
openai.api_key = "xxxxxxxxxx"


def generate_prompt(payload):
    return payload + "."


print("")
print("### 嗨～请告诉我你的问题，我会尽力帮你解答～")
print("### 使用方法：")
print(">>> 一、启动模式：")
print("    0、陪聊模式")
print("    1、代码模式")
print(">>> 二、聪明程度：")
print("    0、智障模式")
print("    1、智慧模式")
print(">>> 三、结束程序：")
print("    输入'#'退出程序")

mode = input(">>> 请选择启动模式: ")
if mode == "'#'":
    exit(0)
if mode != '0' and mode != '1':
    print(">>> 乱输入！不给你用了！")
    exit(0)

model = ""
if mode == '0':
    model = "text-davinci-003"
else:
    model = "code-davinci-002"

intelligence = input(">>> 请选择聪明程度: ")
if intelligence == "'#'":
    exit(0)
if intelligence != '0' and intelligence != '1':
    print(">>> 又乱输入！我生气了！拜拜！！！")
    exit(0)

temperature = 0
if intelligence == 0:
    temperature = 0.1
else:
    temperature = 0.7

print(">>> 好啦！告诉我你的问题吧！\n")

while True:
    content = input(">>> 写在这里: ")
    if content == "‘#’":
        print("嘿嘿～没想到是‘#’吧！拜拜～")
        exit(0)
    
    // 核心代码，用于向服务器发送请求，要按官方提供的参数和格式填写
    response = openai.Completion.create(
        model=model,
        prompt=generate_prompt(content),
        temperature=temperature,
        n=1,
        max_tokens=2048,
        presence_penalty=1,

    )
    print("\n>>> " + response.choices[0].text + "\n")

```



## 0x05 编写shell脚本

这里我把项目文件放在家目录下：

```
/home/dengxiangming/Chat
```

使用脚本激活虚拟环境并启动程序：

```shell
vim chat.sh
```

```shell
#! /bin/bash
source venv/bin/activate
python ./chat.py
```

给脚本赋予执行权限：

```shell
chmod +x ./chat.sh
```



## 0x06 启动

```shell
./chat.sh
```

![image-20221217000909083](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221217000909083.png)



