<?php

namespace gophp;

use gophp\session\contract;
use gophp\traits\driver;

class session extends contract
{

    public $config;
    public $driver;

    use driver;

    private function __construct()
    {

        if(!$this->isActive()){

            session_start();

        }

        $this->config = config::get('session');

        $this->driver = $this->config['driver'];

    }

    public function set($name, $value, $expire = null)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($name, $value, $expire);

    }

    public function has($name)
    {
        $method = __FUNCTION__;

        return $this->handler()->$method($name);

    }

    public function get($name)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($name);

    }

    public function delete($name)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($name);

    }

    public function clean()
    {

        $method = __FUNCTION__;

        return $this->handler()->$method();

    }

    // SESSION是否是激活状态
    private function isActive()
    {

        return session_status() === PHP_SESSION_ACTIVE ? true : false;

    }

}