![image-20220922170926093](https://s2.loli.net/2022/09/22/lmKBNFc5wPEgjaS.png)

# 面向对象高级篇

经过前面的学习，我们已经了解了面向对象编程的大部分基础内容，这一部分，我们将继续探索面向对象编程过程中一些常用的东西。

## 基本类型包装类

Java并不是纯面向对象的语言，虽然Java语言是一个面向对象的语言，但是Java中的基本数据类型却不是面向对象的。Java中的基本类型，如果想通过对象的形式去使用他们，Java提供的基本类型包装类，使得Java能够更好的体现面向对象的思想，同时也使得基本类型能够支持对象操作！

### 包装类介绍

所有的包装类层次结构如下：

![5c3a6a27-6370-4c60-9bbc-8039e11e752d](https://s2.loli.net/2022/09/22/mulb5VdvBLiWNe2.png)

其中能够表示数字的基本类型包装类，继承自Number类，对应关系如下表：

- byte  ->  Byte
- boolean  ->  Boolean
- short  ->  Short
- char  ->  Character
- int -> Integer
- long ->  Long
- float -> Float
- double -> Double

我们可以直接使用，这里我们以Integer类为例：

```java
public static void main(String[] args) {
    Integer i = new Integer(10);    //将10包装为一个Integer类型的变量
}
```

包装类实际上就是将我们的基本数据类型，封装成一个类（运用了封装的思想）我们可以来看看Integer类中是怎么写的：

```java
private final int value;  //类中实际上就靠这个变量在存储包装的值

public Integer(int value) {
    this.value = value;
}
```

包装类型支持自动装箱，我们可以直接将一个对应的基本类型值作为对应包装类型引用变量的值：

```java
public static void main(String[] args) {
    Integer i = 10;    //将int类型值作为包装类型使用
}
```

这是怎么做到的？为什么一个对象类型的值可以直接接收一个基本类类型的值？实际上这里就是自动装箱：

```java
public static void main(String[] args) {
    Integer i = Integer.valueOf(10);    //上面的写法跟这里是等价的
}
```

这里本质上就是被自动包装成了一个Integer类型的对象，只是语法上为了简单，就支持像这样编写。既然能装箱，也是支持拆箱的：

```java
public static void main(String[] args) {
    Integer i = 10;
    int a = i;
}
```

实际上上面的写法本质上就是：

```java
public static void main(String[] args) {
    Integer i = 10;
    int a = i.intValue();   //通过此方法变成基本类型int值
}
```

这里就是自动拆箱，得益于包装类型的自动装箱和拆箱机制，我们可以让包装类型轻松地参与到基本类型的运算中：

```java
public static void main(String[] args) {
    Integer a = 10, b = 20;
    int c = a * b;    //直接自动拆箱成基本类型参与到计算中
    System.out.println(c);
}
```

因为包装类是一个类，不是基本类型，所以说两个不同的对象，那么是不相等的：

```java
public static void main(String[] args) {
    Integer a = new Integer(10);
    Integer b = new Integer(10);

    System.out.println(a == b);    //虽然a和b的值相同，但是并不是同一个对象，所以说==判断为假
}
```

那么自动装箱的呢？

```java
public static void main(String[] args) {
    Integer a = 10, b = 10;
    System.out.println(a == b);
}
```

我们发现，通过自动装箱转换的Integer对象，如果值相同，得到的会是同一个对象，这是因为：

```java
public static Integer valueOf(int i) {
    if (i >= IntegerCache.low && i <= IntegerCache.high)   //这里会有一个IntegerCache，如果在范围内，那么会直接返回已经提前创建好的对象
        return IntegerCache.cache[i + (-IntegerCache.low)];
    return new Integer(i);
}
```

IntegerCache会默认缓存-128~127之间的所有值，将这些值提前做成包装类放在数组中存放，虽然我们目前还没有学习数组，但是各位小伙伴只需要知道，我们如果直接让 -128~127之间的值自动装箱为Integer类型的对象，那么始终都会得到同一个对象，这是为了提升效率，因为小的数使用频率非常高，有些时候并不需要创建那么多对象，创建对象越多，内存也会消耗更多。

但是如果超出这个缓存范围的话，就会得到不同的对象了：

```java
public static void main(String[] args) {
    Integer a = 128, b = 128;
    System.out.println(a == b);
}
```

这样就不会得到同一个对象了，因为超出了缓存的范围。同样的，Long、Short、Byte类型的包装类也有类似的机制，感兴趣的小伙伴可以自己点进去看看。

我们来看看包装类中提供了哪些其他的方法，包装类支持字符串直接转换：

```java
public static void main(String[] args) {
    Integer i = new Integer("666");   //直接将字符串的666，转换为数字666
    System.out.println(i);
}
```

当然，字符串转Integer有多个方法：

```java
public static void main(String[] args) {
    Integer i = Integer.valueOf("5555");
    //Integer i = Integer.parseInt("5555");
    System.out.println(i);
}
```

我们甚至可以对十六进制和八进制的字符串进行解码，得到对应的int值：

```java
public static void main(String[] args) {
    Integer i = Integer.decode("0xA6");
    System.out.println(i);
}
```

也可以将十进制的整数转换为其他进制的字符串：

```java
public static void main(String[] args) {
    System.out.println(Integer.toHexString(166));
}
```

当然，Integer中提供的方法还有很多，这里就不一一列出了。

### 特殊包装类

除了我们上面认识的这几种基本类型包装类之外，还有两个比较特殊的包装类型。

其中第一个是用于计算超大数字的BigInteger，我们知道，即使是最大的long类型，也只能表示64bit的数据，无法表示一个非常大的数，但是BigInteger没有这些限制，我们可以让他等于一个非常大的数字：

```java
public static void main(String[] args) {
    BigInteger i = BigInteger.valueOf(Long.MAX_VALUE);    //表示Long的最大值，轻轻松松
    System.out.println(i);
}
```

我们可以通过调用类中的方法，进行运算操作：

```java
public static void main(String[] args) {
    BigInteger i = BigInteger.valueOf(Long.MAX_VALUE);
    i = i.multiply(BigInteger.valueOf(Long.MAX_VALUE));   //即使是long的最大值乘以long的最大值，也能给你算出来
    System.out.println(i);
}
```

我们来看看结果：

![image-20220922211414392](https://s2.loli.net/2022/09/22/FTPGhgnAEm1QKkV.png)

可以看到，此时数值已经非常大了，也可以轻松计算出来。咱们来点更刺激的：

```java
public static void main(String[] args) {
    BigInteger i = BigInteger.valueOf(Long.MAX_VALUE);
    i = i.pow(100);   //long的最大值来个100次方吧
    System.out.println(i);
}
```

可以看到，这个数字已经大到一排显示不下了：

![image-20220922211651719](https://s2.loli.net/2022/09/22/w1OoFmbLiJ4rlcV.png)

一般情况，对于非常大的整数计算，我们就可以使用BigInteger来完成。

我们接着来看第二种，前面我们说了，浮点类型精度有限，对于需要精确计算的场景，就没办法了，而BigDecimal可以实现小数的精确计算。

```java
public static void main(String[] args) {
    BigDecimal i = BigDecimal.valueOf(10);
    i = i.divide(BigDecimal.valueOf(3), 100, RoundingMode.CEILING);
  	//计算10/3的结果，精确到小数点后100位
  	//RoundingMode是舍入模式，就是精确到最后一位时，该怎么处理，这里CEILING表示向上取整
    System.out.println(i);
}
```

可以看到，确实可以精确到这种程度：

![image-20220922212222762](https://s2.loli.net/2022/09/22/IUJ5rwzxonCBMT4.png)

但是注意，对于这种结果没有终点的，无限循环的小数，我们必须要限制长度，否则会出现异常。

***

## 数组

我们接着来看一个比较特殊的类型，数组。

假设出现一种情况，我们想记录100个数字，要是采用定义100个变量的方式可以吗？是不是有点太累了？这种情况我们就可以使用数组来存放一组相同类型的数据。

![image-20220922214604430](https://s2.loli.net/2022/09/22/y4ISWZLrYE3Pdig.png)

### 一维数组

数组是相同类型数据的有序集合，数组可以代表任何相同类型的一组内容（包括引用类型和基本类型）其中存放的每一个数据称为数组的一个元素，我们来看看如何去定义一个数组变量：

```java
public static void main(String[] args) {
    int[] array;   //类型[]就表示这个是一个数组类型
}
```

注意，数组类型比较特殊，它本身也是类，但是编程不可见（底层C++写的，在运行时动态创建）即使是基本类型的数组，也是以对象的形式存在的，并不是基本数据类型。所以，我们要创建一个数组，同样需要使用`new `关键字：

```java
public static void main(String[] args) {
    int[] array = new int[10];   //在创建数组时，需要指定数组长度，也就是可以容纳多个int变量的值
  	Object obj = array;   //因为同样是类，肯定是继承自Object的，所以说可以直接向上转型
}
```

除了上面这种方式之外，我们也可以使用其他方式：

```java
类型[] 变量名称 = new 类型[数组大小];
类型 变量名称[] = new 类型[数组大小];  //支持C语言样式，但不推荐！

类型[] 变量名称 = new 类型[]{...};  //静态初始化（直接指定值和大小）
类型[] 变量名称 = {...};   //同上，但是只能在定义时赋值
```

创建出来的数组每个位置上都有默认值，如果是引用类型，就是null，如果是基本数据类型，就是0，或者是false，跟对象成员变量的默认值是一样的，要访问数组的某一个元素，我们可以：

```java
public static void main(String[] args) {
    int[] array = new int[10];
    System.out.println("数组的第一个元素为："+array[0]);  //使用 变量名[下标] 的方式访问
}
```

注意，数组的下标是从0开始的，不是从1开始的，所以说第一个元素的下标就是0，我们要访问第一个元素，那么直接输入0就行了，但是注意千万别写成负数或是超出范围了，否则会出现异常。

我们也可以使用这种方式为数组的元素赋值：

```java
public static void main(String[] args) {
    int[] array = new int[10];
    array[0] = 888;   //就像使用变量一样，是可以放在赋值运算符左边的，我们可以直接给对应下标位置的元素赋值
    System.out.println("数组的第一个元素为："+array[0]);
}
```

因为数组本身也是一个对象，数组对象也是具有属性的，比如长度：

```java
public static void main(String[] args) {
    int[] array = new int[10];
    System.out.println("当前数组长度为："+array.length);   //length属性是int类型的值，表示当前数组长度，长度是在一开始创建数组的时候就确定好的
}
```

注意，这个`length`是在一开始就确定的，而且是`final`类型的，不允许进行修改，也就是说数组的长度一旦确定，不能随便进行修改，如果需要使用更大的数组，只能重新创建。

当然，既然是类型，那么肯定也是继承自Object类的：

```java
public static void main(String[] args) {
    int[] array = new int[10];
    System.out.println(array.toString());
    System.out.println(array.equals(array));
}
```

但是，很遗憾，除了clone()之外，这些方法并没有被重写，也就是说依然是采用的Object中的默认实现：

![image-20220922220403391](https://s2.loli.net/2022/09/22/UfTGu9sZheW21jB.png)

所以说通过`toString()`打印出来的结果，好丑，只不过我们可以发现，数组类型的类名很奇怪，是`[`开头的。

因此，如果我们要打印整个数组中所有的元素，得一个一个访问：

```java
public static void main(String[] args) {
    int[] array = new int[10];
    for (int i = 0; i < array.length; i++) {
        System.out.print(array[i] + " ");
    }
}
```

有时候为了方便，我们可以使用简化版的for语句`foreach`语法来遍历数组中的每一个元素：

```java
public static void main(String[] args) {
    int[] array = new int[10];
    for (int i : array) {    //int i就是每一个数组中的元素，array就是我们要遍历的数组
        System.out.print(i+" ");   //每一轮循环，i都会更新成数组中下一个元素
    }
}
```

是不是感觉这种写法更加简洁？只不过这仅仅是语法糖而已，编译之后依然是跟上面一样老老实实在遍历的：

```java
public static void main(String[] args) {   //反编译的结果
    int[] array = new int[10];
    int[] var2 = array;
    int var3 = array.length;

    for(int var4 = 0; var4 < var3; ++var4) {
        int i = var2[var4];
        System.out.print(i + " ");
    }

}
```

对于这种普通的数组，其实使用还是挺简单的。这里需要特别说一下，对于基本类型的数组来说，是不支持自动装箱和拆箱的：

```java
public static void main(String[] args) {
    int[] arr = new int[10];
    Integer[] test = arr;
}
```

还有，由于基本数据类型和引用类型不同，所以说int类型的数组时不能被Object类型的数组变量接收的：

![image-20220924114859252](https://s2.loli.net/2022/09/24/XbfZ9YHkqjv7613.png)

但是如果是引用类型的话，是可以的：

```java
public static void main(String[] args) {
    String[] arr = new String[10];
    Object[] array = arr;    //数组同样支持向上转型
}
```

```java
public static void main(String[] args) {
    Object[] arr = new Object[10];
    String[] array = (String[]) arr;   //也支持向下转型
}
```

### 多维数组

前面我们介绍了简单的数组（一维数组）既然数组可以是任何类型的，那么我们能否创建数组类型的数组呢？答案是可以的，套娃嘛，谁不会：

```java
public static void main(String[] args) {
    int[][] array = new int[2][10];    //数组类型数组那么就要写两个[]了
}
```

存放数组的数组，相当于将维度进行了提升，比如上面的就是一个2x10的数组：

![image-20220922221557130](https://s2.loli.net/2022/09/22/kRcO1aGY6fMBiu9.png)

这个中数组一共有2个元素，每个元素都是一个存放10个元素的数组，所以说最后看起来就像一个矩阵一样。甚至可以继续套娃，将其变成一个三维数组，也就是存放数组的数组的数组。

```java
public static void main(String[] args) {
    int[][] arr = { {1, 2},
                    {3, 4},
                    {5, 6}};   //一个三行两列的数组
    System.out.println(arr[2][1]);   //访问第三行第二列的元素
}
```

在访问多维数组时，我们需要使用多次`[]`运算符来得到对应位置的元素。如果我们要遍历多维数组话，那么就需要多次嵌套循环：

```java
public static void main(String[] args) {
    int[][] arr = new int[][]{{1, 2},
            									{3, 4},
            									{5, 6}};
    for (int i = 0; i < 3; i++) {    //要遍历一个二维数组，那么我们得一列一列一行一行地来
        for (int j = 0; j < 2; j++) {
            System.out.println(arr[i][j]);
        }
    }
}
```

### 可变长参数

我们接着来看数组的延伸应用，实际上我们的方法是支持可变长参数的，什么是可变长参数？

```java
public class Person {
    String name;
    int age;
    String sex;

    public void test(String... strings){

    }
}
```

我们在使用时，可以传入0 - N个对应类型的实参：

```java
public static void main(String[] args) {
    Person person = new Person();
    person.test("1！", "5！", "哥们在这跟你说唱"); //这里我们可以自由传入任意数量的字符串
}
```

那么我们在方法中怎么才能得到这些传入的参数呢，实际上可变长参数本质就是一个数组：

```java
public void test(String... strings){   //strings这个变量就是一个String[]类型的
    for (String string : strings) {
        System.out.println(string);   //遍历打印数组中每一个元素
    }
}
```

注意，如果同时存在其他参数，那么可变长参数只能放在最后：

```java
public void test(int a, int b, String... strings){
    
}
```

这里最后我们再来说一个从开始到现在一直都没有说的东西：

```java
public static void main(String[] args) {   //这个String[] args到底是个啥？？？
    
}
```

实际上这个是我们在执行Java程序时，输入的命令行参数，我们可以来打印一下：

```java
public static void main(String[] args) {
    for (String arg : args) {
        System.out.println(arg);
    }
}
```

可以看到，默认情况下直接运行什么都没有，但是如果我们在运行时，添加点内容的话：

```sh
java com/test/Main lbwnb aaaa xxxxx   #放在包中需要携带主类完整路径才能运行
```

可以看到，我们在后面随意添加的三个参数，都放到数组中了：

![image-20220922223152648](https://s2.loli.net/2022/09/22/DL3WTMdRwrSYJIl.png)

这个东西我们作为新手一般也不会用到，只做了解就行了。

***

## 字符串

字符串类是一个比较特殊的类，它用于保存字符串。我们知道，基本类型`char`可以保存一个2字节的Unicode字符，而字符串则是一系列字符的序列（在C中就是一个字符数组）Java中没有字符串这种基本类型，因此只能使用类来进行定义。注意，字符串中的字符一旦确定，无法进行修改，只能重新创建。

### String类

String本身也是一个类，只不过它比较特殊，每个用双引号括起来的字符串，都是String类型的一个实例对象：

```java
public static void main(String[] args) {
    String str = "Hello World!";
}
```

我们也可以象征性地使用一下new关键字：

```java
public static void main(String[] args) {
    String str = new String("Hello World!");  //这种方式就是创建一个新的对象
}
```

注意，如果是直接使用双引号创建的字符串，如果内容相同，为了优化效率，那么始终都是同一个对象：

```java
public static void main(String[] args) {
    String str1 = "Hello World";
    String str2 = "Hello World";
    System.out.println(str1 == str2);
}
```

但是如果我们使用构造方法主动创建两个新的对象，那么就是不同的对象了：

```java
public static void main(String[] args) {
    String str1 = new String("Hello World");
    String str2 = new String("Hello World");
    System.out.println(str1 == str2);
}
```

至于为什么会出现这种情况，我们在JVM篇视频教程中会进行详细的介绍，这里各位小伙伴只需要记住就行了。因此，如果我们仅仅是想要判断两个字符串的内容是否相同，不要使用`==`，String类重载了`equals`方法用于判断和比较内容是否相同：

```java
public static void main(String[] args) {
    String str1 = new String("Hello World");
    String str2 = new String("Hello World");
    System.out.println(str1.equals(str2));   //字符串的内容比较，一定要用equals
}
```

既然String也是一个类，那么肯定是具有一些方法的，我们可以来看看：

```java
public static void main(String[] args) {
    String str = "Hello World";
    System.out.println(str.length());   //length方法可以求字符串长度，这个长度是字符的数量
}
```

因为双引号括起来的字符串本身就是一个实例对象，所以说我们也可以直接用：

```java
public static void main(String[] args) {
    System.out.println("Hello World".length());   //虽然看起来挺奇怪的，但是确实支持这种写法
}
```

字符串类中提供了很多方便我们操作的方法，比如字符串的裁剪、分割操作：

```java
public static void main(String[] args) {
    String str = "Hello World";
    String sub = str.substring(0, 3);   //分割字符串，并返回一个新的子串对象
    System.out.println(sub);
}
```

```java
public static void main(String[] args) {
    String str = "Hello World";
    String[] strings = str.split(" ");   //使用split方法进行字符串分割，比如这里就是通过空格分隔，得到一个字符串数组
    for (String string : strings) {
        System.out.println(string);
    }
}
```

字符数组和字符串之间是可以快速进行相互转换的：

```java
public static void main(String[] args) {
    String str = "Hello World";
    char[] chars = str.toCharArray();
    System.out.println(chars);
}
```

```java
public static void main(String[] args) {
    char[] chars = new char[]{'奥', '利', '给'};
    String str = new String(chars);
    System.out.println(str);
}
```

当然，String类还有很多其他的一些方法，这里就不一一介绍了。

### StringBuilder类

我们在之前的学习中已经了解，字符串支持使用`+`和`+=`进行拼接操作。

但是拼接字符串实际上底层需要进行很多操作，如果程序中大量进行字符串的拼接似乎不太好，编译器是很聪明的，String的拼接会在编译时进行各种优化：

```java
public static void main(String[] args) {
    String str = "杰哥" + "你干嘛";    //我们在写代码时使用的是拼接的形式
    System.out.println(str);
}
```

编译之后就变成这样了：

```java
public static void main(String[] args) {
    String str = "杰哥你干嘛";
    System.out.println(str);
}
```

对于变量来说，也有优化，比如下面这种情况：

```java
public static void main(String[] args) {
    String str1 = "你看";
    String str2 = "这";
    String str3 = "汉堡";
    String str4 = "做滴";
    String str5 = "行不行";
    String result = str1 + str2 + str3 + str4 + str5;   //5个变量连续加
    System.out.println(result);
}
```

如果直接使用加的话，每次运算都会生成一个新的对象，这里进行4次加法运算，那么中间就需要产生4个字符串对象出来，是不是有点太浪费了？这种情况实际上会被优化为下面的写法：

```java
public static void main(String[] args) {
    String str1 = "你看";
    String str2 = "这";
    String str3 = "汉堡";
    String str4 = "做滴";
    String str5 = "行不行";
    StringBuilder builder = new StringBuilder();
    builder.append(str1).append(str2).append(str3).append(str4).append(str5);
    System.out.println(builder.toString());
}
```

这里创建了一个StringBuilder的类型，这个类型是干嘛的呢？实际上它就是专门用于构造字符串的，我们可以使用它来对字符串进行拼接、裁剪等操作，它就像一个字符串编辑器，弥补了字符串不能修改的不足：

```java
public static void main(String[] args) {
    StringBuilder builder = new StringBuilder();   //一开始创建时，内部什么都没有
    builder.append("AAA");   //我们可以使用append方法来讲字符串拼接到后面
    builder.append("BBB");
    System.out.println(builder.toString());   //当我们字符串编辑完成之后，就可以使用toString转换为字符串了
}
```

它还支持裁剪等操作：

```java
public static void main(String[] args) {
    StringBuilder builder = new StringBuilder("AAABBB");   //在构造时也可以指定初始字符串
    builder.delete(2, 4);   //删除2到4这个范围内的字符
    System.out.println(builder.toString());
}
```

当然，StringBuilder类的编辑操作也非常多，这里就不一一列出了。

### 正则表达式

我们现在想要实现这样一个功能，对于给定的字符串进行判断，如果字符串符合我们的规则，那么就返回真，否则返回假，比如现在我们想要判断字符串是不是邮箱的格式：

```java
public static void main(String[] args) {
    String str = "aaaa731341@163.com";
  	//假设邮箱格式为 数字/字母@数字/字母.com
}
```

那么现在请你设计一个Java程序用于判断，你该怎么做？是不是感觉很麻烦，但是我们使用正则表达式就可以很轻松解决这种字符串格式匹配问题。

> 正则表达式(regular expression)描述了一种字符串匹配的模式（pattern），可以用来检查一个串是否含有某种子串、将匹配的子串替换或者从某个串中取出符合某个条件的子串等。

我们先来看看下面的这个例子：

```java
public static void main(String[] args) {
    String str = "oooo";
  	//matches方法用于对给定正则表达式进行匹配，匹配成功返回true，否则返回false
    System.out.println(str.matches("o+"));   //+表示对前面这个字符匹配一次或多次，这里字符串是oooo，正好可以匹配
}
```

用于规定给定组件必须要出现多少次才能满足匹配的，我们一般称为限定符，限定符表如下：

| 字符  |                             描述                             |
| :---: | :----------------------------------------------------------: |
|   *   | 匹配前面的子表达式零次或多次。例如，**zo\*** 能匹配 **"z"** 以及 **"zoo"**。***** 等价于 **{0,}**。 |
|   +   | 匹配前面的子表达式一次或多次。例如，**zo+** 能匹配 **"zo"** 以及 "**zoo"**，但不能匹配 **"z"**。**+** 等价于 **{1,}**。 |
|   ?   | 匹配前面的子表达式零次或一次。例如，**do(es)?** 可以匹配 **"do"** 、 **"does"**、 **"doxy"** 中的 **"do"** 。**?** 等价于 **{0,1}**。 |
|  {n}  | n 是一个非负整数。匹配确定的 **n** 次。例如，**o{2}** 不能匹配 **"Bob"** 中的 **o**，但是能匹配 **"food"** 中的两个 **o**。 |
| {n,}  | n 是一个非负整数。至少匹配n 次。例如，**o{2,}** 不能匹配 **"Bob"** 中的 **o**，但能匹配 **"foooood"** 中的所有 **o**。**o{1,}** 等价于 **o+**。**o{0,}** 则等价于 **o\***。 |
| {n,m} | m 和 n 均为非负整数，其中 n <= m。最少匹配 n 次且最多匹配 m 次。例如，**o{1,3}** 将匹配 **"fooooood"** 中的前三个 **o**。**o{0,1}** 等价于 **o?**。请注意在逗号和两个数之间不能有空格。 |

如果我们想要表示一个范围内的字符，可以使用方括号：

```java
public static void main(String[] args) {
    String str = "abcabccaa";
    System.out.println(str.matches("[abc]*"));   //表示abc这几个字符可以出现 0 - N 次
}
```

对于普通字符来说，我们可以下面的方式实现多种字符匹配：

|    字符    |                             描述                             |
| :--------: | :----------------------------------------------------------: |
| **[ABC]**  | 匹配 **[...]** 中的所有字符，例如 **[aeiou]** 匹配字符串 "google runoob taobao" 中所有的 e o u a 字母。 |
| **[^ABC]** | 匹配除了 **[...]** 中字符的所有字符，例如 **[^aeiou]** 匹配字符串 "google runoob taobao" 中除了 e o u a 字母的所有字母。 |
| **[A-Z]**  | [A-Z] 表示一个区间，匹配所有大写字母，[a-z] 表示所有小写字母。 |
|   **.**    |  匹配除换行符（\n、\r）之外的任何单个字符，相等于 \[^\n\r]   |
| **[\s\S]** | 匹配所有。\s 是匹配所有空白符，包括换行，\S 非空白符，不包括换行。 |
|   **\w**   |         匹配字母、数字、下划线。等价于 [A-Za-z0-9_]          |

当然，这里仅仅是对正则表达式的简单使用，实际上正则表达式内容非常多，如果需要完整学习正则表达式，可以到：https://www.runoob.com/regexp/regexp-syntax.html

正则表达式并不是只有Java才支持，其他很多语言比如JavaScript、Python等等都是支持正则表达式的。

***

## 内部类

上一章我们详细介绍了类，我们现在已经知道该如何创建类、使用类了。当然，类的创建其实可以有多种多样的方式，并不仅仅局限于普通的创建。内部类顾名思义，就是创建在内部的类，那么具体是什么的内部呢，我们接着就来讨论一下。

**注意：**内部类很多地方都很绕，所以说一定要仔细思考。

### 成员内部类

我们可以直接在类的内部定义成员内部类：

```java
public class Test {
    public class Inner {   //内部类也是类，所以说里面也可以有成员变量、方法等，甚至还可以继续套娃一个成员内部类
        public void test(){
            System.out.println("我是成员内部类！");
        }
    }
}
```

成员内部类和成员方法、成员变量一样，是对象所有的，而不是类所有的，如果我们要使用成员内部类，那么就需要：

```java
public static void main(String[] args) {
    Test test = new Test();   //我们首先需要创建对象
    Test.Inner inner = test.new Inner();   //成员内部类的类型名称就是 外层.内部类名称
}
```

虽然看着很奇怪，但是确实是这样使用的。我们同样可以使用成员内部类中的方法：

```java
public static void main(String[] args) {
    Test test = new Test();
    Test.Inner inner = test.new Inner();
    inner.test();
}
```

注意，成员内部类也可以使用访问权限控制，如果我们我们将其权限改为`private`，那么就像我们把成员变量访问权限变成私有一样，外部是无法访问到这个内部类的：

![image-20220924122217070](https://s2.loli.net/2022/09/24/HklipN4uOfK9JrG.png)

可以看到这里直接不认识了。

这里我们需要特别注意一下，在成员内部类中，是可以访问到外层的变量的：

```java
public class Test {
    private final String name;
    
    public Test(String name){
        this.name = name;
    }
    public class Inner {
        public void test(){
            System.out.println("我是成员内部类："+name);
         		//成员内部类可以访问到外部的成员变量
          	//因为成员内部类本身就是某个对象所有的，每个对象都有这样的一个类定义，这里的name是其所依附对象的
        }
    }
}
```

![image-20220924123600217](https://s2.loli.net/2022/09/24/aQPow8piljRCs2d.png)

每个类可以创建一个对象，每个对象中都有一个单独的类定义，可以通过这个成员内部类又创建出更多对象，套娃了属于是。

所以说我们在使用时：

```java
public static void main(String[] args) {
    Test a = new Test("小明");
    Test.Inner inner1 = a.new Inner();   //依附于a创建的对象，那么就是a的
    inner1.test();

    Test b = new Test("小红");
    Test.Inner inner2 = b.new Inner();  //依附于b创建的对象，那么就是b的
    inner2.test();
}
```

那现在问大家一个问题，外部能访问内部类里面的成员变量吗？

那么如果内部类中也定义了同名的变量，此时我们怎么去明确要使用的是哪一个呢？

```java
public class Test {
    private final String name;

    public Test(String name){
        this.name = name;
    }
    public class Inner {

        String name;
        public void test(String name){
            System.out.println("方法参数的name = "+name);    //依然是就近原则，最近的是参数，那就是参数了
            System.out.println("成员内部类的name = "+this.name);   //在内部类中使用this关键字，只能表示内部类对象
            System.out.println("成员内部类的name = "+Test.this.name);
          	//如果需要指定为外部的对象，那么需要在前面添加外部类型名称
        }
    }
}
```

包括对方法的调用和super关键字的使用，也是一样的：

```java
public class Inner {

    String name;
    public void test(String name){
        this.toString();		//内部类自己的toString方法
        super.toString();    //内部类父类的toString方法
        Test.this.toString();   //外部类的toSrting方法
        Test.super.toString();  //外部类父类的toString方法
    }
}
```

所以说成员内部类其实在某些情况下使用起来比较麻烦，对于这种成员内部类，我们一般只会在类的内部自己使用。

### 静态内部类

前面我们介绍了成员内部类，它就像成员变量和成员方法一样，是属于对象的，同样的，静态内部类就像静态方法和静态变量一样，是属于类的，我们可以直接创建使用。

```java
public class Test {
    private final String name;

    public Test(String name){
        this.name = name;
    }

    public static class Inner {
        public void test(){
            System.out.println("我是静态内部类！");
        }
    }
}
```

不需要依附任何对象，我们可以直接创建静态内部类的对象：

```java
public static void main(String[] args) {
    Test.Inner inner = new Test.Inner();   //静态内部类的类名同样是之前的格式，但是可以直接new了
  	inner.test();
}
```

静态内部类由于是静态的，所以相对外部来说，整个内部类中都处于静态上下文（注意只是相当于外部来说）是无法访问到外部类的非静态内容的：

![image-20220924124919135](https://s2.loli.net/2022/09/24/cZapwgeATlG2FHn.png)

只不过受影响的只是外部内容的使用，内部倒是不受影响，还是跟普通的类一样：

```java
public static class Inner {

    String name;
    public void test(){
        System.out.println("我是静态内部类："+name);
    }
}
```

其实也很容易想通，因为静态内部类是属于外部类的，不依附任何对象，那么我要是直接访问外部类的非静态属性，那到底访问哪个对象的呢？这样肯定是说不通的。

### 局部内部类

局部内部类就像局部变量一样，可以在方法中定义。

```java
public class Test {
    private final String name;

    public Test(String name){
        this.name = name;
    }

    public void hello(){
        class Inner {    //直接在方法中创建局部内部类
            
        }
    }
}
```

既然是在方法中声明的类，那作用范围也就只能在方法中了：

```java
public class Test {
    public void hello(){
        class Inner{   //局部内部类跟局部变量一样，先声明后使用
            public void test(){
                System.out.println("我是局部内部类");
            }
        }
        
        Inner inner = new Inner();   //局部内部类直接使用类名就行
        inner.test();
    }
}
```

只不过这种局部内部类的形式，使用频率很低，基本上不会用到，所以说了解就行了。

### 匿名内部类

匿名内部类是我们使用频率非常高的一种内部类，它是局部内部类的简化版。

还记得我们在之前学习的抽象类和接口吗？在抽象类和接口中都会含有某些抽象方法需要子类去实现，我们当时已经很明确地说了不能直接通过new的方式去创建一个抽象类或是接口对象，但是我们可以使用匿名内部类。

```java
public abstract class Student {
    public abstract void test();
}
```

正常情况下，要创建一个抽象类的实例对象，只能对其进行继承，先实现未实现的方法，然后创建子类对象。

而我们可以在方法中使用匿名内部类，将其中的抽象方法实现，并直接创建实例对象：

```java
public static void main(String[] args) {
    Student student = new Student() {   //在new的时候，后面加上花括号，把未实现的方法实现了
        @Override
        public void test() {
            System.out.println("我是匿名内部类的实现!");
        }
    };
    student.test();
}
```

此时这里创建出来的Student对象，就是一个已经实现了抽象方法的对象，这个抽象类直接就定义好了，甚至连名字都没有，就可以直接就创出对象。

匿名内部类中同样可以使用类中的属性（因为它本质上就相当于是对应类型的子类）所以说：

```java
Student student = new Student() {
    int a;   //因为本质上就相当于是子类，所以说子类定义一些子类的属性完全没问题
    
    @Override
    public void test() {
        System.out.println(name + "我是匿名内部类的实现!");   //直接使用父类中的name变量
    }
};
```

同样的，接口也可以通过这种匿名内部类的形式，直接创建一个匿名的接口实现类：

```java
public static void main(String[] args) {
    Study study = new Study() {
        @Override
        public void study() {
            System.out.println("我是学习方法！");
        }
    };
    study.study();
}
```

当然，并不是说只有抽象类和接口才可以像这样创建匿名内部类，普通的类也可以，只不过意义不大，一般情况下只是为了进行一些额外的初始化工作而已。

### Lambda表达式

前面我们介绍了匿名内部类，我们可以通过这种方式创建一个临时的实现子类。

特别的，**如果一个接口中有且只有一个待实现的抽象方法**，那么我们可以将匿名内部类简写为Lambda表达式：

```java
public static void main(String[] args) {
    Study study = () -> System.out.println("我是学习方法！");   //是不是感觉非常简洁！
  	study.study();
}
```

在初学阶段，为了简化学习，各位小伙伴就认为Lambda表达式就是匿名内部类的简写就行了（Lambda表达式的底层其实并不只是简简单单的语法糖替换，感兴趣的可以在新特性篇视频教程中了解）

那么它是一个怎么样的简写规则呢？我们来看一下Lambda表达式的具体规范：

- 标准格式为：`([参数类型 参数名称,]...) ‐> { 代码语句，包括返回值 }`
- 和匿名内部类不同，Lambda仅支持接口，不支持抽象类
- 接口内部必须有且仅有一个抽象方法（可以有多个方法，但是必须保证其他方法有默认实现，必须留一个抽象方法出来）

比如我们之前写的Study接口，只要求实现一个无参无返回值的方法，所以说直接就是最简单的形式：

```java
() -> System.out.println("我是学习方法！");   //跟之前流程控制一样，如果只有一行代码花括号可省略
```

当然，如果有一个参数和返回值的话：

```java
public static void main(String[] args) {
    Study study = (a) -> {
        System.out.println("我是学习方法");
        return "今天学会了"+a;    //实际上这里面就是方法体，该咋写咋写
    };
    System.out.println(study.study(10));
}
```

注意，如果方法体中只有一个返回语句，可以直接省去花括号和`return`关键字：

```java
Study study = (a) -> {
    return "今天学会了"+a;   //这种情况是可以简化的
};
```

```java
Study study = (a) -> "今天学会了"+a;
```

如果参数只有一个，那么可以省去小括号：

```java
Study study = a -> "今天学会了"+a;
```

是不是感觉特别简洁，实际上我们程序员追求的就是写出简洁高效的代码，而Java也在朝这个方向一直努力，近年来从Java 9开始出现的一些新语法基本都是各种各样的简写版本。

如果一个方法的参数需要的是一个接口的实现：

```java
public static void main(String[] args) {
    test(a -> "今天学会了"+a);   //参数直接写成lambda表达式
}

private static void test(Study study){
    study.study(10);
}
```

当然，这还只是一部分，对于已经实现的方法，如果我们想直接作为接口抽象方法的实现，我们还可以使用方法引用。

### 方法引用

方法引用就是将一个已实现的方法，直接作为接口中抽象方法的实现（当然前提是方法定义得一样才行）

```java
public interface Study {
    int sum(int a, int b);   //待实现的求和方法
}
```

那么使用时候，可以直接使用Lambda表达式：

```java
public static void main(String[] args) {
    Study study = (a, b) -> a + b;
}
```

只不过还能更简单，因为Integer类中默认提供了求两个int值之和的方法：

```java
//Integer类中就已经有对应的实现了
public static int sum(int a, int b) {
    return a + b;
}
```

此时，我们可以直接将已有方法的实现作为接口的实现：

```java
public static void main(String[] args) {
    Study study = (a, b) -> Integer.sum(a, b);   //直接使用Integer为我们通过好的求和方法
    System.out.println(study.sum(10, 20));
}
```

我们发现，Integer.sum的参数和返回值，跟我们在Study中定义的完全一样，所以说我们可以直接使用方法引用：

```java
public static void main(String[] args) {
    Study study = Integer::sum;    //使用双冒号来进行方法引用，静态方法使用 类名::方法名 的形式
    System.out.println(study.sum(10, 20));
}
```

方法引用其实本质上就相当于将其他方法的实现，直接作为接口中抽象方法的实现。任何方法都可以通过方法引用作为实现：

```java
public interface Study {
    String study();
}
```

如果是普通从成员方法，我们同样需要使用对象来进行方法引用：

```java
public static void main(String[] args) {
    Main main = new Main();
    Study study = main::lbwnb;   //成员方法因为需要具体对象使用，所以说只能使用 对象::方法名 的形式
}

public String lbwnb(){
    return "卡布奇诺今犹在，不见当年倒茶人。";
}
```

因为现在只需要一个String类型的返回值，由于String的构造方法在创建对象时也会得到一个String类型的结果，所以说：

```java
public static void main(String[] args) {
    Study study = String::new;    //没错，构造方法也可以被引用，使用new表示
}
```

反正只要是符合接口中方法的定义的，都可以直接进行方法引用，对于Lambda表达式和方法引用，在Java新特性介绍篇视频教程中还有详细的讲解，这里就不多说了。

***

## 异常机制

在理想的情况下，我们的程序会按照我们的思路去运行，按理说是不会出现问题的，但是，代码实际编写后并不一定是完美的，可能会有我们没有考虑到的情况，如果这些情况能够正常得到一个错误的结果还好，但是如果直接导致程序运行出现问题了呢？

```java
public static void main(String[] args) {
    test(1, 0);   //当b为0的时候，还能正常运行吗？
}

private static int test(int a, int b){
    return a/b;   //没有任何的判断而是直接做计算
}
```

此时我们可以看到，出现了运算异常：

![image-20220924164357033](https://s2.loli.net/2022/09/24/5PxTJv7M2YFzfg4.png)

那么这个异常到底是什么样的一种存在呢？当程序运行出现我们没有考虑到的情况时，就有可能出现异常或是错误！

### 异常的类型

我们在之前其实已经接触过一些异常了，比如数组越界异常，空指针异常，算术异常等，他们其实都是异常类型，我们的每一个异常也是一个类，他们都继承自`Exception`类！异常类型本质依然类的对象，但是异常类型支持在程序运行出现问题时抛出（也就是上面出现的红色报错）也可以提前声明，告知使用者需要处理可能会出现的异常！

异常的第一种类型是运行时异常，如上述的列子，在编译阶段无法感知代码是否会出现问题，只有在运行的时候才知道会不会出错（正常情况下是不会出错的），这样的异常称为运行时异常，异常也是由类定义的，所有的运行时异常都继承自`RuntimeException`。

```java
public static void main(String[] args) {
    Object object = null;
    object.toString();   //这种情况就会出现运行时异常
}
```

![image-20220924164637887](https://s2.loli.net/2022/09/24/cTAqbZ93HidRIGW.png)

又比如下面的这种情况：

```java
public static void main(String[] args) {
    Object object = new Object();
    Main main = (Main) object;
}
```

![image-20220924164844005](https://s2.loli.net/2022/09/24/QxMimbjZk19C25d.png)

异常的另一种类型是编译时异常，编译时异常明确指出可能会出现的异常，在编译阶段就需要进行处理（捕获异常）必须要考虑到出现异常的情况，如果不进行处理，将无法通过编译！默认继承自`Exception`类的异常都是编译时异常。

```java
protected native Object clone() throws CloneNotSupportedException;
```

比如Object类中定义的`clone`方法，就明确指出了在运行的时候会出现的异常。

还有一种类型是错误，错误比异常更严重，异常就是不同寻常，但不一定会导致致命的问题，而错误是致命问题，一般出现错误可能JVM就无法继续正常运行了，比如`OutOfMemoryError`就是内存溢出错误（内存占用已经超出限制，无法继续申请内存了）

```java
public static void main(String[] args) {
    test();
}

private static void test(){
    test();
}
```

比如这样的一个无限递归的方法，会导致运行过程中无限制地向下调用方法，导致栈溢出：

![image-20220924165500108](https://s2.loli.net/2022/09/24/9YEZV2L73ROQTuA.png)

这种情况就是错误了，已经严重到整个程序都无法正常运行了。又比如：

```java
public static void main(String[] args) {
    Object[] objects = new Object[Integer.MAX_VALUE];   //这里申请一个超级大数组
}
```

实际上我们电脑的内存是有限的，不可能无限制地使用内存来存放变量，所以说如果内存不够用了，会直接：

![image-20220924165657392](https://s2.loli.net/2022/09/24/qj8zJnGxdS5IybX.png)

此时没有更多的可用内存供我们的程序使用，那么程序也就没办法继续运行下去了，这同样是一个很严重的错误。

当然，我们这一块主要讨论的目录依然是异常。

### 自定义异常

异常其实就两大类，一个是编译时异常，一个是运行时异常，我们先来看编译时异常。

```java
public class TestException extends Exception{
    public TestException(String message){
        super(message);   //这里我们选择使用父类的带参构造，这个参数就是异常的原因
    }
}
```

编译时异常只需要继承Exception就行了，编译时异常的子类有很多很多，仅仅是SE中就有700多个。

![image-20220924202450589](https://s2.loli.net/2022/09/24/TzUu5Sk6NycB9An.png)

异常多种多样，不同的异常对应着不同的情况，比如在类型转换时出错那么就是类型转换异常，如果是使用一个值为null的变量调用方法，那么就会出现空指针异常。

运行时异常只需要继承RuntimeException就行了：

```java
public class TestException extends RuntimeException{
    public TestException(String message){
        super(message);
    }
}
```

RuntimeException继承自Exception，Exception继承自Throwable：

![image-20220924203130042](https://s2.loli.net/2022/09/24/RjzWnNDc6TZeSoJ.png)

运行时异常同同样也有很多，只不过运行时异常和编译型异常在使用时有一些不同，我们会在后面的学习中慢慢认识。

当然还有一种类型是Error，它是所有错误的父类，同样是继承自Throwable的。

### 抛出异常

当别人调用我们的方法时，如果传入了错误的参数导致程序无法正常运行，这时我们就可以手动抛出一个异常来终止程序继续运行下去，同时告知上一级方法执行出现了问题：

```java
public static int test(int a, int b) {
    if(b == 0)
        throw new RuntimeException("被除数不能为0");  //使用throw关键字来抛出异常
    return a / b;
}
```

异常的抛出同样需要创建一个异常对象出来，我们抛出异常实际上就是将这个异常对象抛出，异常对象携带了我们抛出异常时的一些信息，比如是因为什么原因导致的异常，在RuntimeException的构造方法中我们可以写入原因。

当出现异常时：

![image-20220924200817314](https://s2.loli.net/2022/09/24/Ttr4kZSyodKi3M8.png)

程序会终止，并且会打印栈追踪信息，因为各位小伙伴才初学，还不知道什么是栈，我们这里就简单介绍一下，实际上方法之间的调用是有层级关系的，而当异常发生时，方法调用的每一层都会在栈追踪信息中打印出来，比如这里有两个`at`，实际上就是在告诉我们程序运行到哪个位置时出现的异常，位于最上面的就是发生异常的最核心位置，我们代码的第15行。

并且这里会打印出当前抛出的异常类型和我们刚刚自定义异常信息。

注意，如果我们在方法中抛出了一个非运行时异常，那么必须告知函数的调用方我们会抛出某个异常，函数调用方必须要对抛出的这个异常进行对应的处理才可以：

```java
private static void test() throws Exception {    //使用throws关键字告知调用方此方法会抛出哪些异常，请调用方处理好
    throw new Exception("我是编译时异常！");
}
```

注意，如果不同的分支条件会出现不同的异常，那么所有在方法中可能会抛出的异常都需要注明：

```java
private static void test(int a) throws FileNotFoundException, ClassNotFoundException {  //多个异常使用逗号隔开
    if(a == 1)
        throw new FileNotFoundException();
    else 
        throw new ClassNotFoundException();
}
```

当然，并不是只有非运行时异常可以像这样明确指出，运行时异常也可以，只不过不强制要求：

```java
private static void test(int a) throws RuntimeException {
    throw new RuntimeException();
}
```

至于如何处理明确抛出的异常，我们会下一个部分中进行讲解。

最后再提一下，我们在重写方法时，如果父类中的方法表明了会抛出某个异常，只要重写的内容中不会抛出对应的异常我们可以直接省去：

```java
@Override
protected Object clone() {
    return new Object();
}
```

### 异常的处理

当程序没有按照我们理想的样子运行而出现异常时（默认会交给JVM来处理，JVM发现任何异常都会立即终止程序运行，并在控制台打印栈追踪信息）现在我们希望能够自己处理出现的问题，让程序继续运行下去，就需要对异常进行捕获，比如：

```java
public static void main(String[] args) {
    try {    //使用try-catch语句进行异常捕获
        Object object = null;
        object.toString();
    } catch (NullPointerException e){   //因为异常本身也是一个对象，catch中实际上就是用一个局部变量去接收异常

    }
    System.out.println("程序继续正常运行！");
}
```

我们可以将代码编写到`try`语句块中，只要是在这个范围内发生的异常，都可以被捕获，使用`catch`关键字对指定的异常进行捕获，这里我们捕获的是NullPointerException空指针异常：

![image-20220924195434572](https://s2.loli.net/2022/09/24/7Ek5A46QHNKtWoJ.png)

可以看到，当我们捕获异常之后，程序可以继续正常运行，并不会像之前一样直接结束掉。

注意，catch中捕获的类型只能是Throwable的子类，也就是说要么是抛出的异常，要么是错误，不能是其他的任何类型。

我们可以在`catch`语句块中对捕获到的异常进行处理：

```java
public static void main(String[] args) {
    try {
        Object object = null;
        object.toString();
    } catch (NullPointerException e){
        e.printStackTrace();   //打印栈追踪信息
        System.out.println("异常错误信息："+e.getMessage());   //获取异常的错误信息
    }
    System.out.println("程序继续正常运行！");
}
```

![image-20220924201405697](https://s2.loli.net/2022/09/24/d15ns6hQblU8TAS.png)

如果某个方法明确指出会抛出哪些异常，除非抛出的异常是一个运行时异常，否则我们必须要使用try-catch语句块进行异常的捕获，不然就无法通过编译：

```java
public static void main(String[] args) {
    test(10);    //必须要进行异常的捕获，否则报错
}

private static void test(int a) throws IOException {  //明确会抛出IOException
    throw new IOException();
}
```

当然，如果我们确实不想在当前这个方法中进行处理，那么我们可以继续踢皮球，抛给上一级：

```java
public static void main(String[] args) throws IOException {  //继续编写throws往上一级抛
    test(10);
}

private static void test(int a) throws IOException {
    throw new IOException();
}
```

注意，如果已经是主方法了，那么就相当于到顶层了，此时发生异常再往上抛出的话，就会直接交给JVM进行处理，默认会让整个程序终止并打印栈追踪信息。

注意，如果我们要捕获的异常，是某个异常的父类，那么当发生这个异常时，同样可以捕获到：

```java
public static void main(String[] args) throws IOException {
    try {
        int[] arr = new int[1];
        arr[1] = 100;    //这里发生的是数组越界异常，它是运行时异常的子类
    } catch (RuntimeException e){  //使用运行时异常同样可以捕获到
        System.out.println("捕获到异常");
    }
}
```

当代码可能出现多种类型的异常时，我们希望能够分不同情况处理不同类型的异常，就可以使用多重异常捕获：

```java
try {
  //....
} catch (NullPointerException e) {
            
} catch (IndexOutOfBoundsException e){

} catch (RuntimeException e){
            
}
```

但是要注意一下顺序：

```java
try {
  //....
} catch (RuntimeException e){  //父类型在前，会将子类的也捕获

} catch (NullPointerException e) {   //永远都不会被捕获

} catch (IndexOutOfBoundsException e){   //永远都不会被捕获

}
```

只不过这样写好像有点丑，我们也可以简写为：

```java
try {
     //....
} catch (NullPointerException | IndexOutOfBoundsException e) {  //用|隔开每种类型即可
		
}
```

如果简写的话，那么发生这些异常的时候，都会采用统一的方式进行处理了。

最后，当我们希望，程序运行时，无论是否出现异常，都会在最后执行任务，可以交给`finally`语句块来处理：

```java
try {
    //....
}catch (Exception e){
            
}finally {
  	System.out.println("lbwnb");   //无论是否出现异常，都会在最后执行
}
```

`try`语句块至少要配合`catch`或`finally`中的一个：

```java
try {
    int a = 10;
    a /= 0;
} finally {  //不捕获异常，程序会终止，但在最后依然会执行下面的内容
    System.out.println("lbwnb"); 
}
```

**思考：**`try`、`catch`和`finally`执行顺序？

### 断言表达式

我们可以使用断言表达式来对某些东西进行判断，如果判断失败会抛出错误，只不过默认情况下没有开启断言，我们需要在虚拟机参数中手动开启一下：

![image-20220924220327591](https://s2.loli.net/2022/09/24/cAG8kY395fOuTLg.png)

开启断言之后，我们就可以开始使用了。

断言表达式需要使用到`assert`关键字，如果assert后面的表达式判断结果为false，将抛出AssertionError错误。

```java
public static void main(String[] args) {
    assert false;
}
```

比如我们可以判断变量的值，如果大于10就抛出错误：

```java
public static void main(String[] args) {
    int a = 10;
    assert a > 10;
}
```

![image-20220924220704026](https://s2.loli.net/2022/09/24/12b6zRAL3evQ9ZB.png)

我们可以在表达式的后面添加错误信息：

```java
public static void main(String[] args) {
    int a = 10;
    assert a > 10 : "我是自定义的错误信息";
}
```

这样就会显示到错误后面了：

![image-20220924220813609](https://s2.loli.net/2022/09/24/NaYk5pFiBPLXVIr.png)

断言表达式一般只用于测试，我们正常的程序中一般不会使用，这里只做了解就行了。

***

## 常用工具类介绍

前面我们学习了包装类、数组和字符串，我们接着来看看常用的一些工具类。工具类就是专门为一些特定场景编写的，便于我们去使用的类，工具类一般都会内置大量的静态方法，我们可以通过类名直接使用。

### 数学工具类

Java提供的运算符实际上只能进行一些在小学数学中出现的运算，但是如果我们想要进行乘方、三角函数之类的高级运算，就没有对应的运算符能够做到，而此时我们就可以使用数学工具类来完成。

```java
public static void main(String[] args) {
  	//Math也是java.lang包下的类，所以说默认就可以直接使用
    System.out.println(Math.pow(5, 3));   //我们可以使用pow方法直接计算a的b次方
  
  	Math.abs(-1);    //abs方法可以求绝对值
  	Math.max(19, 20);    //快速取最大值
  	Math.min(2, 4);   //快速取最小值
  	Math.sqrt(9);    //求一个数的算术平方根
}
```

当然，三角函数肯定也是安排上了的：

```java
Math.sin(Math.PI / 2);     //求π/2的正弦值，这里我们可以使用预置的PI进行计算
Math.cos(Math.PI);       //求π的余弦值
Math.tan(Math.PI / 4);    //求π/4的正切值

Math.asin(1);     //三角函数的反函数也是有的，这里是求arcsin1的值
Math.acos(1);
Math.atan(0);
```

可能在某些情况下，计算出来的浮点数会得到一个很奇怪的结果：

```java
public static void main(String[] args) {
    System.out.println(Math.sin(Math.PI));   //计算 sinπ 的结果
}
```

![image-20220923231536032](https://s2.loli.net/2022/09/23/fZ6OVRejDXWSalC.png)

正常来说，sinπ的结果应该是0才对，为什么这里得到的是一个很奇怪的数？这个E是干嘛的，这其实是科学计数法的10，后面的数就是指数，上面的结果其实就是：

* $1.2246467991473532 \times 10^{-16}$

其实这个数是非常接近于0，这是因为精度问题导致的，所以说实际上结果就是0。

我们也可以快速计算对数函数：

```java
public static void main(String[] args) {
    Math.log(Math.E);    //e为底的对数函数，其实就是ln，我们可以直接使用Math中定义好的e
    Math.log10(100);     //10为底的对数函数
    //利用换底公式，我们可以弄出来任何我们想求的对数函数
    double a = Math.log(4) / Math.log(2);   //这里是求以2为底4的对数，log(2)4 = ln4 / ln2
    System.out.println(a);
}
```

还有一些比较特殊的计算：

```java
public static void main(String[] args) {
    Math.ceil(4.5);    //通过使用ceil来向上取整
    Math.floor(5.6);   //通过使用floor来向下取整
}
```

向上取整就是找一个大于当前数字的最小整数，向下取整就是砍掉小数部分。注意，如果是负数的话，向上取整就是去掉小数部分，向下取整就是找一个小于当前数字的最大整数。

这里我们再介绍一下随机数的生成，Java中想要生成一个随机数其实也很简单，我们需要使用Random类来生成（这个类时java.util包下的，需要手动导入才可以）

```java
public static void main(String[] args) {
    Random random = new Random();   //创建Random对象
    for (int i = 0; i < 30; i++) {
        System.out.print(random.nextInt(100)+" ");  //nextInt方法可以指定创建0 - x之内的随机数
    }
}
```

结果为，可以看到确实是一堆随机数：

![image-20220923234642670](https://s2.loli.net/2022/09/23/fM8J7zO2qHXhvst.png)

只不过，程序中的随机并不是真随机，而是根据某些东西计算出来的，只不过计算过程非常复杂，能够在一定程度上保证随机性（根据爱因斯坦理论，宏观物质世界不存在真随机，看似随机的事物只是现目前无法计算而已，唯物主义的公理之一就是任何事物都有因果关系）

### 数组工具类

前面我们介绍了数组，但是我们发现，想要操作数组实在是有点麻烦，比如我们要打印一个数组，还得一个一个元素遍历才可以，那么有没有一个比较方便的方式去使用数组呢？我们可以使用数组工具类Arrays。

这个类也是`java.util`包下类，它用于便捷操作数组，比如我们想要打印数组，可以直接通过toString方法转换字符串：

```java
public static void main(String[] args) {
    int[] arr = new int[]{1, 4, 5, 8, 2, 0, 9, 7, 3, 6};
    System.out.println(Arrays.toString(arr));
}
```

![image-20220923235747731](https://s2.loli.net/2022/09/23/fx61nKT7LjdMv5q.png)

是不是感觉非常方便？这样我们直接就可以打印数组了！

除了这个方法，它还支持将数组进行排序：

```java
public static void main(String[] args) {
    int[] arr = new int[]{1, 4, 5, 8, 2, 0, 9, 7, 3, 6};
    Arrays.sort(arr);    //可以对数组进行排序，将所有的元素按照从小到大的顺序排放
    System.out.println(Arrays.toString(arr));
}
```

感兴趣的小伙伴可以在数据结构与算法篇视频教程中了解多种多样的排序算法，这里的排序底层实现实际上用到了多种排序算法。

数组中的内容也可以快速进行填充：

```java
public static void main(String[] args) {
    int[] arr = new int[10];
    Arrays.fill(arr, 66);
    System.out.println(Arrays.toString(arr));
}
```

我们可以快速地对一个数组进行拷贝：

```java
public static void main(String[] args) {
    int[] arr = new int[]{1, 2, 3, 4, 5};
    int[] target = Arrays.copyOf(arr, 5);
    System.out.println(Arrays.toString(target));   //拷贝数组的全部内容，并生成一个新的数组对象
    System.out.println(arr == target);
}
```

```java
public static void main(String[] args) {
    int[] arr = new int[]{1, 2, 3, 4, 5};
    int[] target = Arrays.copyOfRange(arr, 3, 5);   //也可以只拷贝某个范围内的内容
    System.out.println(Arrays.toString(target));
    System.out.println(arr == target);
}
```

我们也可以将一个数组中的内容拷贝到其他数组中：

```java
public static void main(String[] args) {
    int[] arr = new int[]{1, 2, 3, 4, 5};
    int[] target = new int[10];
    System.arraycopy(arr, 0, target, 0, 5);   //使用System.arraycopy进行搬运
    System.out.println(Arrays.toString(target));
}
```

对于一个有序的数组（从小到大排列）我们可以使用二分搜索快速找到对应的元素在哪个位置：

```java
public static void main(String[] args) {
    int[] arr = new int[]{1, 2, 3, 4, 5};
    System.out.println(Arrays.binarySearch(arr, 5));   //二分搜索仅适用于有序数组
}
```

这里提到了二分搜索算法，我们会在后面的实战练习中进行讲解。

那要是现在我们使用的是多维数组呢？因为现在数组里面的每个元素就是一个数组，所以说toString会出现些问题：

```java
public static void main(String[] args) {
    int[][] array = new int[][]{{2, 8, 4, 1}, {9, 2, 0, 3}};
    System.out.println(Arrays.toString(array));
}
```

![image-20220924114142785](https://s2.loli.net/2022/09/24/L2at7HJi3BKf6jF.png)

只不过别担心，Arrays也支持对多维数组进行处理：

```java
public static void main(String[] args) {
    int[][] array = new int[][]{{2, 8, 4, 1}, {9, 2, 0, 3}};
    System.out.println(Arrays.deepToString(array));    //deepToString方法可以对多维数组进行打印
}
```

同样的，因为数组本身没有重写equals方法，所以说无法判断两个不同的数组对象中的每一个元素是否相同，Arrays也为一维数组和多维数组提供了相等判断的方法：

```java
public static void main(String[] args) {
    int[][] a = new int[][]{{2, 8, 4, 1}, {9, 2, 0, 3}};
    int[][] b = new int[][]{{2, 8, 4, 1}, {9, 2, 0, 3}};
    System.out.println(Arrays.equals(a, b));   //equals仅适用于一维数组
    System.out.println(Arrays.deepEquals(a, b));   //对于多维数组，需要使用deepEquals来进行深层次判断
}
```

这里肯定有小伙伴疑问了，不是说基本类型的数组不能转换为引用类型的数组吗？为什么这里的deepEquals接受的是`Object[]`也可以传入参数呢？这是因为现在是二维数组，二维数组每个元素都是一个数组，而数组本身的话就是一个引用类型了，所以说可以转换为Object类型，但是如果是一维数组的话，就报错：

![image-20220924115440998](https://s2.loli.net/2022/09/24/ab94eNcJPERlOYA.png)

总体来说，这个工具类对于我们数组的使用还是很方便的。

***

## 实战练习

到目前为止，关于面向对象相关的内容我们已经学习了非常多了，接着依然是练习题。

### 冒泡排序算法

有一个int数组，但是数组内的数据是打乱的，现在我们需要将数组中的数据按**从小到大**的顺序进行排列：

```java
public static void main(String[] args) {
    int[] arr = new int[]{3, 5, 7, 2, 9, 0, 6, 1, 8, 4};
}
```

请你设计一个Java程序将这个数组中的元素按照顺序排列。



### 二分搜索算法

现在有一个从小到大排序的数组，给你一个目标值`target`，现在我们想要找到这个值在数组中的对应下标，如果数组中没有这个数，请返回`-1`：

```java
public static void main(String[] args) {
    int[] arr = {1, 3, 4, 6, 7, 8, 10, 11, 13, 15};
    int target = 3;
}
```

请你设计一个Java程序实现这个功能。



### 青蛙跳台阶问题

现在一共有n个台阶，一只青蛙每次只能跳一阶或是两阶，那么一共有多少种跳到顶端的方案？

例如n=2，那么一共有两种方案，一次性跳两阶或是每次跳一阶。

现在请你设计一个Java程序，计算当台阶数为n的情况下，能够有多少种方案到达顶端。



### 回文串判断

“回文串”是一个正读和反读都一样的字符串，请你实现一个Java程序，判断用户输入的字符串（仅出现英文字符）是否为“回文”串。

>  ABCBA   就是一个回文串，因为正读反读都是一样的
>
> ABCA   就不是一个回文串，因为反着读不一样



### 汉诺塔求解

什么是汉诺塔？

> **汉诺塔**（Tower of Hanoi），又称**河内塔**，是一个源于[印度](https://baike.baidu.com/item/印度/121904)古老传说的[益智玩具](https://baike.baidu.com/item/益智玩具/223159)。[大梵天](https://baike.baidu.com/item/大梵天/711550)创造世界的时候做了三根金刚石柱子，在一根柱子上从下往上按照大小顺序摞着64片黄金圆盘。大梵天命令[婆罗门](https://baike.baidu.com/item/婆罗门/1796550)把圆盘从下面开始
>
> **按大小顺序重新摆放在另一根柱子上。并且规定，在小圆盘上不能放大圆盘，在三根柱子之间一次只能移动一个圆盘。**

![img](https://s2.loli.net/2022/09/24/mMpDNwrKk6z3CIo.png)

这三根柱子我们就依次命名为A、B、C，现在请你设计一个Java程序，计算N阶（n片圆盘）汉诺塔移动操作的每一步。
