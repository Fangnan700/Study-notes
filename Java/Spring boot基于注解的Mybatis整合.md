# Spring boot基于注解的Mybatis整合

使用方法：

**一、安装相关依赖**

使用 maven 构建，在 `pom.xml` 中填写相关依赖：

```xmls
<dependency>
	<groupId>mysql</groupId>
	<artifactId>mysql-connector-java</artifactId>
    <version>8.0.31</version>
</dependency>

<dependency>
    <groupId>org.mybatis.spring.boot</groupId>
    <artifactId>mybatis-spring-boot-starter</artifactId>
    <version>3.0.1</version>
</dependency>
```



**二、配置mysql数据库和mybatis**

在 `application.properties` 内填写：

```properties
# 基本数据库配置
spring.datasource.driver-class-name=com.mysql.cj.jdbc.Driver
spring.datasource.url=jdbc:mysql://localhost:3306/springboot
spring.datasource.username=root
spring.datasource.password=123456

# 使用Spring boot自带的数据库连接池hikari
spring.datasource.hikari.maximum-pool-size=10
spring.datasource.hikari.max-lifetime=360000
```



**三、创建数据表**

```mysql
USE springboot;
CREATE TABLE IF NOT EXIST users(
	id INT NOT NULL PRIMARY KEY,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(40) NOT NULL
);
INSERT INTO users (id, username, password) VALUES (1, '张三', '123456');
```



**四、编写实体类**

创建 `entity.User` ：

```java
public class User {
    private Integer id;
    private String username;
    private String password;

    public User(Integer id, String username, String password) {
        this.id = id;
        this.username = username;
        this.password = password;
    }

    public Integer getId() {
        return id;
    }

    public String getUsername() {
        return username;
    }

    public String getPassword() {
        return password;
    }

    @Override
    public String toString() {
        return "User{" +
                "id=" + id +
                ", username='" + username + '\'' +
                ", password='" + password + '\'' +
                '}';
    }
}
```



**五、编写Dao层**

在这一步使用注解来整合 mybatis 中的 sql 语句。

创建 `mapper.UserDao.java` 并在其中编写：

```java
@Mapper
public interface UserDao {
    @Results {
        @Result(property = "id", column = "id"),
        @Result(property = "username", column = "username"),
        @Result(property = "password", column = "password")
    }
    @Select("SELECT * FROM users WHERE id = #{ id }")
    User getUserById(@Param("id") int id);
}
```

注意：

- @Mapper 表示将当前接口标注为一个 mybatis 的SQL语句映射，用于执行SQL语句
- @Results 用于规定返回结果集中字段名与实体类变量的映射关系
- @Result 用于规定单个字段与实体类变量的映射关系
- property 表示实体类中的变量名
- column 表示数据表中的字段名
- @Select 表示下面的抽象方法用于执行一条 SELECT 语句，具体内容写在括号中
- #{ id } 表示要插入SQL语句中的变量
- @Param("id") int id 表示从调用者处传来的参数变量，@Param中填写的是上面SQL语句中的变量，即#{ id }



**六、编写Service层**

创建 `service.UserService.java` 文件：

```java
@Service
public class UserService {
    @Autowired
    private UserDao userDao;

    public User getUerById(int id) {
        return userDao.getUserById(id);
    }
}
```

注意：

- @Service 表示当前类被标注为一个 Service，供 Spring boot 调用
- @Autowired 表示自动注入，指向刚才编写的 UserDao 接口，用于下面调用 UserDao 中的方法，执行 SQL 语句



**七、编写Controller层**

创建 `controller.UserController.java` 文件：

```java
@RestController
public class UserController {

    @Autowired
    private UserService userService;

    @RequestMapping(value = "/get_user_by_id", method = RequestMethod.GET)
    public String getUserById(@RequestParam(name = "id") int id) {
        return userService.getUerById(id).toString();
    }
}
```

注意：

- @Autowired 表示自动注入，指向上面的 UserService 类