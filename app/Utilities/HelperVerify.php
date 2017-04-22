<?php

namespace App\Utilities;


class HelperVerify
{
    /*
    * 加密 $array中务必包含 helperkey
    */
    public static function sign($array)
    {
        ksort($array);
        $string = "";
        while (list($key, $val) = each($array)) {
            $string = $string . $key . '=' . $val . '&';
        }
        $string = substr($string, 0, strlen($string) - 1);

        return base64_encode($string);
    }

    /*
     * 验证
     */
    public static function signVerify($helperkey, $array)
    {
        $newarray = array();
        $newarray["helperkey"] = $helperkey;
        reset($array);
        while (list($key, $val) = each($array)) {
            if ($key != "sign") {
                $newarray[$key] = $val;
            }
        }
        $sign = self::sign($newarray);
        if ($sign == $array["sign"]) {
            return true;
        }

        return false;
    }


}