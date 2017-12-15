<?php

namespace gophp\traits;

use gophp\exception;
use gophp\helper\str;
use gophp\reflect;

trait driver
{

    public $config;
    public $driver;
    public $handler;

    use instance;

    public function driver($driver)
    {

        isset($driver) && $this->driver = $driver;

        return $this;

    }

    private function handler()
    {

        $driver = self::class . '\\driver\\' . $this->driver;

        if(!class_exists($driver)){

            $className = reflect::getName(self::class);

            throw new exception( ucfirst($className) . ' driver ' . str::quote($this->driver) . ' not exist');

        }

        // 单例模式
        if(!$this->handler){

            $this->handler = new $driver($this->config);

        }

        return $this->handler;

    }

    final public function __destruct()
    {

        $this->config  = null;
        $this->handler = null;

    }

}