<?php

namespace gophp\captcha\driver;

use gophp\captcha\contract;
use gophp\config;
use gophp\exception;
use gophp\session;

class gd extends contract
{

    private $width; //验证码图片宽度，单位px
    private $height; //验证码图片高度，单位px
    private $length; // 验证码长度(个数)
    private $code; // 验证码内容
    private $name; //验证码名，用来区分不同用途
    private $expire; //验证码过期时间，单位秒
    private $disturb; //是否有干扰元素
    private $im;
    private static $error; //错误信息

    public function __construct($config)
    {

        if(!extension_loaded('gd'))
        {

            throw new exception('GD extension missing:', 'GD extension not install');

        }

        $this->config = $config ? $config['gd'] : config::get('captcha', 'gd');

        $this->width  = $this->config['width'];
        $this->height = $this->config['height'];
        $this->length  = $this->config['length'];
        $this->disturb = $this->config['disturb'];
        $this->expire  = $this->config['expire'];

        self::$error = [
            1000 => '验证码标识名为空',
            1005 => '要验证的验证码为空',
            1010 => '验证码不存在或已过期',
            1015 => '验证失败',
        ];

    }

    public function width($width)
    {

        $this->width = $width;

        return $this;

    }

    public function height($height)
    {

        $this->height = $height;

        return $this;

    }

    public function length($length)
    {

        $this->length = $length;

        return $this;

    }

    public function disturb($disturb = true)
    {

        $this->disturb = $disturb;

        return $this;

    }

    public function name($name)
    {

        if($name){

            $this->name = $name;
        }

        return $this;

    }

    public function expire($expire)
    {

        if(isset($expire)){

            $this->expire = $expire;

        }

        return $this;

    }

    public function show($name)
    {

        if(isset($name)){

            $this->name = $name;

        }

        if(!$this->name){

            return ['code' => 1000, 'msg' => self::$error[1000]];

        }

        $this->createImg();

        if($this->disturb){

            $this->setDisturb();

        }

        $this->setCode();

        $this->output();

    }

    // 创建图片
    private function createImg()
    {

        $this->im = imagecreatetruecolor($this->width, $this->height);

        $bgColor  = imagecolorallocate($this->im, 255, 255, 255);

        imagefill($this->im, 0, 0, $bgColor);

    }

    // 设置干扰元素
    private function setDisturb()
    {

        $area = ($this->width * $this->height) / 20;

        $num  = ($area > 250) ? 250 : $area;

        // 加入点干扰
        for ($i = 0; $i < $num; $i++) {

            $color = imagecolorallocate($this->im, rand(0, 255), rand(0, 255), rand(0, 255));

            imagesetpixel($this->im, rand(1, $this->width - 2), rand(1, $this->height - 2), $color);

        }
        // 加入弧线
        for ($i = 0; $i <= 5; $i++) {

            $color = imagecolorallocate($this->im, rand(128, 255), rand(125, 255), rand(100, 255));

            imagearc($this->im, rand(0, $this->width), rand(0, $this->height), rand(30, 300), rand(20, 200), 50, 30, $color);

        }
    }

    // 设置验证码
    private function setCode()
    {

        $token = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKMNPQRSTUVWXYZ";

        for ($i = 0; $i < $this->length; $i++) {

            $color = imagecolorallocate($this->im, rand(50, 250), rand(100, 250), rand(128, 250));

            $size  = rand(floor($this->height / 5), floor($this->height / 3));

            $x     = floor($this->width / $this->length) * $i + 5;

            $y     = rand(0, $this->height - 20);

            $this->code .= $token{rand(0, strlen($token) - 1)};

            imagechar($this->im, $size, $x, $y, $this->code{$i}, $color);

        }

        session::set('verify_code_'.$this->name, $this->code, $this->expire);

    }

    // 验证是否正确
    public function check($name, $code)
    {

        if(!name){

            return ['code' => 1000, 'msg' => self::$error[1000]];

        }

        $verifyCode = session::get('verify_code_'.$name);

        if(!$code){

            return ['code' => 1005, 'msg' => self::$error[1005]];

        }

        if(!$verifyCode){

            return ['code' => 1010, 'msg' => self::$error[1010]];

        }

        if(strtolower($code) != strtolower($verifyCode)){

            return ['code' => 1015, 'msg' => self::$error[1015]];

        }

        return ['code' => 200, 'msg' => '验证通过'];

    }

    // 输出图片
    private function output()
    {

        if (imagetypes() & IMG_JPG) {

            header('Content-type:image/jpeg');

            imagejpeg($this->im);

        } elseif (imagetypes() & IMG_GIF) {

            header('Content-type: image/gif');

            imagegif($this->im);

        } elseif (imagetype() & IMG_PNG) {

            header('Content-type: image/png');

            imagepng($this->im);

        } else {

            die("Don't support image type!");
        }

        // 释放资源
        imagedestroy($this->im);

    }

}