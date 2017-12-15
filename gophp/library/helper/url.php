<?php

namespace gophp\helper;

class url
{

    // 获取URL路径
    public static function getPath($url)
    {

        return parse_url($url, PHP_URL_PATH);

    }

    // 获取URL服务协议
    public static function getScheme($url)
    {

        $scheme = parse_url($url, PHP_URL_SCHEME);

        if($scheme){

            return parse_url($url, PHP_URL_SCHEME);

        }

        return 'http';

    }

    // 获取URL主机
    public static function getHost($url)
    {

        return parse_url($url, PHP_URL_HOST);

    }

    // 获取URL域名
    public static function getDomain($url)
    {

        return self::getScheme($url) . '://' . $_SERVER['HTTP_HOST'];

    }

    // 获取URL查询字符串
    public static function getQuery($url)
    {

        return parse_url($url, PHP_URL_QUERY);

    }

    // 获取URL后缀
    public static function getExtension($url)
    {

        $extension = pathinfo(self::getPath($url), PATHINFO_EXTENSION);

        if(strpos($extension, '?') !== false){

            list($extension, $params) = explode('?', $extension);

        }elseif(strpos($extension, '&') !== false){

            list($extension, $params) = explode('&', $extension);

        }elseif(strpos($extension, '#') !== false){

            list($extension, $params) = explode('#', $extension);

        }

        return strtolower($extension);

    }

    // base64加密URL
    public static function base64_encode($url)
    {

        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($url));

    }

    // base64解密URL
    public static function base64_decode($str)
    {

        $data = str_replace(['-','_'], ['+', '/'], $str);
        $mod4 = strlen($data) % 4;

        if ($mod4) {

            $data .= substr('====', $mod4);

        }

        return base64_decode($data);

    }


}

