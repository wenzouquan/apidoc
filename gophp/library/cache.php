<?php

namespace gophp;

use gophp\cache\contract;
use gophp\traits\driver;

class cache extends contract
{

    public $config;
    public $driver;

    use driver;

    private function __construct()
    {

        $this->config = config::get('cache');

        $this->driver = $this->config['driver'];

    }

    public function exists($key)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($key);

    }

    public function get($key)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($key);

    }

    public function set($key, $value, $expire = 0)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($key, $value, $expire);

    }

    public function delete($key)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($key);

    }

    public function clean()
    {

        $method = __FUNCTION__;

        return $this->handler()->$method();

    }

}