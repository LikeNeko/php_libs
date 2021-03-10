<?php
namespace PhalApi;


/**
 * 工具集合类
 */
class Tool {

    /**
     * IP地址获取
     * @return string 如：192.168.1.1 失败的情况下，返回空
     */
    public static function getClientIp() {
        $unknown = 'unknown';

        if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)) {
            $ip = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)) {
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)) {
            $ip = getenv('REMOTE_ADDR');
        } else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = '';
        }

        return $ip;
    }

    /**
     * 随机字符串生成
     *
     * @param int    $len 需要随机的长度，不要太长
     * @param string $chars 随机生成字符串的范围
     *
     * @return string
     */
    public static function createRandStr($len, $chars = null) {
        if (!$chars) {
            $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        
        return substr(str_shuffle(str_repeat($chars, rand(5, 8))), 0, $len);
    }

    /**
     * 获取数组value值不存在时返回默认值
     * 不建议在大循环中使用会有效率问题
     *
     * @param array      $arr     数组实例
     * @param string|int $key     数据key值
     * @param string     $default 默认值
     *
     * @return string
     */
    public static function arrIndex($arr, $key, $default = '') {

        return isset($arr[$key]) ? $arr[$key] : $default;
    }


    /**
     * 排除数组中不需要的键
     * @param array $array 待处理的数组，可以是一维数组或二维数组
     * @param string|array $excludeKeys 待排除的键，字符串时使用英文逗号分割
     * @return array 排除key后的新数组
     */
    public static function arrayExcludeKeys($array, $excludeKeys) {
        if (!is_array($array)) {
            return $array;
        }

        $excludeKeys = is_array($excludeKeys) ? $excludeKeys : explode(',', $excludeKeys);
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                foreach ($array[$key] as $subKey => $subValue) {
                    if (in_array($subKey, $excludeKeys, TRUE)) {
                        unset($array[$key][$subKey]);
                    }
                }
            } else if (in_array($key, $excludeKeys, TRUE)) {
                unset($array[$key]);
            }
        }

        return $array;
    }

    /**
     * 数组转XML格式
     * 
     * @param array $arr 数组
     * @param string $root 根节点名称
     * @param int $num 回调次数
     * 
     * @return string xml
     */
    public static function arrayToXml($arr, $root='xml', $num=0){
        $xml = '';
        if(!$num){
            $num += 1;
            $xml .= '<?xml version="1.0" encoding="utf-8"?>';
        }
        $xml .= "<$root>";
        foreach ($arr as $key=>$val){
            if(is_array($val) || is_object($val)){
                $xml.=self::arrayToXml($val,"$key",$num);
            } else {
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml .="</$root>";
        return $xml;
    }
    /**
     * XML格式转数组
     *
     * @param  string $xml
     *
     * @return mixed|array
     */
    public static function xmlToArray($xml){
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
        $arr = json_decode(json_encode($xmlstring),true);
        return $arr;
    }

    /**
     * 去除字符串空格和回车
     *
     * @param  string $str 待处理字符串
     *
     * @return string
     */
    public static function trimSpaceInStr($str)
    {
        $pat = array(" ", "　", "\t", "\n", "\r");
        $string = array("", "", "", "", "", );
        return str_replace($pat, $string, $str);
    }
}
