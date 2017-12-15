<?php

namespace gophp;

class validate
{

    // 验证是否是合法邮箱
    public static function isEmail($email)
    {

        return filter_var($email, FILTER_VALIDATE_EMAIL);

    }

    // 验证是否是合法网址
    public static function isUrl($url)
    {

        return preg_match(

            '/^http[s]?:\/\/'.
            '(([0-9]{1,3}\.){3}[0-9]{1,3}'. // IP形式的URL- 199.194.52.184
            '|'. // 允许IP和DOMAIN（域名）
            '([0-9a-z_!~*\'()-]+\.)*'. // 三级域验证- www.
            '([0-9a-z][0-9a-z-]{0,61})?[0-9a-z]\.'. // 二级域验证
            '[a-z]{2,6})'.  // 顶级域验证.com or .museum
            '(:[0-9]{1,4})?'.  // 端口- :80
            '((\/\?)|'.  // 如果含有文件对文件部分进行校验
            '(\/[0-9a-zA-Z_!~\*\'\(\)\.;\?:@&=\+\$,%#-\/]*)?)$/', $url
            ) == 1;

    }

    // 验证是否是合法手机号
    public static function isPhone($phone)
    {

        return preg_match('/^1[34578]{1}\d{9}$/', trim($phone));

    }

    // 验证是否是合法ip
    public static function isIP($ip, $version = null)
    {

        switch ($version) {

            case '4':

                $filterFlag = FILTER_FLAG_IPV4;

                break;

            case '6':

                $filterFlag = FILTER_FLAG_IPV6;

                break;

            default:

                $filterFlag = '';

                break;

        }

        return filter_var($ip, FILTER_VALIDATE_IP, $filterFlag);

    }

    // 验证是否是合法数字
    public static function isNumber($number)
    {

        return preg_match('/^-?[1-9]\d*$/', trim($number));

    }

    // 验证是否包含合法数字
    public static function hasNumber($number)
    {

        return preg_match('/-?[1-9]\d*/', trim($number));

    }

    // 验证是否是合法价格
    public static function isPrice($price, $precise = 2)
    {

        if($precise){

            return preg_match('/^\d+(\.\d{' . $precise . '})?$/', trim($price));

        }else{

            return preg_match('/^\d+(\.\d)?$/', trim($price));

        }

    }

    // 验证是否是纯英文字母
    public static function isEnglish($string)
    {

        return preg_match('/^[A-Za-z]+$/', trim($string));

    }

    // 验证是否包含英文字母
    public static function hasEnglish($string)
    {

        return preg_match('/[A-Za-z]/', trim($string));

    }

    // 验证是否是纯中文
    public static function isChinese($string)
    {

        return preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', trim($string));

    }

    // 验证是否包含中文
    public static function hasChinese($string)
    {

        return preg_match('/[\x{4e00}-\x{9fa5}]/u', trim($string));

    }

    // 验证是否是合法日期
    public static function isDate($date, $formats = ['Y-m-d', 'Y/m/d'])
    {

        $unixTime = strtotime($date);
        
        if (!$unixTime) {

            return false;

        }

        foreach ($formats as $format) {

            if (date($format, $unixTime) == $date) {

                return true;

            }

        }

        return false;

    }

    // 验证是否是合法json
    public static function isJson($string) {

         json_decode($string);

         return (json_last_error() == JSON_ERROR_NONE);

    }


}
