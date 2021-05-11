<?php
if (!function_exists('math_gtz')) {
    /**
     * 返回一个绝对大于0的数小于0返回0
     *
     * @param $value
     *
     * @return float|int|string
     */
    function math_gtz($value)
    {
        return \Neko\Libs\Math::GTZ($value);
    }
}

if (!function_exists('c_get')) {
    /**
     * GET方式的请求
     * ```
     * 例子
     * c_get('https://baidu.com/',['info'=>'id\*@ $#!*&>.','num'=>3,'va'=>132.2222222],300);
     * ```
     *
     * @param string $url       请求的链接
     * @param array  $data      get参数
     * @param int    $timeout   超时设置，单位：毫秒
     * @param int    $retry_num 重试次数
     *
     * @return string  接口返回的内容，超时返回false
     */
    function c_get($url, $data = [], $timeout = 3000, $retry_num = 3)
    {
        // 请求失败重试3次 300ms超时
        $obj = new \Neko\Libs\CUrl($retry_num);
        return $obj->get($url, $data, 300);
    }
}
if (!function_exists('c_post')) {
    /**
     * Post方式的请求
     * ```
     * 例子
     * c_post('https://baidu.com/',['info'=>'id\*@ $#!*&>.','num'=>3,'va'=>132.2222222],300);
     * ```
     * @param string $url       请求的链接
     * @param array  $data      参数
     * @param int    $timeout   超时设置，单位：毫秒
     * @param int    $retry_num 重试次数
     *
     * @return string  接口返回的内容，超时返回false
     */
    function c_post($url, $data = [], $timeout = 3000, $retry_num = 3)
    {
        // 请求失败重试3次 300ms超时
        $obj = new \Neko\Libs\CUrl($retry_num);
        return $obj->post($url, $data, 300);
    }
}
if (!function_exists('ndi')) {
    /**
     * 返回di容器类
     *
     * @return \Neko\Libs\DependenceInjection
     */
    function ndi()
    {
        return \Neko\Libs\DependenceInjection::one();
    }
}

if (!function_exists('time_format')){
    /**
     * 将时间转换为指定格式
     *
     * @param string $time 时间日期如: 2021-03-14T16:00:00.000+0000
     * @param string $format 格式
     *
     * @return string
     */
    function time_format($time, $format='Y-m-d'){
        $date = new DateTime($time);
        return $date->format($format);
    }
}
if (!function_exists('multi_array_sort')){
    /**
     * 二维数组以key排序
     *
     * @param     $multi_array 待排序的数组
     * @param     $sort_key key
     * @param int $sort 排序类型
     *
     * @return array|false
     */
    function multi_array_sort($multi_array,$sort_key,$sort=SORT_ASC){
        if(is_array($multi_array)){
            foreach ($multi_array as $row_array){
                if(is_array($row_array)){
                    $key_array[] = $row_array[$sort_key];
                }else{
                    return false;
                }
            }
        }else{
            return false;
        }
        array_multisort($key_array,$sort,$multi_array);
        return $multi_array;
    }
}
