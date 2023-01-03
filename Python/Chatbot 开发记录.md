# Chatbot 开发记录

最近ChatGPT非常火，去体验之后确实有被惊艳到，也对OpenAI上的人工智能模型比较感兴趣，于是想着复刻一个ChatGPT，利用官方提供的包和api，可以非常简单地复刻出一个ChatGPT，下面是复盘开发过程的记录。

项目地址：https://github.com/Fangnan700/Chatbot

![image-20221217232956129](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221217232956129.png)



## 配置项目

- 我所使用的开发环境是Ubuntu22.04 + Python3.10 + Pycharm2022.3；

- 项目后端采用Flask框架，前端采用Bootstrap框架，前后端使用json进行交互。

**项目结构：**

![image-20221217222120806](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221217222120806.png)



## 编写代码

### 前端：

前端需要的框架文件：

- jquery-3.6.2.min.js
- bootstrap.min.js
- bootstrap.min.css

文件可以到官网直接下载。



**index.html**

```html
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" maximum-scale="1.0" user-scalable="0">
    <title>Chatbot.</title>
    <script src="{{ url_for('static', filename='js/bootstrap.min.js') }}"></script>
    <script src="{{ url_for('static', filename='js/jquery-3.6.2.min.js') }}"></script>
    <link rel="icon" href="{{ url_for('static', filename='img/robot.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url_for('static', filename='css/index.css') }}">
</head>
<body>

<div class="container-fluid">
    <div class="row-cols-auto">
        <div class="main">
            <img src="{{ url_for('static', filename='img/logo.png') }}" width="320px" height="100px">
        </div>
    </div>

    <div class="row-cols-auto">
        <div class="col" id="content">
            <div class="col" id="response"></div>
        </div>
    </div>

     <div class="row" id="loading_frame">
        <div class="spinner-border text-light" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="row-cols-auto">
        <div class="col textarea" id="input" contenteditable="true" onfocus="clear_input()">

        </div>
    </div>

    <div class="row-cols-auto" id="btn_group">
        <button class="btn btn-secondary" id="clear_btn" onclick="clear_history()" onmo>清 空</button>
        <button class="btn btn-secondary" id="send_btn" onclick="send()">发 送</button>
    </div>

    <div class="row-cols-auto" id="footer_frame">
        Copyright © 2022
        <a class="link-light" href="https://github.com/Fangnan700">Fang nan.</a>
        All rights reserved.
    </div>

</div>

</body>
<script src="{{ url_for('static', filename='js/index.js') }}"></script>
</html>
```



**index.css**

```css
body {
    width: 100%;
    height: 100%;
    background: #333333;
}

.main {
    width: 100%;
    height: 100%;
    text-align: center;
}

#content {
    width: 100%;
    height: auto;
    min-height: 480px;
    margin-top: 20px;
    padding-top: 20px;
    padding-bottom: 80px;
    padding-left: 50px;
    padding-right: 50px;
    background: rgba(0,0,0, 1);
    backdrop-filter: blur(10px);
    border-radius: 15px;
}

#response {
    width: 100%;
    height: auto;
    min-height: 380px;
    color: #ffffff;
}

#loading_frame {
    width: 30px;
    height: 30px;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    visibility: hidden;
}

#input {
    width: 100%;
    height: auto;
    min-height: 50px;
    line-height: 50px;
    margin-top: 20px;
    padding-left: 30px;
    padding-right: 10px;
    border-radius: 15px;
    background: black;
    color: #ffffff;
}

#btn_group {
    margin-top: 20px;
    margin-bottom: 30px;
    text-align: right;
}

#clear_btn {
    width: 100px;
    margin-left: auto;
    margin-right: auto;
    border-radius: 10px;
}

#send_btn {
    width: 100px;
    margin-left: 10px;
    margin-right: auto;
    border-radius: 10px;
}


#footer_frame {
    width: 230px;
    height: 30px;
    line-height: 30px;
    margin-top: 20px;
    margin-left: auto;
    margin-right: auto;
    text-align: center;
    color: #ffffff;
}
```



**index.js**

```js

// 获取页面元素并创建全局变量
let loading_frame = document.getElementById("loading_frame");
let _input = document.getElementById("input");
let response = document.getElementById("response");
let clear_btn = document.getElementById("clear_btn");
let send_btn = document.getElementById("send_btn");
let history;

// 设置提示语
response.innerText = "hi～我是Chatbot，你可以把你的问题写在下方，然后发送给我，我会尽力为你解答😆"
_input.innerText = "请把你的问题写在这里"

// 发送请求
function send() {
    send_btn.blur();
    loading_frame.style.visibility = "visible";
    let value = _input.innerText;
    history = document.getElementById("response").innerText;
    response.innerText = history + "\n\nQ:\n\n" + value;
    let data = {"content": value};
    $.ajax({
        url: "/send",
        type: "post",
        contentType: 'application/json',
        data: JSON.stringify(data),
        success: function (result) {
            history = document.getElementById("response").innerText;
            response.innerText = history + "\n\nA:" + result;
            loading_frame.style.visibility = "hidden";
        },
        error: function () {
            loading_frame.style.visibility = "hidden";
            response.innerText = "好像出了点问题哦，稍后再试试吧～";
        }
    })
}

// 清除历史内容
function clear_input() {
    _input.innerText = "";
}

function clear_history() {
    clear_btn.blur();
    _input.innerText = "";
    response.innerText = "";
}
```



### 后端：

后端使用Python+Flask实现，同时需要引入几个包：

- openai（OpenAI官方提供的包，可以非常方便地发送请求）
- dotenv（用于读取环境变量，OpenAI的api-key将在环境变量文件中设置）

以上两个包可以直接用pip进行安装。



在项目根目录创建.flaskenv文件并写入配置：

```
FLASK_APP=app
FLASK_ENV=development
OPENAI_API_KEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
```

其中OPENAI_API_KEY填写的是从OpenAI官网申请到的api-key，申请网址：

[https://beta.openai.com/api](https://beta.openai.com/api)



**app.py**

```python
from flask import *
import os
import openai

app = Flask(__name__)
openai.api_key = os.environ.get('OPENAI_API_KEY')


@app.route('/', methods=('GET', 'POST'))
def index():
    return render_template('index.html')


@app.route('/send', methods=('GET', 'POST'))
def send():
    # 解析前端发送的数据
    recv = request.json
    data = recv['content']
    
    # 核心代码，用于向OpenAI的服务器发送请求数据
    response = openai.Completion.create(
        model="text-davinci-003",	# 选择要使用的模型
        prompt=data + '.',			# 请求的数据，即向模型输入的语句，需要以"."结尾
        temperature=0.8,			# 参数，范围0～1，数值越大输出的数据更独特，数值越小输出更准确
        n=1,						# 为每个提示生成多少结果，默认为1
        max_tokens=2048				# 单次输出的最大令牌数，大多数模型支持的最大值为2048
    )
    return response.choices[0].text # 从服务器返回的数据中取出想要的结果


if __name__ == '__main__':
    app.run()
```





## 部署项目

这里推荐使用境外的服务器，国内可以通过http请求访问到，将输入的内容发送到服务器，再由服务器转发到OpenAI的服务器上，由此可以在不使用科学上网的情况下，实现与AI机器人的交互。

为了便于在服务器上启动项目，我使用shell脚本来完成项目的启动：

**run.sh**

```shell
#! /bin/bash
./venv/bin/python -m flask run --host 0.0.0.0 --port 80
```

编写好的脚本放在项目根目录下。

将项目连同虚拟环境一起打包，上传到服务器：

```shell
scp Chatbot.zip username@host:/path
```

上传完成后解压：

```shell
unzip Chatbot.zip
```

进入项目文件下并给脚本赋予权限：

```shell
cd Chatbot
chmod +x run.sh
```

开放80端口：

```shell
ufw allow 80
```

在后台不中断地启动项目：

```shell
setsid ./run.sh &
```



这么启动在ssh连接断开后项目不会停止。

![1](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/1.jpg)

至此，通过服务器的公网IP就可以访问到项目了，如果访问不到，就要到服务器的管理面板查看端口是否开放。

![2](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/2.jpg)

在不使用vpn的情况下也能正常使用：

![3](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/3.jpg)

手机端也能正常使用：

![1EE60F238611E931B3ABCE4FCA1A182F](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/1EE60F238611E931B3ABCE4FCA1A182F.jpg)