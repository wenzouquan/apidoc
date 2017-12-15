<?php

namespace gophp\cache\driver;

use gophp\cache\contract;

class redis extends contract {

    public $config;
    public $driver;
    public $cache;

    public function __construct($config)
    {

        $this->config = $config['redis'];

        $this->cache  = \gophp\redis::instance($this->config);

    }

    public function exists($key)
    {

        return $this->cache->exists($key);

    }

    public function get($key)
    {

        return $this->cache->get($key);

    }

    public function set($key, $value, $expire = 0)
    {

        return $this->cache->set($key, $value, $expire);

    }

    public function delete($key)
    {

        return $this->redis->delete($key);

    }

    public function clean()
    {

        return $this->redis->flushall();

    }

    public function increment($key, $value = 1)
    {

        return $this->redis->incrby($key, $value);

    }

    public function decrement($key, $value = 1)
    {

        return $this->redis->decrby($key, $value);

    }

}