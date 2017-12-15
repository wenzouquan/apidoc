<?php

namespace gophp;

use gophp\traits\call;

class redis
{

    private $redis  = null;
    private $config = [];

    use call;

    private function __construct($config)
    {

        $this->config = $config ? $config : config::get('redis');

        if(!extension_loaded('redis'))
        {

            throw new exception('Redis Error', 'Redis extension not install');

        }

        return self::connect($this->config);

    }

    // 链接redis服务器
    private function connect($config)
    {

        $this->config = $config;

        $this->redis  = new \Redis();

        if(!$this->redis->connect( $this->config['host'], $this->config['port'])) {

            throw new exception('Redis Error', 'Redis connect fail');

        }

        $this->config['password'] and $this->redis->auth($this->config['password']);

        return $this->redis;

    }

    // 拼装完整键名
    private function key($key)
    {

        return $this->config['prefix'] . $key;

    }

    // 检测指定键名是否存在
    public function exists($key)
    {

        $key =$this->key($key);

        return $this->redis->exists($key);

    }

    // 设置
    protected function set($key, $value, $expire = null)
    {

        $expire = isset($expire) ? $expire : $this->config['expire'];

        $key    = $this->key($key);

        $value  = is_numeric($value) ? $value : serialize($value);

        if(!$expire){

            return $this->redis->set($key, $value);

        }

        return $this->redis->setex($key, (int)$expire, $value);

    }

    // 获取指定元素
    protected function get($key)
    {

        $key   = $this->key($key);

        $value = $this->redis->get($key);

        return is_numeric($value) ? $value : unserialize($value);

    }
    // 删除指定元素
    protected function delete($key)
    {

        $key = $this->key($key);

        return $this->redis->delete($key);

    }

    // 清除所有元素
    protected function clean()
    {

        return $this->redis->flushall();

    }

    // 自增
    protected function inc($key, $value = 1)
    {

        $key = $this->key($key);

        return $this->redis->incrby($key, $value);

    }

    // 自减
    protected function dec($key, $value = 1)
    {

        $key = $this->key($key);

        return $this->redis->decrby($key, $value);
    }

}

