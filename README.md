```php
// 返回一个绝对大于等于0的数
var_dump(math_gtz(-1)); // Math::GTZ(-1);
// int(0)

// curl的请求封装助手方法
$info = c_get('https://baidu.com/',['info'=>'id\*@ $#!*&>.','num'=>3,'va'=>132.2222222],300);
$info = c_post('https://baidu.com/',['info'=>'id\*@ $#!*&>.','num'=>3,'va'=>132.2222222],300);

// 请求失败重试3次 300ms超时
$obj = new \Neko\Libs\CUrl(3);
$info = $obj->get('https://baidu.com/',['info'=>'id\*@ $#!*&>.','num'=>3,'va'=>132.2222222],300);
// string(75) "https://baidu.com/?info=id%5C%2A%40+%24%23%21%2A%26%3E.&num=3&va=132.2222222"

// 请求失败重试3次 300ms超时
$obj = new \Neko\Libs\CUrl(3);
$info = $obj->get('https://baidu.com/?api=aaaa',['info'=>'id\*@ $#!*&>.','num'=>3,'va'=>132.2222222],300);
// string(84) "https://baidu.com/?api=aaaa&info=id%5C%2A%40+%24%23%21%2A%26%3E.&num=3&va=132.2222222"


// 单例
class A{
    use \Neko\Libs\NSingleton;
    public function __construct($a,$b,$c)
    {
        var_dump($a,$b,$c);
    }
}
A::getInstance(1,2,3);


```