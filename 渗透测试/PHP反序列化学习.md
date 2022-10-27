# PHP反序列化的理解
**1、PHP序列化**
序列化是指将php对象转换成便于存储和传输的字符串序列，在这个过程中，只有php对象的属性值（成员变量）会被序列化，而方法（函数）不会被序列化。

**2、PHP反序列化**
反序列化是将序列化之后的字符串还原成对象的过程，对象的属性值会被保留。

序列化与反序列化的实例：
```php
<?php
// 定义一个Ctfer类
class Ctfer {
    // 设置成员变量（属性值）
    public $name = 'kali';
    public $age = '19';
    public $flag = 'flag{this is a flag}';
}

// 创建Ctfer对象
$kali = new Ctfer();

// 将对象序列化
$data = serialize($kali);

// 反序列化将对象的属性还原
$result = unserialize($data);
```

序列化的结果分析：
O:5:"Ctfer":3:{s:4:"name";s:4:"kali";s:3:"age";s:2:"19";s:4:"flag";s:20:"flag{this is a flag}";}

O：表示这串字符串代表一个对象
5：表示对象所属类的名称长度（Ctfer共5个字符）
“Ctfer”：表示对象所属类的名称
3：表示该对象中的属性个数（name、age、flag）

大括号内的内容格式：
变量类型:变量长度:变量值;

反序列化结果：
object(Ctfer)#2 (3) {
    ["name"]=>
    string(4) "kali"
    ["age"]=>
    string(2) "19"
    ["flag"]=>
    string(20) "flag{this is a flag}"
}

# 魔术方法
对反序列化过程进行利用时，会调用PHP的一些魔术方法：
```php
1. __construct()    // 构造函数，创建对象时调用
2. __destruct()     // 析构函数，销毁对象时调用
3. __call()         // 在对象中调用不可访问的方法时调用
4. __get()          // 用于从不可访问的属性中读取数据
5. __set()          // 用于将数据写入不可访问的属性中
6. __isset()        // 在不可访问的属性上调用isset()或empty()时触发
7. __unset()        // 在不可访问的属性上调用unset()时触发
8. __invoke()       //当脚本尝试将对象作为函数调用时触发
......
```
**重要的魔术方法**

**__sleep()**
在进行序列化时，serialize()函数会检查对象中是否有__sleep()方法，如果存在，会先调用这个方法，该方法以数组的形式返回需要被序列化存储的属性，没有被返回的属性则不会被序列化存储。若不存在，则默认序列化存储所有成员属性。

**__wakeup()**
在进行反序列化时，unserialize()函数会检查是否存在__wakeup()方法，若存在，会先调用这个方法，预先准备对象所需的资源，一般用于重建数据库链接等。

**__toString()**
__toString()方法设置了当一个对象被当做字符串时应当如何处理，切该方法必须返回一个字符串，否则报错。

# 反序列化漏洞
当unserialize()函数的参数可控时，就形成了反序列化漏洞。所谓的反序列化漏洞利用，就是通过构造unserialize()函数的参数，使得反序列化过程中，执行我们想要的操作。

**漏洞实例**
绕过__wakeup()方法：
```php
<?php 
class SoFun{ 
  protected $file='index.php';
  function __destruct(){ 
    if(!empty($this->file)) {
      if(strchr($this-> file,"\\")===false &&  strchr($this->file, '/')===false)
        show_source(dirname (__FILE__).'/'.$this ->file);
      else
        die('Wrong filename.');
    }
  }  
  function __wakeup(){
   $this-> file='index.php';
  } 
  public function __toString()
    return '' ;
  }
}     
if (!isset($_GET['file'])){ 
  show_source('index.php');
}
else{ 
  $file=base64_decode($_GET['file']); 
  echo unserialize($file); 
}
 ?> #<!--key in flag.php-->
```

代码分析：