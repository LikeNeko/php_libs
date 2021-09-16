<?php
namespace Neko\Libs\Traits;
trait NSingleton
{
    private static $instance;

    /**
     * 获得单例
     *
     * @param ...$args
     *
     * @return static
     */
    static function instance(...$args)
    {
        if(!isset(self::$instance)){
            // 这段代码的有趣之处在于这个static
            self::$instance = new static(...$args);
        }
        return self::$instance;
    }

    /**
     * 创建一个新的当前对象
     *
     * @param ...$args
     *
     * @return static
     */
    static function make(... $args){
        return new static(...$args);
    }

    /**
     * 销毁单例对象
     *
     * @return void
     */
    static function destruct(){
        self::$instance = null;
    }
}
