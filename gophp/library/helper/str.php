<?php

namespace gophp\helper;

class str
{

    const single = 1; //单引号
    const double = 2; //双引号
    const back   = 3; //反引号
    const comma  = 4; //英文逗号

    /**
     * 截取指定长度字符串
     * @param $str
     * @param $length
     * @param string $fix
     * @return string
     */
    public static function cut($str, $length, $fix = '...')
    {

        $str = $str ? trim($str) : '';

        if(!$str){

            return $str;

        }

        $subStr  = mb_substr($str, 0, $length, 'UTF-8');

        if ($length > 0 && mb_strlen($str , 'UTF-8') > $length) {

            return $subStr . $fix;

        } else {

            return $str;

        }

    }

    /**
     * 生成指定长度随机字符串
     * @param int $length
     * @param int $type
     * @return string
     */
    public static function random($length = 4, $type = 0)
    {

        switch ($type) {

            case 1 :

                $salt  = array_merge(range('A', 'Z'), range('a', 'z'));

                break;

            case 2 :

                $salt  = range(0, 9);

                break;

            default:

                $salt  = array_merge(range('A', 'Z'), range('a', 'z'), range(0, 9));

                break;

        }

        $count = count($salt);

        $hash = '';

        for ($i = 0; $i < $length; $i++) {

            $hash .= $salt[mt_rand(0, $count-1)];

        }

        return $hash;
    }

    public static function nl2br($str){

        return str_replace(array("\r\n", "\r", "\n"), "<br/>", $str);

    }

    /**
     * 给字符串添加引号
     * @param $str
     * @return string
     */
    public static function quote($str, $type = 1)
    {

        switch ($type) {

            case 1:

                $str = '\'' . $str . '\'';

                break;

            case 2:

                $str = '"' . $str . '"';

                break;

            case 3:

                $str = '`' . $str . '`';

                break;

            case 4:

                $str = ',' . $str . ',';

                break;

        }

        return $str;

    }

    /**
     * 下划线转驼峰
     * @param $str
     * @param string $type
     * @return string
     */
    public static function underline2camel($str, $type = 'lower')
    {

        $array = explode('_', $str);

        $result = '';

        foreach($array as $value){

            $result.= ucfirst($value);

        }

        if($type == 'upper'){

            return ucfirst($result);

        }elseif($type == 'lower'){

            return lcfirst($result);

        }

    }

    /**
     * 驼峰转下划线
     * @param $str
     * @return string
     */
    public static function camel2underline($str)
    {

        $array = array();

        for($i=0;$i<strlen($str);$i++){

            if($str[$i] == strtolower($str[$i])){

                $array[] = $str[$i];

            }else{

                if($i>0){
                    $array[] = '_';
                }

                $array[] = strtolower($str[$i]);

            }

        }

        $result = implode('',$array);

        return $result;

    }

    /**
     * @desc 清理字符串的bom头
     * @param $str
     * @return string
     */
    public static function clearBom($str)
    {
        if($str && ord($str[0]) == 239 && ord($str[1]) == 187 && ord($str[2]) == 191)
        {
            $str = substr($str,3);
        }
        return $str;
    }

    /**
     * @desc 将字符串转为拼音
     * @param $str
     * @return mixed
     */
    public static function pinyin($str)
    {
        return $str;
    }

}

