<?php
//flag is in flag.php   --> 构造pop链读取flag.php文件
error_reporting(0);
class Read {
    public $var;
    public function file_get($value)
    {
        $text = base64_encode(file_get_contents($value));   // file_get_contents()函数可以读取文件
        return $text;
    }
    public function __invoke(){
        $content = $this->file_get($this->var);
        echo $content;
    }
}

class Show
{
    public $source;
    public $str;
    public function __construct($file='index.php')
    {
        $this->source = $file;
        echo $this->source.'Welcome'."<br>";
    }
    public function __toString()    // 将当前类的对象当作字符串时，就会调用__toString()函数
    {
        // 这里将寻找当前对象的str数组，并取出str数组中key值为str的元素指向的source
        // 若这个key值不存在，即不可访问，就会触发__get()魔术方法
        return $this->str['str']->source;
    }

    public function _show()
    {
        if(preg_match('/gopher|http|ftp|https|dict|\.\.|flag|file/i',$this->source)) 		 {
            die('hacker');
        } else {
            highlight_file($this->source);    // highlight_file()可以读取文件
        }
    }

    public function __wakeup()    // 反序列化时最先调用的魔术方法
    {
        // 这里进行正则匹配时，会将给定的变量当作字符串，如果这时的变量是某个类的对象，就会调用该类的__toString()函数
        if(preg_match("/gopher|http|file|ftp|https|dict|\.\./i", $this->source)) {
            echo "hacker";
            $this->source = "index.php";
        }
    }
}

class Test
{
    public $p;
    public function __construct()
    {
        $this->p = array();
    }

    // 若Show类中的__toString()函数返回的str数组里key值为str的值指向的source是一个Test类的对象，那么就会触发这里的__get()魔术方法
    public function __get($key)
    {
        $function = $this->p;
        return $function();
    }
}

if(isset($_GET['hello']))
{
    unserialize($_GET['hello']);    // unserialize()执行的同时会先调用__wakeup()函数 --> 在Show类中
}
else
{
    $show = new Show('pop3.php');
    $show->_show();
}
