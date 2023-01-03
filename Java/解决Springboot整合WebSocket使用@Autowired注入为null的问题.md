# 解决Springboot整合WebSocket使用@Autowired注入为null的问题



我们在spring 或 springboot 的 websocket 里面使用 @Autowired 注入 service 或 bean 时，会报空指针异常，获取的service 为 null，并不是service 不能被注入。

**本质原因：**

spring管理的都是单例（singleton），和 websocket （多对象）相冲突。

**详细解释：**

项目启动时初始化，会初始化 websocket （非用户连接的），spring 同时会为其注入 service，该对象的 service 不是 null，被成功注入。但是，由于 spring 默认管理的是单例，所以只会注入一次 service。当新用户进入聊天时，系统又会创建一个新的 websocket 对象，这时矛盾出现了：spring 管理的都是单例，不会给第二个 websocket 对象注入 service，所以导致只要是用户连接创建的 websocket 对象，都不能再注入了。像 controller 里面有 service， service 里面有 dao。

因为 controller，service ，dao 都有是单例，所以注入时不会报 null。但是 websocket 不是单例，所以使用spring注入一次后，后面的对象就不会再注入了，会报null。



**解决方法：**

使用@Autowired set方法注入：

```java
@Component
@ServerEndpoint(value = "/loggings")
public class LoggingWebConfig{

    //引入自己的接口类，注意要加上static 静态修饰
    private static MobileUserService mobileUserService;
    
    //mobileUserService的set方法
    @Autowired 
    public  void setApplicationContext(MobileUserService mobileUserService) {
        LoggingWebConfig.mobileUserService= mobileUserService;
    }
    //然后就可以直接用引入的mobileUserService接口，例如mobileUserService.list()即可获取到相应的数据
}
```

