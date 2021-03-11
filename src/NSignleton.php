<?php
namespace Neko\Libs;
trait NSingleton
{
    private static $instance;

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