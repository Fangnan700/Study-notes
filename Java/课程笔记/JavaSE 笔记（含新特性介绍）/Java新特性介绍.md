![image-20220528201059618](https://tva1.sinaimg.cn/large/e6c9d24egy1h2odnbqcwuj21g00i2n3c.jpg)

# Java新特性介绍

**注意：**推荐完成此路线所有前置内容后，再来学习本篇。

经过前面的学习，我们基本已经了解了Java 8及之前的所有语法，不过，Java 8是Oracle 公司于 2014 年 3 月 18 日发布的，距离今天已经过了近十年的时间了，Java并没有就此止步，而是继续不断发展壮大，几乎每隔6个月，就会冒出一个新版本，最新的版本已经快要迭代到Java 20了，与Java 8相差了足足十来个版本，但是由于Java 8的稳定和生态完善（目前仍是LTS长期维护版本），依然有很多公司在坚持使用Java 8，不过随着SpringBoot 3.0的到来，现在强制要求使用Java 17版本（同样也是LTS长期维护版本），下一个Java版本的时代，或许已经临近了。

![image-20220528202952628](https://tva1.sinaimg.cn/large/e6c9d24egy1h2oe6x6fipj215i0cqtan.jpg)

随着这些主流框架全面拥抱Java 17，为了不被时代所淘汰，我们的学习之路，也要继续前行了。就像很多年前Java 6还是主流的时代，终究还是被Java 8所取代一样。

在本篇视频中，我们将介绍Java 9 - Java 17这些版本的所有新增特性，这里推荐各位小伙伴提前准备好JDK 17环境（Oracle JDK 17已全面支持arm芯片的Mac电脑，请放心食用）

![image-20220528220146662](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ogujjr85j22740p0wjz.jpg)

全篇视频挑重点说，不墨迹，开始吧。

## Java 8 关键特性回顾

在开始之前，我们先来回顾一下Java 8中学习的Lambda表达式和Optional类，有关Stream API请各位小伙伴回顾一下Java SE篇视频教程，这里不再进行介绍。

### Lambda表达式

在Java 8之前，我们在某些情况下可能需要用到匿名内部类，比如：

```java
public static void main(String[] args) {
    //现在我们想新建一个线程来搞事情
    Thread thread = new Thread(new Runnable() {   //创建一个实现Runnable的匿名内部类
        @Override
        public void run() {   //具体的实现逻辑
            System.out.println("Hello World!");
        }
    });
    thread.start();
}
```

在创建Thread时，我们需要传入一个Runnable接口的实现类，来指定具体的在新的线程中要执行的任务，相关的逻辑需要我们在`run()`方法中实现，这时为了方便，我们就直接使用匿名内部类的方式传入一个实现，但是这样的写法实在是太过臃肿了。

在Java 8之后，我们可以对类似于这种匿名内部类的写法，进行缩减，实际上我们进行观察会发现，真正有用的那一部分代码，实际上就是我们对`run()`方法的具体实现，而其他的部分实际上在任何地方编写都是一模一样的，那么我们能否针对于这种情况进行优化呢？我们现在只需要一个简短的lambda表达式即可：

```java
public static void main(String[] args) {
    //现在我们想新建一个线程来做事情
    Thread thread = new Thread(() -> {
        System.out.println("Hello World!");  //只需留下我们需要具体实现的方法体
    });
    thread.start();
}
```

我们可以发现，原本需要完整编写包括类、方法在内的所有内容，全部不再需要，而是直接使用类似于`() ‐> { 代码语句 }`的形式进行替换即可。是不是感觉瞬间代码清爽了N倍？

当然这只是一种写法而已，如果各位不好理解，可以将其视为之前匿名内部类写法的一种缩短。

> 但是注意，它的底层其实并不只是简简单单的语法糖替换，而是通过`invokedynamic`指令实现的，不难发现，匿名内部类会在编译时创建一个单独的class文件，但是lambda却不会，间接说明编译之后lambda并不是以匿名内部类的形式存在的：
>
> ```java
> //现在我们想新建一个线程来做事情
> Thread thread = new Thread(() -> {
>     throw new UnsupportedOperationException();   //这里我们拋个异常看看
> });
> thread.start();
> ```
>
> ![image-20220529214948350](https://tva1.sinaimg.cn/large/e6c9d24egy1h2pm4fpasnj21e202qdgc.jpg)
>
> 可以看到，实际上是Main类中的`lambda$main$0()`方法抛出的异常，但是我们的Main类中压根没有这个方法，很明显是自动生成的。所以，与其说Lambda是匿名内部类的语法糖，不如说是我们为所需要的接口提供了一个方法作为它的实现。比如Runnable接口需要一个方法体对它的`run()`方法进行实现，而这里我们就通过lambda的形式给了它一个方法体，这样就万事具备了，而之后创建实现类就只需要交给JVM去处理就好了。

我们来看一下Lambda表达式的具体规范：

* 标准格式为：`([参数类型 参数名称,]...) ‐> { 代码语句，包括返回值 }`
* 和匿名内部类不同，Lambda仅支持接口，不支持抽象类
* 接口内部必须有且仅有一个抽象方法（可以有多个方法，但是必须保证其他方法有默认实现，必须留一个抽象方法出来）

比如我们之前使用的Runable类：

```java
@FunctionalInterface   //添加了此注解的接口，都支持lambda表达式，符合函数式接口定义
public interface Runnable {
    public abstract void run();   //有且仅有一个抽象方法，此方法返回值为void，且没有参数
}
```

因此，Runable的的匿名内部类实现，就可以简写为：

```java
Runnable runnable = () -> {    };
```

我们也可以写一个玩玩：

```java
@FunctionalInterface
public interface Test {   //接口类型
    String test(Integer i);    //只有这一个抽象方法，且接受一个int类型参数，返回一个String类型结果
}
```

它的Lambda表达式的实现就可以写为：

```java
Test test = (Integer i) -> { return i+""; };  //这里我们就简单将i转换为字符串形式
```

不过还可以进行优化，首先方法参数类型是可以省略的：

```java
Test test = (i) -> { return i+""; };
```

由于只有一个参数，可以不用添加小括号（多个参数时需要）：

```java
Test test = i -> { return i+""; };
```

由于仅有返回语句这一行，所以可以直接写最终返回的结果，并且无需花括号：

```java
Test test = i -> i+"";
```

这样，相比我们之前直接去编写一个匿名内部类，是不是简介了很多很多。当然，除了我们手动编写接口中抽象方法的方法体之外，如果已经有实现好的方法，是可以直接拿过来用的，比如：

```java
String test(Integer i);   //接口中的定义
```

```java
public static String impl(Integer i){   //现在有一个静态方法，刚好匹配接口中抽象方法的返回值和参数列表
    return "我是已经存在的实现"+i;
}
```

所以，我们可以直接将此方法，作为lambda表达式的方法体实现（其实这就是一种方法引用，引用了一个方法过来，这也是为什么前面说`是我们为所需要的接口提供了一个方法作为它的实现`，是不是越来越体会到这句话的精髓了）：

```java
public static void main(String[] args) {
    Test test = Main::impl;    //使用 类名::方法名称 的形式来直接引用一个已有的方法作为实现
}

public static String impl(Integer i){
    return "我是已经存在的实现"+i;
}
```

比如我们现在需要对一个数组进行排序：

```java
public static void main(String[] args) {
    Integer[] array = new Integer[]{4, 6, 1, 9, 2, 0, 3, 7, 8, 5};   //来个数组
    Arrays.sort(array, new Comparator<Integer>() {   //Arrays.sort()可以由我们自己指定排序规则，只需要实现Comparator方法即可
        @Override
        public int compare(Integer o1, Integer o2) {
            return o1 - o2;
        }
    });
    System.out.println(Arrays.toString(array));   //按从小到大的顺序排列
}
```

但是我们发现，Integer类中有一个叫做`compare`的静态方法：

```java
public static int compare(int x, int y) {
    return (x < y) ? -1 : ((x == y) ? 0 : 1);
}
```

这个方法是一个静态方法，但是它却和`Comparator`需要实现的方法返回值和参数定义一模一样，所以，懂的都懂：

```java
public static void main(String[] args) {
    Integer[] array = new Integer[]{4, 6, 1, 9, 2, 0, 3, 7, 8, 5};
    Arrays.sort(array, Integer::compare);   //直接指定一手，效果和上面是一模一样
    System.out.println(Arrays.toString(array));
}
```

那么要是不是静态方法而是普通的成员方法呢？我们注意到Comparator要求我们实现的方法为：

```java
public int compare(Integer o1, Integer o2) {
     return o1 - o2;
}
```

其中o1和o2都是Integer类型的，我们发现Integer类中有一个`compareTo`方法：

```java
public int compareTo(Integer anotherInteger) {
    return compare(this.value, anotherInteger.value);
}
```

只不过这个方法并不是静态的，而是对象所有：

```java
Integer[] array = new Integer[]{4, 6, 1, 9, 2, 0, 3, 7, 8, 5};
Arrays.sort(array, new Comparator<Integer>() {
    @Override
    public int compare(Integer o1, Integer o2) {
        return o1.compareTo(o2);   //这样进行比较也行，和上面效果依然是一样的
    }
});
System.out.println(Arrays.toString(array));
```

但是此时我们会发现，IDEA提示我们可以缩写，这是为什么呢？实际上，当我们使用非静态方法时，会使用抽象方参数列表的第一个作为目标对象，后续参数作为目标对象成员方法的参数，也就是说，此时，`o1`作为目标对象，`o2`作为参数，正好匹配了`compareTo`方法，所以，直接缩写：

```java
public static void main(String[] args) {
    Integer[] array = new Integer[]{4, 6, 1, 9, 2, 0, 3, 7, 8, 5};
    Arrays.sort(array, Integer::compareTo);  //注意这里调用的不是静态方法
    System.out.println(Arrays.toString(array));
}
```

成员方法也可以让对象本身不成为参与的那一方，仅仅引用方法：

```java
public static void main(String[] args) {
    Main mainObject = new Main();
    Integer[] array = new Integer[]{4, 6, 1, 9, 2, 0, 3, 7, 8, 5};
    Arrays.sort(array, mainObject::reserve);  //使用Main类的成员方法，但是mainObject对象并未参与进来，只是借用了一下刚好匹配的方法
    System.out.println(Arrays.toString(array));
}

public int reserve(Integer a, Integer b){  //现在Main类中有一个刚好匹配的方法
    return b.compareTo(a);
}
```

当然，类的构造方法同样可以作为方法引用传递：

```java
public interface Test {
    String test(String str);   //现在我们需要一个参数为String返回值为String的实现
}
```

我们发现，String类中刚好有一个：

```java
public String(String original) {   //由于String类的构造方法返回的肯定是一个String类型的对象，且此构造方法需要一个String类型的对象，所以，正好匹配了接口中的
    this.value = original.value;
    this.coder = original.coder;
    this.hash = original.hash;
}
```

于是乎：

```java
public static void main(String[] args) {
    Test test = String::new;   //没错，构造方法直接使用new关键字就行
}
```

当然除了上面提到的这些情况可以使用方法引用之外，还有很多地方都可以，还请各位小伙伴自行探索了。Java 8也为我们提供了一些内置的函数式接口供我们使用：Consumer、Function、Supplier等，具体请回顾一下JavaSE篇视频教程。

### Optional类

Java 8中新引入了Optional特性，来让我们更优雅的处理空指针异常。我们先来看看下面这个例子：

```java
public static void hello(String str){   //现在我们要实现一个方法，将传入的字符串转换为小写并打印
    System.out.println(str.toLowerCase());  //那太简单了吧，直接转换打印一气呵成
}
```

但是这样实现的话，我们少考虑了一个问题，万一给进来的`str`是`null`呢？如果是`null`的话，在调用`toLowerCase`方法时岂不是直接空指针异常了？所以我们还得判空一下：

```java
public static void hello(String str){
    if(str != null) {
        System.out.println(str.toLowerCase());
    }
}
```

但是这样写着就不能一气呵成了，我现在又有强迫症，我就想一行解决，这时，Optional来了，我们可以将任何的变量包装进Optional类中使用：

```java
public static void hello(String str){
    Optional
            .ofNullable(str)   //将str包装进Optional
            .ifPresent(s -> {   //ifPresent表示只有对象不为null才会执行里面的逻辑，实现一个Consumer（接受一个参数，返回值为void）
                System.out.println(s);   
            });
}
```

由于这里只有一句打印，所以我们来优化一下：

```java
public static void hello(String str){
    Optional
            .ofNullable(str)   //将str包装进Optional
            .ifPresent(System.out::println);  
  	//println也是接受一个String参数，返回void，所以这里使用我们前面提到的方法引用的写法
}
```

这样，我们就又可以一气呵成了，是不是感觉比之前的写法更优雅。

除了在不为空时执行的操作外，还可以直接从Optional中获取被包装的对象：

```java
System.out.println(Optional.ofNullable(str).get());
```

不过此时当被包装的对象为null时会直接抛出异常，当然，我们还可以指定如果get的对象为null的替代方案：

```java
System.out.println(Optional.ofNullable(str).orElse("VVV"));   //orElse表示如果为空就返回里面的内容
```

其他操作还请回顾JavaSE篇视频教程。

## Java 9 新特性

这一部分，我们将介绍Java 9为我们带来的新特性，Java 9的主要特性有，全新的模块机制、接口的private方法等。

### 模块机制

在我们之前的开发中，不知道各位有没有发现一个问题，就是当我们导入一个`jar`包作为依赖时（包括JDK官方库），实际上很多功能我们并不会用到，但是由于它们是属于同一个依赖捆绑在一起，这样就会导致我们可能只用到一部分内容，但是需要引用一个完整的类库，实际上我们可以把用不到的类库排除掉，大大降低依赖库的规模。

于是，Java 9引入了模块机制来对这种情况进行优化，在之前的我们的项目是这样的：

![image-20220528210803658](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ofan3qvxj21b409qjs3.jpg)

而在引入模块机制之后：

![image-20220528210958964](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ofcn7rt7j219009y3za.jpg)

可以看到，模块可以由一个或者多个在一起的 Java 包组成，通过将这些包分出不同的模块，我们就可以按照模块的方式进行管理了。这里我们创建一个新的项目，并在`src`目录下，新建`module-info.java`文件表示此项目采用模块管理机制：

```java
module NewHelloWorld {  //模块名称随便起一个就可以，但是注意必须是唯一的，以及模块内的包名也得是唯一的，即使模块不同
    
}
```

接着我们来创建一个主类：

![image-20220528213210752](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ofzqina8j21lo0bymyz.jpg)

程序可以正常运行，貌似和之前没啥区别，不过我们发现，JDK为我们提供的某些框架不见了：

![image-20220528213428296](https://tva1.sinaimg.cn/large/e6c9d24egy1h2og24c18zj216o07gwf7.jpg)

Java为我们提供的`logging`相关日志库呢？我们发现现在居然不见了？实际上它就是被作为一个模块单独存在，这里我们需进行模块导入：

```java
module NewHelloWorld {  //模块名称随便起一个就可以
    requires java.logging;   //除了JDK的一些常用包之外，只有我们明确需要的模块才会导入依赖库
  	//当然如果要导入JavaSE的所有依赖，想之前一样的话，直接 requires java.se;  即可
}
```

这里我们导入java.logging相关模块后，就可以正常使用Logger了：

![image-20220528214247006](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ogarnv3hj21oi0bewgd.jpg)

![image-20220528214308194](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ogb52z1fj214203ejrl.jpg)

是不是瞬间感觉编写代码时清爽了许多，全新的模块化机制提供了另一个级别的Java代码可见性、可访问性的控制，不过，你以为仅仅是做了包的分离吗？我们可以来尝试通过反射获取JDK提供的类中的字段：

```java
//Java17版本的String类
public final class String
    implements java.io.Serializable, Comparable<String>, CharSequence,
               Constable, ConstantDesc {
    @Stable
    private final byte[] value;  //自JDK9后，为了提高性能，String底层数据存放的是byte[]而不是char[]
```

```java
public static void main(String[] args) throws NoSuchFieldException, IllegalAccessException {
    Class<String> stringClass = String.class;
    Field field = stringClass.getDeclaredField("value");   //这里我们通过反射来获取String类中的value字段
    field.setAccessible(true);   //由于是private访问权限，所以我们修改一下
    System.out.println(field.get("ABCD"));
}
```

但是我们发现，在程序运行之后，修改操作被阻止了：

![image-20220528221817482](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ohbps200j22l008qgpe.jpg)

反射 API 的 Java 9 封装和安全性得到了改进，如果模块没有明确授权给其他模块使用反射的权限，那么其他模块是不允许使用反射进行修改的，看来Unsafe类是玩不成了。

我们现在就来细嗦一下这个模块机制，首先模块具有四种类型：

* **系统模块：**来自JDK和JRE的模块（官方提供的模块，比如我们上面用的），我们也可以直接使用`java --list-modules`命令来列出所有的模块，不同的模块会导出不同的包供我们使用。
* **应用程序模块：**我们自己写的Java模块项目。
* **自动模块：**可能有些库并不是Java 9以上的模块项目，这种时候就需要做兼容了，默认情况下是直接导出所有的包，可以访问所有其他模块提供的类，不然之前版本的库就用不了了。
* **未命名模块：**我们自己创建的一个Java项目，如果没有创建`module-info.java`，那么会按照未命名模块进行处理，未命名模块同样可以访问所有其他模块提供的类，这样我们之前写的Java 8代码才能正常地在Java 9以及之后的版本下运行。不过，由于没有使用Java 9的模块新特性，未命名模块只能默认暴露给其他未命名的模块和自动模块，应用程序模块无法访问这些类（实际上就是传统Java 8以下的编程模式，因为没有模块只需要导包就行）

这里我们就来创建两个项目，看看如何使用模块机制，首先我们在项目A中，添加一个User类，一会项目B需要用到：

```java
package com.test;

public class User {
    String name;
    int age;

    public User(String name, int age) {
        this.name = name;
        this.age = age;
    }

    @Override
    public String toString() {
        return name+" ("+age+"岁)";
    }
}
```

接着我们编写一下项目A的模块设置：

![image-20220528230842617](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ois6anujj21mu09075b.jpg)

这里我们将`com.test`包下所有内容都暴露出去，默认情况下所有的包都是私有的，就算其他项目将此项目作为依赖也无法使用。

接着我们现在想要在项目B中使用项目A的User类，我们需要进行导入：

![image-20220528232033318](https://tva1.sinaimg.cn/large/e6c9d24egy1h2oj4ivmi3j21kw08ujsm.jpg)

现在我们就可以在Main类中使用模块`module.a`中暴露出来的包内容了：

```java
import com.test.User;   //如果模块module.a不暴露，那么将无法导入

public class Main {
    public static void main(String[] args) {
        User user = new User("lbw", 18);
        System.out.println(user);
    }
}
```

当然除了普通的`exports`进行包的暴露之外，我们也可以直接指定将包暴露给指定的模块：

```java
module module.a {
    exports com.test to module.b;   //这里我们将com.test包暴露给指定的模块module.b，非指定的模块即使导入也无法使用
}
```

不过现在还有一个问题，如果模块`module.a`依赖于其他模块，那么会不会传递给依赖于模块`module.a`的模块呢？

```java
module module.a {
    exports com.test to module.b;   //使用exports将com.test包下所有内容暴露出去，这样其他模块才能导入
    requires java.logging;   //这里添加一个模块的依赖
}
```

![image-20220529103614788](https://tva1.sinaimg.cn/large/e6c9d24ely1h2p2njtdxyj21gu09iabi.jpg)

可以看到，在模块`module.b`中，并没有进行依赖传递，说明哪个模块导入的依赖只能哪个模块用，但是现在我们希望依赖可以传递，就是哪个模块用了什么依赖，依赖此模块的模块也会自动进行依赖，我们可以通过一个关键字解决：

```java
module module.a {
    exports com.test to module.b;   //使用exports将com.test包下所有内容暴露出去，这样其他模块才能导入
    requires transitive java.logging;   //使用transitive来向其他模块传递此依赖
}
```

现在就可以使用了：

![image-20220529103828560](https://tva1.sinaimg.cn/large/e6c9d24ely1h2p2pvizv2j21cu0b275z.jpg)

还有我们前面演示的反射，我们发现如果我们依赖了一个模块，是没办法直接进行反射操作的：

```java
public static void main(String[] args) throws NoSuchFieldException, IllegalAccessException {
    User user = new User("AAA", 18);
    Class<User> userClass = User.class;
    Field field = userClass.getDeclaredField("name");
    field.setAccessible(true);   //尝试修改访问权限
    System.out.println(field.get(user));
}
```

![image-20220529104451040](https://tva1.sinaimg.cn/large/e6c9d24ely1h2p2widxrbj22l608cwip.jpg)

那么怎么样才可以使用反射呢？我们可以为其他模块开放某些运行使用反射的类：

```java
open module module.a {   //直接添加open关键字开放整个模块的反射权限
    exports com.test to module.b;
}
```

```java
module module.a {
    exports com.test to module.b;
    opens com.test;   //通过使用opens关键字来为其他模块开放反射权限
  	//也可以指定目标开放反射 opens com.test to module.b;
}
```

我们还可以指定模块需要使用的抽象类或是接口实现：

```java
package com.test;

public interface Test {
}
```

```java
open module module.a {
    exports com.test to module.b;
    uses com.test.Test;  //使用uses指定，Test是一个接口（比如需要的服务等），模块需要使用到
}
```

我们可以在模块B中去实现一下，然后声明我们提供了实现类：

```java
package com.main;

import com.test.Test;

public class TestImpl implements Test {

}
```

```java
module module.b {
    requires module.a;   //导入项目A的模块，此模块暴露了com.test包
    provides com.test.Test with com.main.TestImpl;  //声明此模块提供了Test的实现类
}
```

了解了以上的相关知识后，我们就可以简单地进行模块的使用了。比如现在我们创建了一个新的Maven项目：

![image-20220529112208486](https://tva1.sinaimg.cn/large/e6c9d24ely1h2p3zb45vqj225w0qowlb.jpg)

然后我们导入了lombok框架的依赖，如果我们不创建`module-info.java`文件，那么就是一个未命名模块，未命名模块默认可以使用其他所有模块提供的类，实际上就是我们之前的开发模式：

```java
package com.test;

import lombok.extern.java.Log;

@Log
public class Main {
    public static void main(String[] args) {
        log.info("Hello World!");   //使用lombok提供的注解，可以正常运行
    }
}
```

现在我们希望按照全新的模块化开发模式来进行开发，将我们的项目从未命名模块改进为应用程序模块，所以我们先创建好`module-info.java`文件：

```java
module com.test {
}
```

可以看到，直接报错了：

![image-20220529112707958](https://tva1.sinaimg.cn/large/e6c9d24ely1h2p44huvl1j21tk0bcmzz.jpg)

明明导入了lombok依赖，却无法使用，这是因为我们还需要去依赖对应的模块才行：

```java
module com.test {
    requires lombok;   //lombok模块
    requires java.logging;    //JUL日志模块，也需要使用到
}
```

![image-20220529112909452](https://tva1.sinaimg.cn/large/e6c9d24ely1h2p46lqnndj21au0fu0ug.jpg)

这样我们就可以正常使用了，之后为了教程演示方便，咱们还是不用模块。

### JShell交互式编程

Java 9为我们通过了一种交互式编程工具JShell，你还别说，真有Python那味。

![image-20220529141547082](https://tva1.sinaimg.cn/large/e6c9d24egy1h2p8zzjlfdj20v204yaaf.jpg)

环境配置完成后，我们只需要输入`jshell`命令即可开启交互式编程了，它支持我们一条一条命令进行操作。

比如我们来做一个简单的计算：

![image-20220529141719363](https://tva1.sinaimg.cn/large/e6c9d24egy1h2p91l5635j212609qt8z.jpg)

我们一次输入一行（可以不加分号），先定义一个a=10和b=10，然后定义c并得到a+b的结果，可以看到还是非常方便的，但是注意语法还是和Java是一样的。

![image-20220529141954494](https://tva1.sinaimg.cn/large/e6c9d24egy1h2p949kt5nj20ze06sdg8.jpg)

我们也可以快速创建一个方法供后续的调用。当我们按下Tab键还可以进行自动补全：

![image-20220529142340030](https://tva1.sinaimg.cn/large/e6c9d24egy1h2p986jzkdj215608074z.jpg)

除了直接运行我们写进去的代码之外，它还支持使用命令，输入`help`来查看命令列表：

![image-20220529142440584](https://tva1.sinaimg.cn/large/e6c9d24egy1h2p998buwcj217m0a4t9r.jpg)

比如我们可以使用`/vars`命令来展示当前定义的变量列表：

![image-20220529142757286](https://tva1.sinaimg.cn/large/e6c9d24egy1h2p9cn6p6qj20wy042t8s.jpg)

当我们不想使用jshell时，直接输入`/exit`退出即可：

![image-20220529142852920](https://tva1.sinaimg.cn/large/e6c9d24egy1h2p9dlqiucj20rw03274b.jpg)

### 接口中的private方法

在Java 8中，接口中 的方法支持添加`default`关键字来添加默认实现：

```java
public interface Test {
    default void test(){
        System.out.println("我是test方法默认实现");
    }
}
```

而在Java 9中，接口再次得到强化，现在接口中可以存在私有方法了：

```java
public interface Test {
    default void test(){
        System.out.println("我是test方法默认实现");
        this.inner();   //接口中方法的默认实现可以直接调用接口中的私有方法
    }
    
    private void inner(){   //声明一个私有方法
        System.out.println("我是接口中的私有方法！");
    }
}
```

注意私有方法必须要提供方法体，因为权限为私有的，也只有这里能进行方法的具体实现了，并且此方法只能被接口中的其他私有方法或是默认实现调用。

### 集合类新增工厂方法

在之前，如果我们想要快速创建一个Map只能：

```java
public static void main(String[] args) {
    Map<String, Integer> map = new HashMap<>();   //要快速使用Map，需要先创建一个Map对象，然后再添加数据
    map.put("AAA", 19);
    map.put("BBB", 23);

    System.out.println(map);
}
```

而在Java 9之后，我们可以直接通过`of`方法来快速创建了：

```java
public static void main(String[] args) {
    Map<String, Integer> map = Map.of("AAA", 18, "BBB", 20);  //直接一句搞定

    System.out.println(map);
}
```

是不是感觉非常方便，of方法还被重载了很多次，分别适用于快速创建包含0~10对键值对的Map：

![image-20220529144905646](https://tva1.sinaimg.cn/large/e6c9d24egy1h2p9ymylq6j21k00ggact.jpg)

但是注意，通过这种方式创建的Map和通过Arrays创建的List比较类似，也是无法进行修改的。

当然，除了Map之外，其他的集合类都有相应的`of`方法：

```java
public static void main(String[] args) {
    Set<String> set = Set.of("BBB", "CCC", "AAA");  //注意Set中元素顺序并不一定你的添加顺序
    List<String> list = List.of("AAA", "CCC", "BBB");   //好耶，再也不用Arrays了
}
```

### 改进的 Stream API

还记得我们之前在JavaSE中学习的Stream流吗？当然这里不是指进行IO操作的流，而是JDK1.8新增的Stream API，通过它大大方便了我们的编程。

```java
public static void main(String[] args) {
    Stream
            .of("A", "B", "B", "C")   //这里我们可以直接将一些元素封装到Stream中
            .filter(s -> s.equals("B"))   //通过过滤器过滤
            .distinct()   //去重
            .forEach(System.out::println);   //最后打印
}
```

自从有了Stream，我们对于集合的一些操作就大大地简化了，对集合中元素的批量处理，只需要在Stream中一气呵成（具体的详细操作请回顾JavaSE篇）

如此方便的框架，在Java 9得到了进一步的增强：

```java
public static void main(String[] args) {
    Stream
            .of(null)   //如果传入null会报错
            .forEach(System.out::println);

    Stream
            .ofNullable(null) //使用新增的ofNullable方法，这样就不会了，不过这样的话流里面就没东西了
            .forEach(System.out::println);
}
```

还有，我们可以通过迭代快速生成一组数据（实际上Java 8就有了，这里新增的是允许结束迭代的）：

```java
public static void main(String[] args) {
    Stream
            .iterate(0, i -> i + 1)   //Java8只能像这样生成无限的流，第一个参数是种子，就是后面的UnaryOperator的参数i一开始的值，最后会返回一个值作为i的新值，每一轮都会执行UnaryOperator并生成一个新值到流中，这个是源源不断的，如果不加limit()进行限制的话，将无限生成下去。
      			.limit(20)   //这里限制生成20个
            .forEach(System.out::println); 
}
```

```java
public static void main(String[] args) {
    Stream
            //不知道怎么写？参考一下：for (int i = 0;i < 20;i++)
            .iterate(0, i -> i < 20, i -> i + 1)  //快速生成一组0~19的int数据，中间可以添加一个断言，表示什么时候结束生成
            .forEach(System.out::println);
}
```

Stream还新增了对数据的截断操作，比如我们希望在读取到某个元素时截断，不再继续操作后面的元素：

```java
public static void main(String[] args) {
    Stream
            .iterate(0, i -> i + 1)
            .limit(20)
            .takeWhile(i -> i < 10)   //当i小于10时正常通过，一旦大于等于10直接截断
            .forEach(System.out::println);
}
```

```java
public static void main(String[] args) {
    Stream
            .iterate(0, i -> i + 1)
            .limit(20)
            .dropWhile(i -> i < 10)   //和上面相反，上来就是截断状态，只有当满足条件时再开始通过
            .forEach(System.out::println);
}
```

### 其他小型变动

Try-with-resource语法现在不需要再完整的声明一个变量了，我们可以直接将现有的变量丢进去：

```java
public static void main(String[] args) throws IOException {
    InputStream inputStream = Files.newInputStream(Paths.get("pom.xml"));
    try (inputStream) {   //单独丢进try中，效果是一样的
        for (int i = 0; i < 100; i++)
            System.out.print((char) inputStream.read());
    }
}
```

在Java 8中引入了Optional类，它很好的解决了判空问题：

```java
public static void main(String[] args) throws IOException {
    test(null);
}

public static void test(String s){
    //比如现在我们想执行 System.out.println(str.toLowerCase())
    //但是由于我们不清楚给进来的str到底是不是null，如果是null的话会引起空指针异常
    //但是去单独进行一次null判断写起来又不太简洁，这时我们可以考虑使用Optional进行包装
    Optional
            .ofNullable(s)
            .ifPresent(str -> System.out.println(str.toLowerCase()));
}
```

这种写法就有点像Kotlin或是JS中的语法：

```kotlin
fun main() {
    test(null)
}

fun test(str : String?){   //传入的String对象可能为null，这里类型写为String?
    println(str?.lowercase())   // ?.表示只有不为空才进行调用
}
```

在Java 9新增了一些更加方便的操作：

```java
public static void main(String[] args) {
    String str = null;
    Optional.ofNullable(str).ifPresentOrElse(s -> {  //通过使用ifPresentOrElse，我们同时处理两种情况
        System.out.println("被包装的元素为："+s);     //第一种情况和ifPresent是一样的
    }, () -> {
        System.out.println("被包装的元素为null");   //第二种情况是如果为null的情况
    });
}
```

我们也可以使用`or()`方法快速替换为另一个Optional类：

```java
public static void main(String[] args) {
    String str = null;
    Optional.ofNullable(str)
      .or(() -> Optional.of("AAA"))   //如果当前被包装的类不是null，依然返回自己，但是如果是null，那就返回Supplier提供的另一个Optional包装
      .ifPresent(System.out::println);
}
```

当然还支持直接转换为Stream，这里就不多说了。

在Java 8及之前，匿名内部类是没办法使用钻石运算符进行自动类型推断的：

```java
public abstract class Test<T>{   //这里我们写一个泛型类
    public T t;

    public Test(T t) {
        this.t = t;
    }

    public abstract T test();
}
```

```java
public static void main(String[] args) throws IOException {
    Test<String> test = new Test<>("AAA") {   //在低版本这样写是会直接报错的，因为匿名内部类不支持自动类型推断，但是很明显我们这里给的参数是String类型的，所以明明有机会进行类型推断，却还是要我们自己填类型，就很蠢
      //在Java 9之后，这样的写法终于可以编译通过了
        @Override
        public String test() {
            return t;
        }
    };
}
```

当然除了以上的特性之外还有Java 9的多版本JAR包支持、CompletableFuture API的改进等，因为不太常用，这里就不做介绍了。

## Java 10 新特性

Java 10主要带来的是一些内部更新，相比Java 9带来的直观改变不是很多，其中比较突出的就是局部变量类型推断了。

### 局部变量类型推断

在Java中，我们可以使用自动类型推断：

```java
public static void main(String[] args) {
    // String a = "Hello World!";   之前我们定义变量必须指定类型
    var a = "Hello World!";   //现在我们使用var关键字来自动进行类型推断，因为完全可以从后面的值来判断是什么类型
}
```

但是注意，`var`关键字必须位于有初始值设定的变量上，否则鬼知道你要用什么类型。

![image-20220529171216795](https://tva1.sinaimg.cn/large/e6c9d24egy1h2pe3mpaw5j210u054jrw.jpg)

我们来看看是不是类型也能正常获取：

```java
public static void main(String[] args) {
    var a = "Hello World!";
    System.out.println(a.getClass());
}
```

这里虽然是有了var关键字进行自动类型推断，但是最终还是会变成String类型，得到的Class也是String类型。但是Java终究不像JS那样进行动态推断，这种类型推断仅仅发生在编译期间，到最后编译完成后还是会变成具体类型的：

![image-20220529170538383](https://tva1.sinaimg.cn/large/e6c9d24egy1h2pdwq4g2aj218e0b4jsh.jpg)

并且`var`关键字仅适用于局部变量，我们是没办法在其他地方使用的，比如类的成员变量：

![image-20220529171444062](https://tva1.sinaimg.cn/large/e6c9d24egy1h2pe66iavlj216y0963z1.jpg)

有关Java 10新增的一些其他改进，这里就不提了。

## Java 11 新特性

Java 11 是继Java 8之后的又一个TLS长期维护版本，在Java 17出现之前，一直都是此版本作为广泛使用的版本，其中比较关键的是用于Lambda的形参局部变量语法。

### 用于Lambda的形参局部变量语法

在Java 10我们认识了`var`关键字，它能够直接让局部变量自动进行类型推断，不过它不支持在lambda中使用：

![image-20220529235822891](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ppu61uu4j211w05m3z0.jpg)

但是实际上这里是完全可以进行类型推断的，所以在Java 11，终于是支持了，这样编写就不会报错了：

![image-20220529235935071](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ppvf70n0j213g05m3yu.jpg)

### 针对于String类的方法增强

在Java 11为String新增一些更加方便的操作：

```java
public static void main(String[] args) {
    var str = "AB\nC\nD";
    System.out.println(str.isBlank());    //isBlank方法用于判断是否字符串为空或者是仅包含空格
    str
            .lines()   //根据字符串中的\n换行符进行切割，分为多个字符串，并转换为Stream进行操作
            .forEach(System.out::println);
}
```

我们还可以通过`repeat()`方法来让字符串重复拼接：

```java
public static void main(String[] args) {
    String str = "ABCD";   //比如现在我们有一个ABCD，但是现在我们想要一个ABCDABCD这样的基于原本字符串的重复字符串
    System.out.println(str.repeat(2));  //一个repeat就搞定了
}
```

我们也可以快速地进行空格去除操作：

```java
public static void main(String[] args) {
    String str = " A B C D ";
    System.out.println(str.strip());   //去除首尾空格
    System.out.println(str.stripLeading());  //去除首部空格
    System.out.println(str.stripTrailing());   //去除尾部空格
}
```

### 全新的HttpClient使用

在Java 9的时候其实就已经引入了全新的Http Client API，用于取代之前比较老旧的HttpURLConnection类，新的API支持最新的HTTP2和WebSocket协议。

```java
public static void main(String[] args) throws URISyntaxException, IOException, InterruptedException {
    HttpClient client = HttpClient.newHttpClient();   //直接创建一个新的HttpClient
  	//现在我们只需要构造一个Http请求实体，就可以让客户端帮助我们发送出去了（实际上就跟浏览器访问类似）
    HttpRequest request = HttpRequest.newBuilder().uri(new URI("https://www.baidu.com")).build();
  	//现在我们就可以把请求发送出去了，注意send方法后面还需要一个响应体处理器（内置了很多）这里我们选择ofString直接吧响应实体转换为String字符串
    HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());
  	//来看看响应实体是什么吧
    System.out.println(response.body());
}
```

利用全新的客户端，我们甚至可以轻松地做一个爬虫（仅供学习使用，别去做违法的事情，爬虫玩得好，牢饭吃到饱），比如现在我们想去批量下载某个网站的壁纸：

![image-20220530112549225](https://tva1.sinaimg.cn/large/e6c9d24egy1h2q9pg4bvdj22920jcq83.jpg)

网站地址：https://pic.netbian.com/4kmeinv/

我们随便点击一张壁纸，发现网站的URL格式为：

![image-20220530112701156](https://tva1.sinaimg.cn/large/e6c9d24egy1h2q9qp1af0j220s0loaf5.jpg)

并且不同的壁纸似乎都是这样：https://pic.netbian.com/tupian/数字.html，好了差不多可以开始整活了：

```java
public static void main(String[] args) throws URISyntaxException, IOException, InterruptedException {
    HttpClient client = HttpClient.newHttpClient();
    for (int i = 0; i < 10; i++) {  //先不要一次性获取太多，先来10个
        HttpRequest request = HttpRequest.newBuilder().uri(new URI("https://pic.netbian.com/tupian/"+(29327 + i)+".html")).build();  //这里我们按照规律，批量获取
        HttpResponse<String> response = client.send(request, HttpResponse.BodyHandlers.ofString());
        System.out.println(response.body());  //这里打印一下看看网页
    }
}
```

可以看到，最后控制台成功获取到这些图片的网站页面了：

![image-20220530113039571](https://tva1.sinaimg.cn/large/e6c9d24egy1h2q9uh6barj21k40b40w3.jpg)

接着我们需要来观察一下网站的HTML具体怎么写的，把图片的地址提取出来：

![image-20220530113136156](https://tva1.sinaimg.cn/large/e6c9d24egy1h2q9vgs183j22b60esdmg.jpg)

好了，知道图片在哪里就好办了，直接字符串截取：

```java
public static void main(String[] args) throws URISyntaxException, IOException, InterruptedException {
    HttpClient client = HttpClient.newHttpClient();
    for (int i = 0; i < 10; i++) {
        ...
        String html = response.body();
        
        String prefix = "<a href=\"\" id=\"img\"><img src=\"";  //先找好我们要截取的前面一段，作为前缀去匹配位置
        String suffix = "\" data-pic=";   //再找好我们要截取的屁股后面紧接着的位置，作为后缀去匹配位置
      	//直接定位，然后前后截取，得到最终的图片地址
        html = html.substring(html.indexOf(prefix) + prefix.length());
        html = html.substring(0, html.indexOf(suffix));
        System.out.println(html);  //最终的图片地址就有了
    }
}
```

好了，现在图片地址也可以批量拿到了，直接获取这些图片然后保存到本地吧：

```java
public static void main(String[] args) throws URISyntaxException, IOException, InterruptedException {
    HttpClient client = HttpClient.newHttpClient();
    for (int i = 0; i < 10; i++) {
        ...
				//创建请求，把图片取到
        HttpRequest imageRequest = HttpRequest.newBuilder().uri(new URI("https://pic.netbian.com"+html)).build();
      	//这里以输入流的方式获取，不过貌似可以直接下载文件，各位小伙伴可以单独试试看
        HttpResponse<InputStream> imageResponse = client.send(imageRequest, HttpResponse.BodyHandlers.ofInputStream());
      	//拿到输入流和文件输出流
        InputStream imageInput = imageResponse.body();
        FileOutputStream stream = new FileOutputStream("images/"+i+".jpg"); //一会要保存的格式
        try (stream;imageInput){  //直接把要close的变量放进来就行，简洁一些了
            int size;   //下面具体保存过程的不用我多说了吧
            byte[] data = new byte[1024];  
            while ((size = imageInput.read(data)) > 0) {  
                stream.write(data, 0, size);
            }
        }
    }
}
```

我们现在来看看效果吧，美女的图片已经成功保存到本地了：

![image-20220530114824605](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qacy37g6j22bs0psjwj.jpg)

当然，这仅仅是比较简单的爬虫，不过我们的最终目的还是希望各位能够学会使用新的HttpClient API。

## Java 12-16 新特性

由于Java版本的更新迭代速度自Java 9开始为半年更新一次（Java 8到Java 9隔了整整三年），所以各个版本之间的更新内容比较少，剩余的6个版本，我们就多个版本放在一起进行讲解了。

![image-20220530120729757](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qawt5acvj21ci0u0tcg.jpg)

Java12-16这五个版本并非长期支持版本，所以很多特性都是一种处于实验性功能，12/13版本引入了一些实验性功能，并根据反馈进行调整，最后在后续版本中正式开放使用，其实就是体验服的那种感觉。

### 新的switch语法

在Java 12引入全新的switch语法，让我们使用switch语句更加的灵活，比如我们想要编写一个根据成绩得到等级的方法：

```java
/**
 * 传入分数（范围 0 - 100）返回对应的等级：
 *      100-90：优秀
 *      70-80：良好
 *      60-70：及格
 *      0-60：寄
 * @param score 分数
 * @return 等级
 */
public static String grade(int score){
    
}
```

现在我们想要使用switch来实现这个功能（不会吧不会吧，不会有人要想半天怎么用switch实现吧），之前的写法是：

```java
public static String grade(int score){
    score /= 10;  //既然分数段都是整数，那就直接整除10
  	String res = null;
    switch (score) {
        case 10:
        case 9:
            res =  "优秀";   //不同的分数段就可以返回不同的等级了
        		break;   //别忘了break，不然会贯穿到后面
        case 8:
        case 7:
            res = "良好";
        		break;
        case 6:
            res = "及格";
        		break;
        default:
            res = "不及格";
        		break;
    }
  	return res;
}
```

但是现在我们可以使用新的特性了：

```java
public static String grade(int score){
    score /= 10;  //既然分数段都是整数，那就直接整除10
    return switch (score) {   //增强版switch语法
        case 10, 9 -> "优秀";   //语法那是相当的简洁，而且也不需要我们自己考虑break或是return来结束switch了（有时候就容易忘记，这样的话就算忘记也没事了）
        case 8, 7 -> "良好"; 
        case 6 -> "及格";
        default -> "不及格";
    };
}
```

不过最后编译出来的样子，貌似还是和之前是一样的：

![image-20220530222918174](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qsvu3u7dj21zw0nawhc.jpg)

这种全新的switch语法称为`switch表达式`，它的意义不仅仅体现在语法的精简上，我们来看看它的详细规则：

```java
var res = switch (obj) {   //这里和之前的switch语句是一样的，但是注意这样的switch是有返回值的，所以可以被变量接收
    case [匹配值, ...] -> "优秀";   //case后直接添加匹配值，匹配值可以存在多个，需要使用逗号隔开，使用 -> 来返回如果匹配此case语句的结果
    case ...   //根据不同的分支，可以存在多个case
    default -> "不及格";   //注意，表达式要求必须涵盖所有的可能，所以是需要添加default的
};
```

那么如果我们并不是能够马上返回，而是需要做点什么其他的工作才能返回结果呢？

```java
var res = switch (obj) {   //增强版switch语法
    case [匹配值, ...] -> "优秀";
    default -> {   //我们可以使用花括号来将整套逻辑括起来
        //... 我是其他要做的事情
        yield  "不及格";  //注意处理完成后需要返回最终结果，但是这样并不是使用return，而是yield关键字
    }
};
```

当然，也可以像这样：

```java
var res = switch (args.length) {   //增强版switch语法
    case [匹配值, ...]:
        yield "AAA";   //传统的:写法，通过yield指定返回结果，同样不需要break
    default:
    		System.out.println("默认情况");
        yield "BBB";
};
```

这种全新的语法，可以说极大地方便了我们的编码，不仅代码简短，而且语义明确。唯一遗憾的是依然不支持区间匹配。

**注意：**switch表达式在Java 14才正式开放使用，所以我们项目的代码级别需要调整到14以上。

### 文本块

如果你学习过Python，一定知道三引号：

```python
#当我们需要使用复杂字符串时，可能字符串中包含了很多需要转义的字符，比如双引号等，这时我们就可以使用三引号来囊括字符串
multi_line =  """
                nice to meet you!
                  nice to meet you!
                      nice to meet you!
                """
print multi_line
```

没错，Java13也带了这样的特性，旨在方便我们编写复杂字符串，这样就不用再去用那么多的转义字符了：

![image-20220530230225037](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qtu8ym7pj218008w3z2.jpg)

可以看到，Java中也可以使用这样的三引号来表示字符串了，并且我们可以随意在里面使用特殊字符，包括双引号等，但是最后编译出来的结果实际上还是会变成一个之前这样使用了转义字符的字符串：

![image-20220530230343933](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qtvm8z1wj21e008kdgm.jpg)

仔细想想，这样我们写SQL或是HTML岂不是就舒服多了？

**注意：**文本块表达式在Java 15才正式开放使用，所以我们项目的代码级别需要调整到15以上。

### 新的instanceof语法

在Java 14，instanceof迎来了一波小更新（哈哈，这版本instanceof又加强了，版本强势语法）

比如我们之前要重写一个类的equals方法：

```java
public class Student {
    private final String name;

    public Student(String name) {
        this.name = name;
    }

    @Override
    public boolean equals(Object obj) {
        if(obj instanceof Student) {   //首先判断是否为Student类型
            Student student = (Student) obj;  //如果是，那么就类型转换
            return student.name.equals(this.name);  //最后比对属性是否一样
        }
        return false;
    }
}
```

在之前我们一直都是采用这种先判断类型，然后类型转换，最后才能使用的方式，但是这个版本instanceof加强之后，我们就不需要了，我们可以直接将student替换为模式变量：

![image-20220530232252253](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qufj2gt9j21da0bowg5.jpg)

```java
public class Student {
    private final String name;

    public Student(String name) {
        this.name = name;
    }

    @Override
    public boolean equals(Object obj) {
        if(obj instanceof Student student) {   //在比较完成的屁股后面，直接写变量名字，而这个变量就是类型转换之后的
            return student.name.equals(this.name);  //下面直接用，是不是贼方便
        }
        return false;
    }
}
```

在使用`instanceof`判断类型成立后，会自动强制转换类型为指定类型，简化了我们手动转换的步骤。

**注意：**新的instanceof语法在Java 16才正式开放使用，所以我们项目的代码级别需要调整到16以上。

### 空指针异常的改进

相信各位小伙伴在调试代码时，经常遇到空指针异常，比如下面的这个例子：

```java
public static void test(String a, String b){
    int length = a.length() + b.length();   //可能给进来的a或是b为null
    System.out.println(length);
}
```

那么为空时，就会直接：

![image-20220530232755797](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qukskyh6j21a602mgm0.jpg)

但是由于我们这里a和b都调用了`length()`方法，虽然空指针异常告诉我们问题出现在这一行，但是到底是a为null还是b为null呢？我们是没办法直接得到的（遇到过这种问题的扣个1吧，只能调试，就很头疼）

但是当我们在Java 14或更高版本运行时：

![image-20220530233031005](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qunhkgrcj21lc042my7.jpg)

这里会明确指出是哪一个变量调用出现了空指针，是不是感觉特别人性化。

### 记录类型

继类、接口、枚举、注解之后的又一新类型来了，它的名字叫"记录"，在Java 14中首次出场，这一出场，Lombok的噩梦来了。

在实际开发中，很多的类仅仅只是充当一个实体类罢了，保存的是一些不可变数据，比如我们从数据库中查询的账户信息，最后会被映射为一个实体类：

```java
@Data
public class Account {   //使用Lombok，一个注解就搞定了
    String username;
    String password;
}
```

Lombok可以说是简化代码的神器了，他能在编译时自动生成getter和setter、构造方法、toString()方法等实现，在编写这些实体类时，简直不要太好用，而这一波，官方也是看不下去了，于是自己也搞了一个记录类型。

记录类型本质上也是一个普通的类，不过是final类型且继承自java.lang.Record抽象类的，它会在编译时，会自动编译出 `public get` `hashcode` 、`equals`、`toString` 等方法，好家伙，这是要逼死Lombok啊。

```java
public record Account(String username, String password) {  //直接把字段写在括号中

}
```

使用起来也是非常方便，自动生成了构造方法和成员字段的公共get方法：

![image-20220530235609885](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qve5yx6tj219u086ab5.jpg)

并且toString也是被重写了的：

![image-20220530235719341](https://tva1.sinaimg.cn/large/e6c9d24egy1h2qvfdhp6oj219001s3yo.jpg)

`equals()`方法仅做成员字段之间的值比较，也是帮助我们实现好了的：

```java
Account account0 = new Account("Admin", "123456");
Account account1 = new Account("Admin", "123456");   //两个属性都是一模一样的
System.out.println(account0.equals(account1));  //得到true
```

是不是感觉这种类型就是专门为这种实体类而生的。

```java
public record Account(String username, String password) implements Runnable {  //支持实现接口，但是不支持继承，因为继承的坑位已经默认被占了

    @Override
    public void run() {
        
    }
}
```

**注意：**记录类型在Java 16才正式开放使用，所以我们项目的代码级别需要调整到16以上。

## Java 17 新特性

Java 17作为新的LTS长期维护版本，我们来看看都更新了什么（不包含预览特性，包括switch第二次增强，哈哈，果然还是强度不够，都连续加强两个版本了）

### 密封类型

密封类型可以说是Java 17正式推出的又一重磅类型，它在Java 15首次提出并测试了两个版本。

在Java中，我们可以通过继承（extends关键字）来实现类的能力复用、扩展与增强。但有的时候，可能并不是所有的类我们都希望能够被继承。所以，我们需要对继承关系有一些限制的控制手段，而密封类的作用就是**限制类的继承**。

实际上在之前我们如果不希望别人继承我们的类，可以直接添加`final`关键字：

```java
public final class A{   //添加final关键字后，不允许对此类继承
    
}
```

这样有一个缺点，如果添加了`final`关键字，那么无论是谁，包括我们自己也是没办法实现继承的，但是现在我们有一个需求，只允许我们自己写的类继承A，但是不允许别人写的类继承A，这时该咋写？在Java 17之前想要实现就很麻烦。

但是现在我们可以使用密封类型来实现这个功能：

```java
public sealed class A permits B{   //在class关键字前添加sealed关键字，表示此类为密封类型，permits后面跟上允许继承的类型，多个子类使用逗号隔开

}
```

密封类型有以下要求：

* 可以基于普通类、抽象类、接口，也可以是继承自其他接抽象类的子类或是实现其他接口的类等。
* 必须有子类继承，且不能是匿名内部类或是lambda的形式。
* `sealed`写在原来`final`的位置，但是不能和`final`、`non-sealed`关键字同时出现，只能选择其一。
* 继承的子类必须显式标记为`final`、`sealed`或是`non-sealed`类型。

标准的声明格式如下：

```java
public sealed [abstract] [class/interface] 类名 [extends 父类] [implements 接口, ...] permits [子类, ...]{
		//里面的该咋写咋写
}
```

注意子类格式为：

```java
public [final/sealed/non-sealed] class 子类 extends 父类 {   //必须继承自父类
			//final类型：任何类不能再继承当前类，到此为止，已经封死了。
  		//sealed类型：同父类，需要指定由哪些类继承。
  		//non-sealed类型：重新开放为普通类，任何类都可以继承。
}
```

比如现在我们写了这些类：

```java
public sealed class A  permits B{   //指定B继承A

}
```

```java
public final class B extends A {   //在子类final，彻底封死

}
```

我们可以看到其他的类无论是继承A还是继承B都无法通过编译：

![image-20220531090136485](https://tva1.sinaimg.cn/large/e6c9d24ely1h2rb5p7u49j216i05074q.jpg)

![image-20220531090152743](https://tva1.sinaimg.cn/large/e6c9d24ely1h2rb5zg837j2130050jrz.jpg)

但是如果此时我们主动将B设定为`non-sealed`类型：

```java
public non-sealed class B extends A {

}
```

这样就可以正常继承了，因为B指定了`non-sealed`主动放弃了密封特性，这样就显得非常灵活了。

当然我们也可以通过反射来获取类是否为密封类型：

```java
public static void main(String[] args) {
    Class<A> a = A.class;
    System.out.println(a.isSealed());   //是否为密封
}
```

至此，Java 9 - 17的主要新特性就讲解完毕了。
