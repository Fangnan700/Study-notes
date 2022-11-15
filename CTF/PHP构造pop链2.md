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

1. 获取GET请求参数 'code'，并将code反序列化
2. 反序列化时最先触发__wakeup函数，在Moon类中有这一函数。
3. 在__wakeup函数中，