![image-20220524160923707](https://tva1.sinaimg.cn/large/e6c9d24ely1h2jk6p4i6hj21fa0h677n.jpg)

# 设计模式（行为型）

前面我们已经学习了12种设计模式，分为两类：

* 创建型：关注对象创建
* 结构型：关注类和对象的结构组织

我们接着来看最后一种设计模式，也是最多的一种，行为型设计模式关注系统中对象之间的交互，研究系统在运行时对象之间的相互通信与协作，进一步明确对象的职责。

## 解释器模式

这种模式的使用场景较少，很少使用的一种设计模式，这里提一下就行。

解释器顾名思义，就是对我们的语言进行解释，根据不同的语义来做不同的事情，比如我们在SE中学习的双栈计算器，正是根据我们输入的算式，去进行解析，并根据不同的运算符来不断进行计算。

比如我们输入：1+2*3

那么计算器就会进行解析然后根据语义优先计算2*3的结果然后在计算1+6最后得到7，详细实现请参考JavaSE篇双栈计算器实现。

## 模板方法模式

模板方法模式我们之前也见到过许多，我们先来看看什么是模板方法。

有些时候，我们的业务可能需要经历很多个步骤来完成，比如我们生病了在医院看病，首先是去门诊挂号，然后等待叫号，然后是去找医生看病，确定病因后，就根据医生的处方去前台开药，最后付钱。这一整套流程看似是规规矩矩的，但是在这其中，某些步骤并不是确定的，比如医生看病这一步，由于不同的病因，可能会进行不同的处理，最后开出来的药方也会不同，所以，整套流程中，有些操作是固定的，有些操作可能需要根据具体情况而定。

![image-20220524164925635](https://tva1.sinaimg.cn/large/e6c9d24ely1h2jlcb4jmqj20yi084mxz.jpg)

在我们的程序中也是如此，可能某些操作是固定的，我们就可以直接在类中对应方法进行编写，但是可能某些操作需要视情况而定，由不同的子类实现来决定，这时，我们就需要让这些操作由子类来延迟实现了。现在我们就需要用到模板方法模式。

我们先来写个例子：

```java
/**
 * 抽象诊断方法，因为现在只知道挂号和看医生是固定模式，剩下的开处方和拿药都是不确定的
 */
public abstract class AbstractDiagnosis {

    public void test(){
        System.out.println("今天头好晕，不想起床，开摆，先跟公司请个假");
        System.out.println("去医院看病了~");
        System.out.println("1 >> 先挂号");
        System.out.println("2 >> 等待叫号");
        //由于现在不知道该开什么处方，所以只能先定义一下行为，然后具体由子类实现
      	//大致的流程先定义好就行
        this.prescribe();
        this.medicine();  //开药同理
    }

    public abstract void prescribe();   //开处方操作根据具体病症决定了

    public abstract void medicine();   //拿药也是根据具体的处方去拿
}
```

现在我们定义好了抽象方法，只是将具体的流程先定义出来了，但是部分方法需要根据实现决定：

```java
/**
 * 感冒相关的具体实现子类
 */
public class ColdDiagnosis extends AbstractDiagnosis{
    @Override
    public void prescribe() {
        System.out.println("3 >> 一眼丁真，鉴定为假，你这不是感冒，纯粹是想摆烂");
    }

    @Override
    public void medicine() {
        System.out.println("4 >> 开点头孢回去吃吧");
    }
}
```

这样，我们就有了一个具体的实现类，并且由于看病的逻辑已经由父类定义好了，所以子类只需要实现需要实现的部分即可，这样我们就实现了简单的模板方法模式：

```java
public static void main(String[] args) {
    AbstractDiagnosis diagnosis = new ColdDiagnosis();
    diagnosis.test();
}
```

![image-20220524171621919](https://tva1.sinaimg.cn/large/e6c9d24ely1h2jm4bz3mej217k06s3z7.jpg)

最后我们来看看在JUC中讲解AQS源码实现中出现的代码：

```java
public final boolean release(int arg) {    //AQS的锁释放操作
    if (tryRelease(arg)) {   //可以看到这里调用了tryRelease方法，但是此方法并不是在AQS实现的，而是不同的锁自行实现，因为AQS也不知道你这种类型的锁到底该怎么去解锁
        Node h = head;
        if (h != null && h.waitStatus != 0)
            unparkSuccessor(h);
        return true;
    }
    return false;
}

protected boolean tryRelease(int arg) {
    throw new UnsupportedOperationException();   //AQS中不支持，需要延迟到具体的子类去实现
}
```

模板方法模式，实际上部分功能的实现是在子类完成的：

```java
protected final boolean tryRelease(int releases) {   
  //ReentrantLock中的AQS Sync实现类，对tryRelease方法进行了具体实现
    int c = getState() - releases;
    if (Thread.currentThread() != getExclusiveOwnerThread())
        throw new IllegalMonitorStateException();
    boolean free = false;
    if (c == 0) {
        free = true;
        setExclusiveOwnerThread(null);
    }
    setState(c);
    return free;
}
```

是不是现在感觉，这种层层套娃的写法，好像并不是这些大佬故意为了装逼才这样写的，而是真的在遵守规范编写，让代码更易懂一些，甚至你现在再回去推一遍会发现思路非常清晰。当然，除了这里之外，还有很多框架都使用了模板方法模式来设计类结构，还请各位小伙伴自行探索。

## 责任链模式

责任链模式也非常好理解，比如我们的钉钉审批，实际上就是一条流水线一样的操作，由你发起申请，然后经过多个部门主管审批，最后才能通过，所以你的申请表相当于是在一条责任链上传递。当然除了这样的直线型责任链之外，还有环形、树形等。

![image-20220524172400365](https://tva1.sinaimg.cn/large/e6c9d24ely1h2jmca3j84j21bs08kglw.jpg)

实际上我们之前也遇到过很多种责任链，比如JavaWeb中学习的Filter过滤器，正是采用的责任链模式，通过将请求一级一级不断向下传递，来对我们所需要的请求进行过滤和处理。

![image-20220524231849889](https://tva1.sinaimg.cn/large/e6c9d24egy1h2jwlifbqfj21ci05ujrx.jpg)

这里我们就使用责任链模式来模拟一个简单的面试过程，我们面试也是一面二面三面这样走的流程，这里我们先设计一下责任链上的各个处理器：

```java
public abstract class Handler {

    protected Handler successor;    //这里我们就设计责任链以单链表形式存在，这里存放后继节点

    public Handler connect(Handler successor){     //拼接后续节点
        this.successor = successor;
        return successor;  //这里返回后继节点，方便我们一会链式调用
    }

    public void handle(){
        this.doHandle();   //由不同的子类实现具体处理过程
        Optional
                .ofNullable(successor)
                .ifPresent(Handler::handle);    //责任链上如果还有后继节点，就继续向下传递
    }

    public abstract void doHandle();   //结合上节课学习的模板方法，交给子类实现
}
```

因为面试有很多轮，所以我们这里创建几个处理器的实现：

```java
public class FirstHandler extends Handler{   //用于一面的处理器
    @Override
    public void doHandle() {
        System.out.println("============= 白马程序员一面 ==========");
        System.out.println("1. 谈谈你对static关键字的理解？");
        System.out.println("2. 内部类可以调用外部的数据吗？如果是静态的呢？");
        System.out.println("3. hashCode()方法是所有的类都有吗？默认返回的是什么呢？");
        System.out.println("以上问题会的，可以依次打在评论区");
    }
}
```

```java
public class SecondHandler extends Handler{  //二面
    @Override
    public void doHandle() {
        System.out.println("============= 白马程序员二面 ==========");
        System.out.println("1. 如果我们自己创建一个java.lang包并且编写一个String类，能否实现覆盖JDK默认的？");
        System.out.println("2. HashMap的负载因子有什么作用？变化规律是什么？");
        System.out.println("3. 线程池的运作机制是什么？");
        System.out.println("4. ReentrantLock公平锁和非公平锁的区别是什么？");
        System.out.println("以上问题会的，可以依次打在评论区");
    }
}
```

```java
public class ThirdHandler extends Handler{
    @Override
    public void doHandle() {
        System.out.println("============= 白马程序员三面 ==========");
        System.out.println("1. synchronized关键字了解吗？如何使用？底层是如何实现的？");
        System.out.println("2. IO和NIO的区别在哪里？NIO三大核心组件？");
        System.out.println("3. TCP握手和挥手流程？少一次握手可以吗？为什么？");
        System.out.println("4. 操作系统中PCB是做什么的？运行机制是什么？");
        System.out.println("以上问题会的，可以依次打在评论区");
    }
}
```

这样我们就编写好了每一轮的面试流程，现在我们就可以构建一个责任链了：

```java
public static void main(String[] args) {
    Handler handler = new FirstHandler();  //一面首当其冲
    handler
            .connect(new SecondHandler())   //继续连接二面和三面
            .connect(new ThirdHandler());
    handler.handle();   //开始面试
} 
```

可以看到最后结果也是按照我们的责任链来进行的。

## 命令模式

大家有没有发现现在的家电都在趋向于智能化，通过一个中央控制器，我们就可以对家里的很多电器进行控制，比如国内做的比较好的小米智能家居系列，还有Apple的HomeKit等，我们只需要在一个终端上进行操作，就可以随便控制家里的电器。

![image-20220524235450650](https://tva1.sinaimg.cn/large/e6c9d24egy1h2jxmy55wej21g60jsjuz.jpg)

比如现在我们有很多的类，彩电、冰箱、空调、洗衣机、热水器等，既然现在我们要通过一个遥控器去控制他们，那么我们就需要将控制这些电器的指令都给设计好才行，并且还不能有太强的关联性。

所有的电器肯定需要通过蓝牙或是红外线接受遥控器发送的请求，所以所有的电器都是接收者：

```java
public interface Receiver {
    void action();   //具体行为，这里就写一个算了
}
```

接着我们要控制这些电器，那么肯定需要一个指令才能控制：

```java
public abstract class Command {   //指令抽象，不同的电器有指令

    private final Receiver receiver;

    protected Command(Receiver receiver){   //指定此命令对应的电器（接受者）
        this.receiver = receiver;
    }

    public void execute() {
        receiver.action();   //执行命令，实际上就是让接收者开始干活
    }
}
```

最后我们来安排一个遥控器：

```java
public class Controller {   //遥控器只需要把我们的指令发出去就行了
    public static void call(Command command){
        command.execute();
    }
}
```

比如现在我们创建一个空调，那么它就是作为我们命令的接收者：

```java
public class AirConditioner implements Receiver{
    @Override
    public void action() {
        System.out.println("空调已开启，呼呼呼");
    }
}
```

现在我们创建一个开启空调的命令：

```java
public class OpenCommand extends Command {
    public OpenCommand(AirConditioner airConditioner) {
        super(airConditioner);
    }
}
```

最后我们只需要通过遥控器发送出去就可以了：

```java
public static void main(String[] args) {
    AirConditioner airConditioner = new AirConditioner();   //先创建一个空调
    Controller.call(new OpenCommand(airConditioner));   //直接通过遥控器来发送空调开启命令
}
```

通过这种方式，遥控器这个角色并不需要知道具体会执行什么，只需要发送命令即可，遥控器和电器的关联性就不再那么强了。

## 迭代器模式

迭代器我们在JavaSE篇就已经讲解过了，迭代器可以说是我们学习Java语言的基础，没有迭代器，集合类的遍历就成了问题，正是因为有迭代器的存在，我们才能更加优雅的使用foreach语法。

回顾我们之前使用迭代器的场景：

```java
public static void main(String[] args) {
    List<String> list = Arrays.asList("AAA", "BBB", "CCC");
    for (String s : list) {   //使用foreach语法糖进行迭代，依次获取每一个元素
        System.out.println(s);   //打印一下
    }
}
```

编译之后的代码如下：

```java
public static void main(String[] args) {
    List<String> list = Arrays.asList("AAA", "BBB", "CCC");
    Iterator var2 = list.iterator();   //实际上这里本质是通过List生成的迭代器来遍历我们每个元素的

    while(var2.hasNext()) {   //判断是否还有元素可以迭代，没有就false
        String s = (String)var2.next();   //通过next方法得到下一个元素，每调用一次，迭代器会向后移动一位
        System.out.println(s);    //打印一下
    }
}
```

可以看到，当我们使用迭代器对List进行遍历时，实际上就像一个指向列表头部的指针，我们通过不断向后移动指针来依次获取所指向的元素：

![image-20220525171535024](https://tva1.sinaimg.cn/large/e6c9d24ely1h2krpu5p8gj218m0800tp.jpg)

![image-20220525171557523](https://tva1.sinaimg.cn/large/e6c9d24ely1h2krq82x3kj21c407474t.jpg)

这里，我们依照JDK提供的迭代器接口（JDK已经为我们定义好了一个迭代器的具体相关操作），也来设计一个迭代器：

```java
public class ArrayCollection<T> {    //首先设计一个简单的数组集合，一会我们就迭代此集合内的元素

    private final T[] array;   //底层使用一个数组来存放数据

    private ArrayCollection(T[] array){   //private掉，自己用
        this.array = array;
    }

    public static <T> ArrayCollection<T> of(T[] array){   //开个静态方法直接吧数组转换成ArrayCollection，其实和直接new一样，但是这样写好看一点
        return new ArrayCollection<>(array);
    }
}
```

现在我们就可以将数据存放在此集合中了：

```java
public static void main(String[] args) {
    String[] arr = new String[]{"AAA", "BBB", "CCC", "DDD"};
    ArrayCollection<String> collection = ArrayCollection.of(arr);
}
```

接着我们就可以来实现迭代器接口了：

```java
public class ArrayCollection<T> implements Iterable<T>{   //实现Iterable接口表示此类是支持迭代的

    ...

    @Override
    public Iterator<T> iterator() {    //需要实现iterator方法，此方法会返回一个迭代器，用于迭代我们集合中的元素
        return new ArrayIterator();
    }

    public class ArrayIterator implements Iterator<T> {   //这里实现一个，注意别用静态，需要使用对象中存放的数组
        private int cur = 0;   //这里我们通过一个指针表示当前的迭代位置

        @Override
        public boolean hasNext() {     //判断是否还有下一个元素
            return cur < array.length;   //如果指针大于或等于数组最大长度，就不能再继续了
        }

        @Override
        public T next() {   //返回当前指针位置的元素并向后移动一位
            return array[cur++];   //正常返回对应位置的元素，并将指针自增
        }
    }
}
```

接着，我们就可以对我们自己编写的一个简单集合类进行迭代了：

```java
public static void main(String[] args) {
    String[] arr = new String[]{"AAA", "BBB", "CCC", "DDD"};
    ArrayCollection<String> collection = ArrayCollection.of(arr);
    for (String s : collection) {    //可以直接使用foreach语法糖，当然最后还是会变成迭代器调用
        System.out.println(s);
    }
}
```

最后编译出来的样子：

```java
public static void main(String[] args) {
    String[] arr = new String[]{"AAA", "BBB", "CCC", "DDD"};
    ArrayCollection<String> collection = ArrayCollection.of(arr);
    Iterator var3 = collection.iterator();   //首先获取迭代器，实际上就是调用我们实现的iterator方法

    while(var3.hasNext()) {
        String s = (String)var3.next();   //直接使用next()方法不断向下获取
        System.out.println(s);
    }
}
```

这样我们就实现了一个迭代器来遍历我们的元素。

## 中介者模式

在早期，我们想要和别人进行语音聊天，一般都是通过电话的方式，我们通过拨打他人的电话号码，来建立会话，不过这样有一个问题，比如我现在想要通知通知3个人某件事情，那么我就得依次给三个人打电话，甚至还会遇到一种情况，就是我们没有某个人的电话号码，但是其他人有，这时还需要告知这个人并进行转告，就很麻烦。

![image-20220526164233041](https://tva1.sinaimg.cn/large/e6c9d24egy1h2lwdrfpkkj21dy0ewjx9.jpg)

但是现在我们有了Facetime、有了微信，我们可以同时让多个人参与到群通话中进行群聊，这样我们就不需要一个一个单独进行通话或是转达了。实际上正是依靠了一个中间商给我们提供了进行群体通话的平台，我们才能实现此功能，而这个平台实际上就是一个中间人。又比如我们想要去外面租房，但是我们怎么知道哪里有可以租的房子呢？于是我们就会上各大租房APP上去找房源，同样的，如果我们现在有房子需要出租，我们也不知道谁会想要租房子，同样的我们也会把房子挂在租房APP上展示，而当我们去租房时或是出租时，就会有一个称为中介的人来跟我们对接，实际上也是一种中介的模式。

在我们的程序中，可能也会出现很多的对象，但是这些对象之间的相互调用关系错综复杂，可能一个对象要做什么事情就得联系好几个对象：

![image-20220526174017796](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ly1umglnj21fa0dswg2.jpg)

但是如果我们在这中间搞一个中间人：

![image-20220526174129303](https://tva1.sinaimg.cn/large/e6c9d24egy1h2ly3337mpj21ek0d4abk.jpg)

这样当我们要联系其他人时，一律找中介就可以了，中介存储了所有人的联系方式，这样就不会像上面一样乱成一团了。这里我们就以房产中介的例子来编写：

```java
public class Mediator {   //房产中介
    private final Map<String, User> userMap = new HashMap<>();   //在出售的房子需要存储一下

    public void register(String address, User user){   //出售房屋的人，需要告诉中介他的房屋在哪里
        userMap.put(address, user);
    }

    public User find(String address){   //通过此方法来看看有没有对应的房源
        return userMap.get(address);
    }
}
```

接着就是用户了，用户有两种角色，一种是租房，一种是出租：

```java
public class User {   //用户可以是出售房屋的一方，也可以是寻找房屋的一方
    String name;
    String tel;

    public User(String name, String tel) {
        this.name = name;
        this.tel = tel;
    }
  
    public User find(String address, Mediator mediator){   //找房子的话，需要一个中介和你具体想找的地方
        return mediator.find(address);
    }

    @Override
    public String toString() {
        return name+" (电话："+tel+")";
    }
}
```

现在我们来测试一下：

```java
public static void main(String[] args) {
    User user0 = new User("刘女士", "10086");   //出租人
    User user1 = new User("李先生", "10010");   //找房人
    Mediator mediator = new Mediator();   //我是黑心中介

    mediator.register("成都市武侯区天府五街白马程序员", user0);   //先把房子给中介挂上去

    User user = user1.find("成都市武侯区天府五街下硅谷", mediator);  //开始找房子
    if(user == null) System.out.println("没有找到对应的房源");

    user = user1.find("成都市武侯区天府五街白马程序员", mediator);  //开始找房子
    System.out.println(user);   //成功找到对应房源
}
```

中介者模式优化了原有的复杂多对多关系，而是将其简化为一对多的关系，更容易理解一些。

## 备忘录模式

>  2021年10月1日下午，河南驻马店的一名13岁女中学生，因和同学发生不愉快喝下半瓶百草枯。
>
> 10月5日，抢救四天情况恶化，家属泣不成声称“肺部一个小时一变”。
>
> 10月6日下午，据武警河南省总队医院消息，“目前女孩仍在医院救治。”

喝下百草枯，会给你后悔的时间，但是不会给你后悔的机会（百草枯含有剧毒物质，会直接导致肺部纤维化，这是不可逆的，一般死亡过程在一周左右，即使家里花了再多的钱，接受了再多的治疗，也无法逆转这一过程）相信如果再给这位小女孩一次机会，回到拿起百草枯的那一刻，一定不会再冲动地喝下了吧。

![image-20220527123444026](https://tva1.sinaimg.cn/large/e6c9d24egy1h2muu9cw13j20pq07y0u1.jpg)

备忘录模式，就为我们的软件提供了一个可回溯的时间节点，可能我们程序在运行过程中某一步出现了错误，这时我们就可以回到之前的某个被保存的节点上重新来过（就像艾克的大招），我们平时编辑文本的时候，当我们编辑出现错误时，就需要撤回，而我们只需要按下`Ctrl+Z`就可以回到上一步，这样就大大方便了我们的文本编辑。

其实备忘录模式也可以应用到我们的程序中，如果你学习过安卓开发，安卓程序在很多情况下都会重新加载`Activity`，实际上安卓中`Activity`的`onSaveInstanceState`和`onRestoreInstanceState`就是用到了备忘录模式，分别用于保存和恢复，这样就算重新加载也可以恢复到之前的状态。

这里我们就模拟一下对象的状态保存：

```java
public class Student {
    private String currentWork;   //当前正在做的事情
    private int percentage;   //当前的工作完成百分比

    public void work(String currentWork) {
        this.currentWork = currentWork;
        this.percentage = new Random().nextInt(100);
    }

    @Override
    public String toString() {
        return "我现在正在做："+currentWork+" (进度："+percentage+"%)";
    }
}
```

接着我们需要保存它在某一时刻的状态，我们来编写一个状态保存类：

```java
public class State {
    final String currentWork;
    final int percentage;

    State(String currentWork, int percentage) {   //仅开放给同一个包下的Student类使用
        this.currentWork = currentWork;
        this.percentage = percentage;
    }
}
```

接着我们来将状态的保存和恢复操作都实现一下：

```java
public class Student {
    ...

    public State save(){
        return new State(currentWork, percentage);
    }

    public void restore(State state){
        this.currentWork = state.currentWork;
        this.percentage = state.percentage;
    }

    ...
}
```

现在我们来测试一下吧：

```java
public static void main(String[] args) {
    Student student = new Student();
    student.work("学Java");   //开始学Java
    System.out.println(student);

    State savedState = student.save();   //保存一下当前的状态

    student.work("打电动");   //刚打开B站播放视频，学一半开始摆烂了
    System.out.println(student);

    student.restore(savedState);   //两级反转！回到上一个保存的状态
    System.out.println(student);   //回到学Java的状态
}
```

可以看到，虽然在学习Java的过程中，中途摆烂了，但是我们可以时光倒流，回到还没开始摆烂的时候，继续学习Java：

![image-20220527163947219](https://tva1.sinaimg.cn/large/e6c9d24egy1h2n1x785gtj20x803m74l.jpg)

不过备忘录模式为了去保存对象的状态，会占用大量的资源，尤其是那种属性很多的对象，我们需要合理的使用才能保证程序稳定运行。

## 观察者模式

牵一发而动全身，一幅有序摆放的多米诺骨牌，在我们推到第一个骨牌时，后面的骨牌会不断地被上一个骨牌推倒：

![image-20220527164444210](https://tva1.sinaimg.cn/large/e6c9d24egy1h2n22ctg4rj20ym0cgact.jpg)

在Java中，一个对象的状态发生改变，可能就会影响到其他的对象，与之相关的对象可能也会联动的进行改变。还有我们之前遇到过的监听器机制，当具体的事件触发时，我们在一开始创建的监听器就可以执行相关的逻辑。我们可以使用观察者模式来实现这样的功能，当对象发生改变时，观察者能够立即观察到并进行一些联动操作，我们先定义一个观察者接口：

```java
public interface Observer {   //观察者接口
    void update();   //当对象有更新时，会回调此方法
}
```

接着我们来写一个支持观察者的实体类：

```java
public class Subject {
    private final Set<Observer> observerSet = new HashSet<>();

    public void observe(Observer observer) {   //添加观察者
        observerSet.add(observer);
    }

    public void modify() {   //模拟对象进行修改
        observerSet.forEach(Observer::update);   //当对象发生修改时，会通知所有的观察者，并进行方法回调
    }
}
```

接着我们就可以测试一下了：

```java
public static void main(String[] args) {
    Subject subject = new Subject();
    subject.observe(() -> System.out.println("我是一号观察者！"));
    subject.observe(() -> System.out.println("我是二号观察者！"));
    subject.modify();
}
```

这样，我们就简单实现了一下观察者模式，当然JDK也为我们提供了实现观察者模式相关的接口：

```java
import java.util.Observable;    //java.util包下提供的观察者抽象类

public class Subject extends Observable {   //继承此抽象类表示支持观察者

    public void modify(){
        System.out.println("对对象进行修改！");
        this.setChanged();    //当对对象修改后，需要setChanged来设定为已修改状态
        this.notifyObservers(new Date());   //使用notifyObservers方法来通知所有的观察者
      	//注意只有已修改状态下通知观察者才会有效，并且可以给观察者传递参数，这里传递了一个时间对象
    }
}
```

我们来测试一下吧：

```java
public static void main(String[] args) {
    Subject subject = new Subject();
    subject.addObserver((o, arg) -> System.out.println("监听到变化，并得到参数："+arg));  
  	//注意这里的Observer是java.util包下提供的
    subject.modify();   //进行修改操作
}
```

## 状态模式

在标准大气压下，水在0度时会结冰变成固态，在0-100度之间时，会呈现液态，100度以上会变成气态，水这种物质在不同的温度下呈现出不同的状态，而我们的对象，可能也会像这样存在很多种状态，甚至在不同的状态下会有不同的行为，我们就可以通过状态模式来实现。

![image-20220527215236172](https://tva1.sinaimg.cn/large/e6c9d24egy1h2nayq0qf7j21780comxv.jpg)

我们来设计一个学生类，然后学生的学习方法会根据状态不同而发生改变，我们先设计一个状态枚举：

```java
public enum State {   //状态直接使用枚举定义
    NORMAL, LAZY
}
```

接着我们来编写一个学生类：

```java
public class Student {

    public class Student {

    private State state;   //使用一个成员来存储状态

    public void setState(State state) {
        this.state = state;
    }

    public void study(){  
        switch (state) {   //根据不同的状态，学习方法会有不同的结果
            case LAZY:
                System.out.println("只要我不努力，老板就别想过上想要的生活，开摆！");
                break;
            case NORMAL:
                System.out.println("拼搏百天，我要上清华大学！");
                break;
        }
    }
}
```

我们来看看，在不同的状态下，是否学习会出现不同的效果：

```java
public static void main(String[] args) {
    Student student = new Student();
    student.setState(State.NORMAL);   //先正常模式
    student.study();

    student.setState(State.LAZY);   //开启摆烂模式
    student.study();
}
```

状态模式更加强调当前的对象所处的状态，我们需要根据对象不同的状态决定其他的处理逻辑。

## 策略模式

对面卡兹克打野被开了，我们是去打小龙还是打大龙呢？这就要看我们团队这一局的打法策略了。

![image-20220527222552772](https://tva1.sinaimg.cn/large/e6c9d24egy1h2nbxb021mj20ww0aotb1.jpg)

我们可以为对象设定一种策略，这样对象之后的行为就会按照我们在一开始指定的策略而决定了，看起来和前面的状态模式很像，但是，它与状态模式的区别在于，这种转换是“主动”的，是由我们去指定，而状态模式，可能是在运行过程中自动切换的。

其实策略模式我们之前也遇到过，比如线程池的拒绝策略：

```java
public static void main(String[] args) {
    ThreadPoolExecutor executor = new ThreadPoolExecutor(1, 1, 10,
            TimeUnit.SECONDS, new SynchronousQueue<>(),  //这里不给排队
            new ThreadPoolExecutor.AbortPolicy());   //当线程池无法再继续创建新任务时，我们可以自由决定使用什么拒绝策略

    Runnable runnable = () -> {
        try {
            TimeUnit.SECONDS.sleep(60);
        } catch (InterruptedException e) {
            throw new RuntimeException(e);
        }
    };
    
    executor.execute(runnable);   //连续提交两次任务，肯定塞不下，这时就得走拒绝了
    executor.execute(runnable);
}
```

可以看到，我们如果使用AbortPolicy，那么就是直接抛出异常：

![image-20220527223231753](https://tva1.sinaimg.cn/large/e6c9d24egy1h2nc480yhjj21ga034aap.jpg)

我们也可以使用其他的策略：

```java
public static void main(String[] args) {
    ThreadPoolExecutor executor = new ThreadPoolExecutor(1, 1, 10,
            TimeUnit.SECONDS, new SynchronousQueue<>(),
            new ThreadPoolExecutor.DiscardOldestPolicy());   //使用DiscardOldestPolicy策略从队列中丢弃
```

这种策略就会从等待队列中踢出一个之前的，不过我们这里的等待队列是没有容量的那种，所以会直接炸掉：

![image-20220527223510016](https://tva1.sinaimg.cn/large/e6c9d24egy1h2nc6ypzsnj21200220sw.jpg)

至于具体原因，可以回去看看JUC篇视频教程。

再比如我们现在有一个排序类，但是根据不同的策略，会使用不同的排序方案：

```java
public interface Strategy {   //策略接口，不同的策略实现也不同

    Strategy SINGLE = Arrays::sort;   //单线程排序方案
    Strategy PARALLEL = Arrays::parallelSort;   //并行排序方案
    
    void sort(int[] array);
}
```

现在我们编写一个排序类：

```java
public class Sorter {

    private Strategy strategy;   //策略

    public void setStrategy(Strategy strategy) {
        this.strategy = strategy;
    }

    public void sort(int[] array){
        strategy.sort(array);
    }
}
```

现在我们就可以指定不同的策略进行排序了：

```java
public static void main(String[] args) {
    Sorter sorter = new Sorter();
    sorter.setStrategy(Strategy.PARALLEL);    //指定为并行排序方案
    
    sorter.sort(new int[]{9, 2, 4, 5, 1, 0, 3, 7});
}
```

## 访问者模式

公园中存在多个景点，也存在多个游客，不同的游客对同一个景点的评价可能不同；医院医生开的处方单中包含多种药元素，査看它的划价员和药房工作人员对它的处理方式也不同，划价员根据处方单上面的药品名和数量进行划价，药房工作人员根据处方单的内容进行抓药，相对于处方单来说，划价员和药房工作人员就是它的访问者，不过访问者的访问方式可能会不同。

![image-20220527231226552](https://tva1.sinaimg.cn/large/e6c9d24egy1h2nd9r7qzlj219u0dk432.jpg)

在我们的Java程序中，也可能会出现这种情况，我们就可以通过访问者模式来进行设计。

比如我们日以继夜地努力，终于在某某比赛赢得了冠军，而不同的人对于这分荣誉，却有着不同的反应：

```java
public class Prize {   //奖
    String name;   //比赛名称
    String level;    //等级

    public Prize(String name, String level) {
        this.name = name;
        this.level = level;
    }

    public String getName() {
        return name;
    }

    public String getLevel() {
        return level;
    }
}
```

我们首先定义一个访问者接口：

```java
public interface Visitor {
    void visit(Prize prize);   //visit方法来访问我们的奖项
}
```

然后就是访问者相关的实现了：

```java
public class Teacher implements Visitor {   //指导老师作为一个访问者
    @Override
    public void visit(Prize prize) {   //它只关心你得了什么奖以及是几等奖，这也关乎老师的荣誉
        System.out.println("你得奖是什么奖？"+prize.name);
        System.out.println("你得了几等奖？"+prize.level);
    }
}
```

```java
public class Boss implements Visitor{    //你的公司老板作为一个访问者
    @Override
    public void visit(Prize prize) {   //你的老板只关心这些能不能为公司带来什么效益，奖本身并不重要
        System.out.println("你的奖项大么，能够为公司带来什么效益么？");
        System.out.println("还不如老老实实加班给我多干干，别去搞这些没用的");
    }
}
```

```java
public class Classmate implements Visitor{   //你的同学也可以作为一个访问者
    @Override
    public void visit(Prize prize) {   //你的同学也关心你得了什么奖，不过是因为你是他的奖学金竞争对手，他其实并不希望你得奖
        System.out.println("你得了"+prize.name+"奖啊，还可以");
        System.out.println("不过这个奖没什么含金量，下次别去了");
    }
}
```

```java
public class Family implements Visitor{    //你的家人也可以是一个访问者
    @Override
    public void visit(Prize prize) {   //你的家人并不是最关心你得了什么奖，而是先关心你自己然后才是奖项，他们才是真正希望你好的人。这个世界很残酷，可能你会被欺负得遍体鳞伤，可能你会觉得活着如此艰难，但是你的背后至少还有爱你的人，为了他们，怎能就此驻足。
        System.out.println("孩子，辛苦了，有没有好好照顾自己啊");
        System.out.println("你得了什么奖啊？"+prize.name+"，很不错，要继续加油啊！");
    }
}
```

可以看到，这里我们就设计了四种访问者，但是不同的访问者对于某一件事务的处理可能会不同。访问者模式把数据结构和作用于结构上的操作解耦，使得操作集合可相对自由地演化，我们上面就是将奖项本身的属性和对于奖项的不同操作进行了分离。
