<?php
/**
 * id加密解密类
 * Author: 勾国印 (phper@gouguoyin.cn)
 * Date: 2015-5-19 上午10:01:51
 */
namespace gophp\helper;

class id{

    private static $strbase = "Flpvf70CsakVjqgeWUPXQxSyJizmNH6B1u3b8cAEKwTd54nRtZOMDhoG2YLrI";
    private static $key = '2543.5415412812';
    private static $length = 10;
    private static $codelen;
    private static $codenums;
    private static $codeext;

    // 初始化
    function init($length){

        self::$codelen  = substr(self::$strbase, 0, self::$length);
        self::$codenums = substr(self::$strbase, self::$length, 10);
        self::$codeext  = substr(self::$strbase, self::$length + 10);
    }

    //加密
    public static function encode($id, $length = 10){


        self::init($length);

        $rtn     = "";
        $numslen = strlen($id);
        //密文第一位标记数字的长度
        $begin   = substr(self::$codelen,$numslen - 1,1);

        //密文的扩展位
        $extlen = self::$length - $numslen - 1;
        $temp   = str_replace('.', '', $id / self::$key);
        $temp   = substr($temp,-$extlen);

        $arrextTemp = str_split(self::$codeext);
        $arrext     = str_split($temp);

        foreach ($arrext as $v) {

            $rtn .= $arrextTemp[$v];

        }

        $arrnumsTemp = str_split(self::$codenums);
        $arrnums     = str_split($id);

        foreach ($arrnums as $v) {

            $rtn .= $arrnumsTemp[$v];

        }

        return $begin.$rtn;

    }

    //解密
    public static function decode($code){

        self::init(strlen($code));

        $begin     = substr($code,0,1);
        $decode_id = '';
        $length    = strpos(self::$codelen,$begin);

        if($length!== false){

            $length++;
            $arrnums = str_split(substr($code,-$length));

            foreach ($arrnums as $arrnum) {

                $decode_id .= strpos(self::$codenums,$arrnum);

            }

        }

        return $decode_id ? $decode_id : 0;

    }

}
