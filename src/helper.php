<?php
if (!function_exists('math_gtz')){
    /**
     * 返回一个绝对大于0的数小于0返回0
     *
     * @param $value
     *
     * @return float|int|string
     */
    function math_gtz($value){
        return \Neko\Libs\Math::GTZ($value);
    }
}