![image-20220521153312361](https://tva1.sinaimg.cn/large/e6c9d24egy1h2g2a4fy7rj21fc0hkwsb.jpg)

# 设计模式（创建型）

软件设计模式（Design pattern），又称设计模式，是一套被反复使用、多数人知晓的、经过分类编目的、代码设计经验的总结。使用设计模式是为了可重用代码、让代码更容易被他人理解、保证代码可靠性、程序的重用性。

> 肯特·贝克和[沃德·坎宁安](https://baike.baidu.com/item/沃德·坎宁安/6488429)在1987年利用克里斯托佛·亚历山大在建筑设计领域里的思想开发了设计模式并把此思想应用在Smalltalk中的图形用户接口的生成中。一年后Erich Gamma在他的[苏黎世大学](https://baike.baidu.com/item/苏黎世大学/1621125)博士毕业论文中开始尝试把这种思想改写为适用于软件开发。与此同时James Coplien 在1989年至1991 年也在利用相同的思想致力于C++的开发，而后于1991年发表了他的著作Advanced C++ Idioms。就在这一年Erich Gamma 得到了博士学位，然后去了美国，在那与Richard Helm, Ralph Johnson ,John Vlissides合作出版了Design Patterns - Elements of Reusable Object-Oriented Software 一书，在此书中共收录了23个设计模式。这四位作者在软件开发领域里也以他们的匿名著称Gang of Four(四人帮，简称GoF),并且是他们在此书中的协作导致了软件设计模式的突破。

我们先来看看有关对象创建的几种设计模式。

## 工厂方法模式

首当其冲的是最简单的一种设计模式——工厂方法模式，我们知道，如果需要创建一个对象，那么最简单的方式就是直接new一个即可。而工厂方法模式代替了传统的直接new的形式，那么为什么要替代传统的new形式呢？

可以想象一下，如果所有的对象我们都通过new的方式去创建，那么当我们的程序中大量使用此对象时，突然有一天这个对象的构造方法或是类名发生了修改，那我们岂不是得挨个去进行修改？根据迪米特法则，我们应该尽可能地少与其他类进行交互，所以我们可以将那些需要频繁出现的对象创建，封装到一个工厂类中，当我们需要对象时，直接调用工厂类中的工厂方法来为我们生成对象，这样，就算类出现了变动，我们也只需要修改工厂中的代码即可，而不是大面积地进行修改。

同时，可能某些对象的创建并不只是一个new就可以搞定，可能还需要更多的步骤来准备构造方法需要的参数，所以我们来看看如何使用`简单工厂模式`来创建对象，既然是工厂，那么我们就来创建点工厂需要生产的东西：

```java
public abstract class Fruit {   //水果抽象类
    private final String name;
    
    public Fruit(String name){
        this.name = name;
    }

    @Override
    public String toString() {
        return name+"@"+hashCode();   //打印一下当前水果名称，还有对象的hashCode
    }
}
```

```java
public class Apple extends Fruit{   //苹果，继承自水果

    public Apple() {
        super("苹果");
    }
}
```

```java
public class Orange extends Fruit{  //橘子，也是继承自水果
    public Orange() {
        super("橘子");
    }
}
```

正常情况下，我们直接new就可以得到对象了：

```java
public class Main {
    public static void main(String[] args) {
        Apple apple = new Apple();
        System.out.println(apple);
    }
}
```

现在我们将对象的创建封装到工厂中：

```java
public class FruitFactory {
    /**
     * 这里就直接来一个静态方法根据指定类型进行创建
     * @param type 水果类型
     * @return 对应的水果对象
     */
    public static Fruit getFruit(String type) {
        switch (type) {
            case "苹果":
                return new Apple();
           	case "橘子":
                return new Orange();
            default:
                return null;
        }
    }
}
```

现在我们就可以使用此工厂来创建对象了：

```java
public class Main {
    public static void main(String[] args) {
        Fruit fruit = FruitFactory.getFruit("橘子");   //直接问工厂要，而不是我们自己去创建
        System.out.println(fruit);
    }
}
```

不过这样还是有一些问题，我们前面提到了开闭原则，一个软件实体，比如类、模块和函数应该对扩展开放，对修改关闭，但是如果我们现在需要新增一种水果，比如桃子，那么这时我们就得去修改工厂提供的工厂方法了，但是这样是不太符合开闭原则的，因为工厂实际上是针对于调用方提供的，所以我们应该尽可能对修改关闭。

所以，我们就利用对扩展开放，对修改关闭的性质，将`简单工厂模式`改进为`工厂方法模式`，那现在既然不让改，那么我们就看看如何去使用扩展的形式：

```java
public abstract class FruitFactory<T extends Fruit> {   //将水果工厂抽象为抽象类，添加泛型T由子类指定水果类型
    public abstract T getFruit();  //不同的水果工厂，通过此方法生产不同的水果
}
```

```java
public class AppleFactory extends FruitFactory<Apple> {  //苹果工厂，直接返回Apple，一步到位
    @Override
    public Apple getFruit() {
        return new Apple();
    }
}
```

这样，我们就可以使用不同类型的工厂来生产不同类型的水果了，并且如果新增了水果类型，直接创建一个新的工厂类就行，不需要修改之前已经编写好的内容。

```java
public class Main {
    public static void main(String[] args) {
        test(new AppleFactory()::getFruit);   //比如我们现在要吃一个苹果，那么就直接通过苹果工厂来获取苹果
    }

    //此方法模拟吃掉一个水果
    private static void test(Supplier<Fruit> supplier){
        System.out.println(supplier.get()+" 被吃掉了，真好吃。");
    }
}
```

这样，我们就简单实现了工厂方法模式，通过工厂来屏蔽对象的创建细节，使用者只需要关心如何去使用对象即可。

## 抽象工厂模式

前面我们介绍了工厂方法模式，通过定义顶层抽象工厂类，通过继承的方式，针对于每一个产品都提供一个工厂类用于创建。

不过这种模式只适用于简单对象，当我们需要生产许多个产品族的时候，这种模式就有点乏力了，比如：

![image-20220521162444703](https://tva1.sinaimg.cn/large/e6c9d24egy1h2g3rpau36j218u0e0jt8.jpg)

实际上这些产品都是成族出现的，比如小米的产品线上有小米12，小米平板等，华为的产品线上也有华为手机、华为平板，但是如果按照我们之前工厂方法模式来进行设计，那就需要单独设计9个工厂来生产上面这些产品，显然这样就比较浪费时间的。

但是现在有什么方法能够更好地处理这种情况呢？我们就可以使用抽象工厂模式，我们可以将多个产品，都放在一个工厂中进行生成，按不同的产品族进行划分，比如小米，那么我就可以安排一个小米工厂，而这个工厂里面就可以生产整条产品线上的内容，包括小米手机、小米平板、小米路由等。

所以，我们只需要建立一个抽象工厂即可：

```java
public class Router {
}
```

```java
public class Table {
}
```

```java
public class Phone {
}
```

```java
public abstract class AbstractFactory {
    public abstract Phone getPhone();
    public abstract Table getTable();
    public abstract Router getRouter();
}
```

一个工厂可以生产同一个产品族的所有产品，这样按族进行分类，显然比之前的工厂方法模式更好。

不过，缺点还是有的，如果产品族新增了产品，那么我就不得不去为每一个产品族的工厂都去添加新产品的生产方法，违背了开闭原则。

## 建造者模式

建造者模式也是非常常见的一种设计模式，我们经常看到有很多的框架都为我们提供了形如`XXXBuilder`的类型，我们一般也是使用这些类来创建我们需要的对象。

比如，我们在JavaSE中就学习过的`StringBuiler`类：

```java
public static void main(String[] args) {
    StringBuilder builder = new StringBuilder();   //创建一个StringBuilder来逐步构建一个字符串
    builder.append(666);   //拼接一个数字
    builder.append("老铁");   //拼接一个字符串
   	builder.insert(2, '?');  //在第三个位置插入一个字符
    System.out.println(builder.toString());   //差不多成形了，最后转换为字符串
}
```

实际上我们是通过建造者来不断配置参数或是内容，当我们配置完所有内容后，最后再进行对象的构建。

相比直接去new一个新的对象，建造者模式的重心更加关注在如何完成每一步的配置，同时如果一个类的构造方法参数过多，我们通过建造者模式来创建这个对象，会更加优雅。

比如我们现在有一个学生类：

```java
public class Student {
    int id;
    int age;
    int grade;
    String name;
    String college;
    String profession;
    List<String> awards;

    public Student(int id, int age, int grade, String name, String college, String profession, List<String> awards) {
        this.id = id;
        this.age = age;
        this.grade = grade;
        this.name = name;
        this.college = college;
        this.profession = profession;
        this.awards = awards;
    }
}
```

可以看到这个学生类的属性是非常多的，所以构造方法不是一般的长，如果我们现在直接通过new的方式去创建：

```java
public static void main(String[] args) {
    Student student = new Student(1, 18, 3, "小明", "计算机学院", "计算机科学与技术", Arrays.asList("ICPC-ACM 区域赛 金牌", "LPL 2022春季赛 冠军"));
}
```

可以看到，我们光是填参数就麻烦，我们还得一个一个对应着去填，一不小心可能就把参数填到错误的位置了。

所以，我们现在可以使用建造者模式来进行对象的创建：

```java
public class Student {
		...

    //一律使用建造者来创建，不对外直接开放
    private Student(int id, int age, int grade, String name, String college, String profession, List<String> awards) {
        ...
    }

    public static StudentBuilder builder(){   //通过builder方法直接获取建造者
        return new StudentBuilder();
    }

    public static class StudentBuilder{   //这里就直接创建一个内部类
        //Builder也需要将所有的参数都进行暂时保存，所以Student怎么定义的这里就怎么定义
        int id;
        int age;
        int grade;
        String name;
        String college;
        String profession;
        List<String> awards;

        public StudentBuilder id(int id){    //直接调用建造者对应的方法，为对应的属性赋值
            this.id = id;
            return this;   //为了支持链式调用，这里直接返回建造者本身，下同
        }

        public StudentBuilder age(int age){
            this.age = age;
            return this;
        }
      
      	...

        public StudentBuilder awards(String... awards){
            this.awards = Arrays.asList(awards);
            return this;
        }
        
        public Student build(){    //最后我们只需要调用建造者提供的build方法即可根据我们的配置返回一个对象
            return new Student(id, age, grade, name, college, profession, awards);
        }
    }
}
```

现在，我们就可以使用建造者来为我们生成对象了：

```java
public static void main(String[] args) {
    Student student = Student.builder()   //获取建造者
            .id(1)    //逐步配置各个参数
            .age(18)
            .grade(3)
            .name("小明")
            .awards("ICPC-ACM 区域赛 金牌", "LPL 2022春季赛 冠军")
            .build();   //最后直接建造我们想要的对象
}
```

这样，我们就可以让这些参数对号入座了，并且也比之前的方式优雅许多。

## 单例模式

单例模式其实在之前的课程中已经演示过很多次了，这也是使用频率非常高的一种模式。

那么，什么是单例模式呢？顾名思义，单例那么肯定就是只有一个实例对象，在我们的整个程序中，同一个类始终只会有一个对象来进行操作。比如数据库连接类，实际上我们只需要创建一个对象或是直接使用静态方法就可以了，没必要去创建多个对象。

这里还是还原一下我们之前使用的简单单例模式：

```java
public class Singleton {
    private final static Singleton INSTANCE = new Singleton();   //用于引用全局唯一的单例对象，在一开始就创建好
    
    private Singleton() {}   //不允许随便new，需要对象直接找getInstance
    
    public static Singleton getInstance(){   //获取全局唯一的单例对象
        return INSTANCE;
    }
}
```

这样，当我们需要获取此对象时，只能通过`getInstance()`来获取唯一的对象：

```java
public static void main(String[] args) {
    Singleton singleton = Singleton.getInstance();
}
```

当然，单例模式除了这种写法之外，还有其他写法，这种写法被称为饿汉式单例，也就是说在一开始类加载时就创建好了，我们来看看另一种写法——懒汉式：

```java
public class Singleton {
    private static Singleton INSTANCE;   //在一开始先不进行对象创建

    private Singleton() {}   //不用多说了吧

    public static Singleton getInstance(){   //将对象的创建延后到需要时再进行
        if(INSTANCE == null) {    //如果实例为空，那么就进行创建，不为空说明已经创建过了，那么就直接返回
            INSTANCE = new Singleton();
        }
        return INSTANCE;
    }
}
```

可以看到，懒汉式就真的是条懒狗，你不去用它，它是不会给你提前准备单例对象的（延迟加载，懒加载），当我们需要获取对象时，才会进行检查并创建。虽然饿汉式和懒汉式写法不同，但是最后都是成功实现了单例模式。

不过，这里需要特别提醒一下，由于懒汉式是在方法中进行的初始化，在多线程环境下，可能会出现问题（建议学完JUC篇视频教程再来观看）大家可以试想一下，如果这个时候有多个线程同时调用了`getInstance()`方法，那么会出现什么问题呢？

![image-20220522161134092](https://tva1.sinaimg.cn/large/e6c9d24egy1h2h90c124gj21ae0bedhw.jpg)

可以看到，在多线程环境下，如果三条线程同时调用`getInstance()`方法，会同时进行`INSTANCE == null`的判断，那么此时由于确实还没有进行任何实例化，所以导致三条线程全部判断为`true`（而饿汉式由于在类加载时就创建完成，不会存在这样的问题）此时问题就来了，我们既然要使用单例模式，那么肯定是只希望对象只被初始化一次的，但是现在由于多线程的机制，导致对象被多次创建。

所以，为了避免线程安全问题，针对于懒汉式单例，我们还得进行一些改进：

```java
public static synchronized Singleton getInstance(){   //方法必须添加synchronized关键字加锁
    if(INSTANCE == null) {
        INSTANCE = new Singleton();
    }
    return INSTANCE;
}
```

既然多个线程要调用，那么我们就直接加一把锁，在方法上添加`synchronized`关键字即可，这样同一时间只能有一个线程进入了。虽然这样简单粗暴，但是在高并发的情况下，效率肯定是比较低的，我们来看看如何进行优化：

```java
public static Singleton getInstance(){
    if(INSTANCE == null) {
        synchronized (Singleton.class) {    //实际上只需要对赋值这一步进行加锁即可
            INSTANCE = new Singleton();   
        }
    }
    return INSTANCE;
}
```

不过这样还不完美，因为这样还是有可能多个线程同时判断为`null`而进入等锁的状态，所以，我们还得加一层内层判断：

```java
public static Singleton getInstance(){
    if(INSTANCE == null) {
        synchronized (Singleton.class) {
            if(INSTANCE == null) INSTANCE = new Singleton();  //内层还要进行一次检查，双重检查锁定
        }
    }
    return INSTANCE;
}
```

不过我们还少考虑了一样内容，其实IDEA此时应该是给了黄标了：

![image-20220522162246278](https://tva1.sinaimg.cn/large/e6c9d24egy1h2h9by3dioj21be0aqmyd.jpg)

可以看到，这种情况下，IDEA会要求我们添加一个`volatile`给`INSTANCE`，各位还记得这个关键字有什么作用吗？没错，我们还需要保证`INSTANCE`在线程之间的可见性，这样当其他线程进入之后才会拿`INSTANCE`由其他线程更新的最新值去判断，这样，就差不多完美了。

那么，有没有一种更好的，不用加锁的方式也能实现延迟加载的写法呢？我们可以使用静态内部类：

```java
public class Singleton {
    private Singleton() {}

    private static class Holder {   //由静态内部类持有单例对象，但是根据类加载特性，我们仅使用Singleton类时，不会对静态内部类进行初始化
        private final static Singleton INSTANCE = new Singleton();
    }

    public static Singleton getInstance(){   //只有真正使用内部类时，才会进行类初始化
        return Holder.INSTANCE;   //直接获取内部类中的
    }
}
```

这种方式显然是最完美的懒汉式解决方案，没有进行任何的加锁操作，也能保证线程安全，不过要实现这种写法，跟语言本身也有一定的关联，并不是所有的语言都支持这种写法。

## 原型模式

原型模式实际上与对象的拷贝息息相关，原型模式使用原型实例指定待创建对象的类型，并且通过复制这个原型来创建新的对象。也就是说，原型对象作为模板，通过克隆操作，来产生更多的对象，就像细胞的复制一样。

开始之前，我们先介绍一下对象的深拷贝和浅拷贝，首先我们来看浅拷贝：

* **浅拷贝：**对于类中基本数据类型，会直接复制值给拷贝对象；对于引用类型，只会复制对象的地址，而实际上指向的还是原来的那个对象，拷贝个基莫。

  ```java
  public static void main(String[] args) {
      int a = 10;
      int b = a;  //基本类型浅拷贝
      System.out.println(a == b);
  
      Object o = new Object();
      Object k = o;    //引用类型浅拷贝，拷贝的仅仅是对上面对象的引用
      System.out.println(o == k);
  }
  ```

* **深拷贝：**无论是基本类型还是引用类型，深拷贝会将引用类型的所有内容，全部拷贝为一个新的对象，包括对象内部的所有成员变量，也会进行拷贝。

在Java中，我们就可以使用Cloneable接口提供的拷贝机制，来实现原型模式：

```java
public class Student implements Cloneable{   //注意需要实现Cloneable接口
    @Override
    public Object clone() throws CloneNotSupportedException {   //提升clone方法的访问权限
        return super.clone();
    }
}
```

接着我们来看看克隆的对象是不是原来的对象：

```java
public static void main(String[] args) throws CloneNotSupportedException {
    Student student0 = new Student();
    Student student1 = (Student) student0.clone();
    System.out.println(student0);
    System.out.println(student1);
}
```

可以看到，通过`clone()`方法克隆的对象并不是原来的对象，我们来看看如果对象内部有属性会不会一起进行克隆：

```java
public class Student implements Cloneable{
    
    String name;

    public Student(String name){
        this.name = name;
    }
    
    public String getName() {
        return name;
    }

    @Override
    public Object clone() throws CloneNotSupportedException {
        return super.clone();
    }
}
```

```java
public static void main(String[] args) throws CloneNotSupportedException {
    Student student0 = new Student("小明");
    Student student1 = (Student) student0.clone();
    System.out.println(student0.getName() == student1.getName());
}
```

可以看到，虽然Student对象成功拷贝，但是其内层对象并没有进行拷贝，依然只是对象引用的复制，所以Java为我们提供的`clone`方法只会进行浅拷贝。那么如何才能实现深拷贝呢？

```java
@Override
public Object clone() throws CloneNotSupportedException {   //这里我们改进一下，针对成员变量也进行拷贝
    Student student = (Student) super.clone();
    student.name = new String(name);
    return student;   //成员拷贝完成后，再返回
}
```

这样，我们就实现了深拷贝。

