<?php

namespace gophp;

use gophp\traits\instance;

class cookie
{

    private $config;

    use instance;

    public function __construct()
    {

        $this->config = config::get('cookie');

    }

    // 设置cookie
    public function set($name, $value, $expire = null, $path = null, $domain = null, $secure = null)
    {

        $expire = $expire ? $expire : $this->config['expire'];
        $path   = $path   ? $path   : $this->config['path'];
        $domain = $domain ? $domain : $this->config['domain'];
        $secure = $secure ? $secure : $this->config['secure'];

        // 如果是数组，对数组的每个元素加密
        if(is_array($value)){

            $value = array_map([$this, 'encrypt'], $value);

        }else{

            $value = $this->encrypt($value);

        }

        return setcookie($name, serialize($value), time()+$expire, $path, $domain, $secure);

    }

    // 获取cookie
    public function get($name)
    {

        $key = $this->key($name)[0];

        if($this->has($key)){

            $value = unserialize($_COOKIE[$key]);

            if(!is_array($value)){

                return $this->decrypt($value);
            }

            $value  = array_map([$this, 'decrypt'], $value);

            if($key = $this->key($name)[1]){

                return $value[$key];

            }

            return $value;

        }

        return null;

    }

    // 是否存在cookie
    public function has($name)
    {

        return isset($_COOKIE[$name]);

    }

    // 删除指定cookie
    public function delete($name)
    {

        return $this->set($name, '', -1);

    }

    // 清除全部cookie
    public function clean()
    {

        foreach ($_COOKIE as $key => $val) {

            setcookie($key, '', -1, '/');

        }

    }

    private function key($name)
    {

        return explode('.', $name);

    }

    // cookie加密
    private function encrypt($value)
    {

        return crypt::instance()->encrypt($value);

    }

    // cookie解密
    private function decrypt($value)
    {

        return crypt::instance()->decrypt($value);

    }

}