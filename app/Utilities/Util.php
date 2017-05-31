<?php

namespace App\Utilities;


class Util
{
    /*
     * 生成四个随机字符串的盐
     */
    public static function generateSalt()
    {
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789';

        $length = strlen($string) - 1;

        $salt = '';

        for ($i = 0; $i < 4; $i++) {
            $start = mt_rand(0, $length);

            $char = substr($string, $start, 1);

            $salt .= $char;
        }

        return $salt;
    }

}

?>