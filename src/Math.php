<?php
namespace Neko\Libs;

class Math{
    /**
     * 生成一个随机价格 单位为元
     *
     * @param int $price_start
     * @param int $price_end
     *
     * @return string
     */
    public static function randMoney($price_start = 1, $price_end = 2)
    {
        //领取红包 1毛-1.5毛
        $price_start *= 100;
        $price_end   *= 100;
        $hb_money    = mt_rand($price_start, $price_end);
        // 红包金额
        $credit2_zg = floatTwo($hb_money / 100);
        return $credit2_zg;
    }

    /**
     * 生成一个唯一id
     * @return string
     */
    public static function orderId()
    {
        $year_code = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'];

        $order_sn = $year_code[intval(date('Y')) - 2018] .
            strtoupper(dechex(date('m'))) . date('d') .
            substr(time(), -5) . substr(microtime(), 2, 5) .
            sprintf('%02d', rand(0, 99));
        return "N" . $order_sn;
    }

    /**
     * 返回一个绝对大于0的数小于0返回0
     *
     * @param $value
     *
     * @return numeric
     */
    public static function GTZ($value)
    {
        if ($value>0){
            return $value;
        }else{
            return 0;
        }
    }
}