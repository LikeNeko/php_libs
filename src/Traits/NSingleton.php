<?php
namespace Neko\Libs\Traits;
trait NSingleton
{
    private static $instance;

    /**
     * 获得单例
     *
     * @param mixed ...$args
     *
     */
    static function getInstance(...$args)
    {
        if(!isset(self::$instance)){
            // 这段代码的有趣之处在于这个static
            self::$instance = new static(...$args);
        }
        return self::$instance;
    }

    static function destruct(){
        self::$instance = null;
    }
}
