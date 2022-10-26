
# PHP反序列化学习
## PHP反序列化基础
### PHP类与对象
类是对象的抽象模板，包含对象所具有的属性和方法（行为），而对象是类的实例化体现。

```php
<?php
// 定义一个people类
class people {
	// 定义people类具有的属性（变量）
	public $name = "张三";

	// 定义people类具有的行为（方法）
	public function smile() {
		echo $this->name." is smile"；
	}
}

// 以people类为模板创建实例（对象）
$people_1 = new people();

// 访问对象的成员方法
$people_1->smile();
```

### PHP魔术方法
魔术方法是指：在触发某个事件之前/之后会自动执行而不必手动调用的函数。（普通函数必须手动调用才能执行）

PHP中的魔术方法全部以双下划线开头：
```
1. __construct：构造函数，在创建对象时初始化对象
2. __destruct：析构函数，与构造函数相反，用于销毁对象
3. __toString：将对象转成字符串返回
4. __wakeup：
```







