# Springboot整合WebSocket实现网络聊天室



最近在学 Springboot，做了个小项目，基于 WebSocke t实现的网络聊天室，主要实现的功能有：

- 用户注册/登录
- 查询和修改用户个人信息
- 实时显示在线人数
- 实时显示用户的进入与退出
- 查询历史消息
- 与AI机器人交互（基于GPT-3的api实现）



## 效果展示：

登录页：

![image-20230103160630027](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20230103160630027.png)

注册页：

![image-20230103160657221](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20230103160657221.png)

主页：

![image-20230103160726950](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20230103160726950.png)

实时聊天：

![image-20230103160831611](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20230103160831611.png)

与AI交互：

![image-20230103161129916](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20230103161129916.png)

查询历史消息：

![image-20230103161214842](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20230103161214842.png)







## 技术栈：

**前端：**

- html + css + js 三件套
- jquery3 + bootstrap5
- reconnecting-websocket

**后端：**

后端使用 Java 和 Python 两种语言实现：

- Java：
  - Springboot
  - Mybatis
  - Websocket
- Python：
  - Flask



## 项目结构：

**前端：**

![image-20230103161930227](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20230103161930227.png)

**后端：**

![image-20230103162106963](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20230103162106963.png)













