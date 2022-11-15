# 记一次Flask session伪造

双十一的时候，ctfshow搞了一个“菜狗杯”比赛，其中有道题印象比较深刻，在此记录一下。



**打开靶机，“抽老婆”可还行。**

![image-20221112174528318](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112174528318.png)

![image-20221112174544719](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112174544719.png)



**按照惯例，打开开发者工具查看网页源码**

![image-20221112174719548](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112174719548.png)

发现这个下载按钮请求了一个/download路由，并且url中的payload可控，第一反应就是存在目录穿越漏洞。

尝试构造payload读取敏感文件，试了一些，发现能读取/etc下的敏感文件，证实了目录穿越的存在。

在尝试直接读取flag文件时，页面提示：

![image-20221112183441901](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112183441901.png)

尝试读取其它文件，页面报错：

![image-20221112183630046](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112183630046.png)

查看有关代码发现，网站使用flask构建，并且过滤了url中的flag字符串：

![image-20221112183756352](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112183756352.png)

注意到这里的主程序是/app/app.py，由于存在目录穿越，于是尝试直接读取app.py：

![image-20221112183950839](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112183950839.png)

成功拿到源文件：

```python
# !/usr/bin/env python
# -*-coding:utf-8 -*-

"""
# File       : app.py
# Time       ：2022/11/07 09:16
# Author     ：g4_simon
# version    ：python 3.9.7
# Description：抽老婆，哇偶~
"""

from flask import *
import os
import random
from flag import flag

#初始化全局变量
app = Flask(__name__)
app.config['SECRET_KEY'] = 'tanji_is_A_boy_Yooooooooooooooooooooo!'

@app.route('/', methods=['GET'])
def index():  
    return render_template('index.html')


@app.route('/getwifi', methods=['GET'])
def getwifi():
    session['isadmin']=False
    wifi=random.choice(os.listdir('static/img'))
    session['current_wifi']=wifi
    return render_template('getwifi.html',wifi=wifi)



@app.route('/download', methods=['GET'])
def source(): 
    filename=request.args.get('file')
    if 'flag' in filename:
        return jsonify({"msg":"你想干什么？"})
    else:
        return send_file('static/img/'+filename,as_attachment=True)


@app.route('/secret_path_U_never_know',methods=['GET'])
def getflag():
    if session['isadmin']:
        return jsonify({"msg":flag})
    else:
        return jsonify({"msg":"你怎么知道这个路径的？不过还好我有身份验证"})



if __name__ == '__main__':
    app.run(host='0.0.0.0',port=80,debug=True)
```



分析源代码，发现了一个隐藏的路由：/secret_path_U_never_know，这里对session进行了校验，只有当session的值为"isadmin"并且签名正确时，才能访问到flag。

于是想到flask的session伪造。



将源代码中关于session的部分进行修改：

- 将session['isadmin']的值改为True
- 将session['current_wifi']的值改为在线容器能访问到的文件路径
- 将当前方法的返回值修改为任意字符串，防止报错

```python
@app.route('/getwifi', methods=['GET'])
def getwifi():
    session['isadmin']=True
    session['current_wifi']="59f900ed51ee7e92e4bec6ef1b8d6f5c.jpg"
    return "test"

```

修改完成后在本地启动，访问/getwifi，打开开发者工具获取正确的session：

![image-20221112185657196](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112185657196.png)

访问线上环境的/secret_path_U_never_know路由，将获得的session替换线上环境的session，刷新：

![image-20221112185855851](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221112185855851.png)

成功拿到flag。
