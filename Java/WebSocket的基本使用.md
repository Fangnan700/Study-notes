# WebSocket的基本使用



## pom.xml

```xml
<dependency>
	<groupId>org.springframework.boot</groupId>
    <artifactId>spring-boot-starter-websocket</artifactId>
</dependency>
```





## WebSocketConfig.java

```java
@Configuration
public class WebSocketConfig {
    /**
     *  注入ServerEndpointExporter，
     *  这个bean会自动注册使用了@ServerEndpoint注解声明的Websocket endpoint
     */
    @Bean
    public ServerEndpointExporter serverEndpointExporter() {
        return new ServerEndpointExporter();
    }
}
```



## WebSocket.java

```java
@Component
@ServerEndpoint("/websocket")
public class WebSocket {


    //与某个客户端的连接会话，需要通过它来给客户端发送数据(jakarta.websocket.Session)
    private Session session;

    // 保存所有连接的 websocket (WebSocket指的是当前类)
    private static CopyOnWriteArrayList<WebSocket> webSocketsPool = new CopyOnWriteArrayList<>();

    // 保存在线的连接数
    private static Map<String, Session> sessionPool = new HashMap<>();



    // 连接建立时的操作
    @OnOpen
    public void onOpen(Session session, @PathParam(value="userId")String userId) {
        try {
            this.session = session;
            webSocketsPool.add(this);
            sessionPool.put(userId, session);
            System.out.println("[websocket消息] 有新的连接，总数为:" + webSocketsPool.size());
        } catch (Exception e) {
        }
    }


    // 连接关闭时的操作
    @OnClose
    public void onClose() {
        try {
            webSocketsPool.remove(this);
            System.out.println("[websocket消息] 连接断开，总数为:" + webSocketsPool.size());
        } catch (Exception e) {
        }
    }


    // 收到客户端消息后的操作
    @OnMessage
    public void onMessage(String message) {
        System.out.println("[websocket消息] 收到客户端消息:" + message);
    }


    // 异常时的操作
    @OnError
    public void onError(Session session, Throwable error) {
        System.out.println("[websocket消息] 出现异常:" + error.getMessage());
    }


    // 广播消息操作

    // 此为广播消息
    public void sendAllMessage(String message) {
        System.out.println("【websocket消息】广播消息:"+message);
        for(WebSocket webSocket : webSocketsPool) {
            try {
                if(webSocket.session.isOpen()) {
                    webSocket.session.getAsyncRemote().sendText(message);
                }
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }

    // 此为单点消息
    public void sendOneMessage(String userId, String message) {
        Session session = sessionPool.get(userId);
        if (session != null&&session.isOpen()) {
            try {
                System.out.println("【websocket消息】 单点消息:"+message);
                session.getAsyncRemote().sendText(message);
            } catch (Exception e) {
                e.printStackTrace();
            }
        }
    }
}
```





## fronted.js

```js
let count = 0;

let socket = new ReconnectingWebSocket("ws://localhost:8080/websocket")

socket.onopen = function (e) {
  	console.log("[websocket消息] 已连接到服务端");
}

socket.onclose = function (e) {
    console.log("[websocket消息] 连接已断开");
}

socket.onmessage = function (e) {
  	console.log("[websocket消息] 收到消息:" + e.data);
}

socket.onerror = function (e) {
    console.log("[websocket消息] 出现异常:" );
}

function send() {
    socket.send("test:" + count);
    count++;
}
```

