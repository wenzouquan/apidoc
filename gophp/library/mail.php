<?php

namespace gophp;

use gophp\mail\contract;
use gophp\traits\driver;

class mail extends contract
{

    public $config;
    public $driver;
    public $handler;

    use driver;

    private function __construct()
    {

        $this->config = config::get('mail');

        $this->driver = $this->config['driver'];

    }

    public function from($from, $name)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($from, $name);

    }

    public function to($to, $name)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($to, $name);

    }

    public function attachment($path, $name)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($path, $name);

    }

    public function title($title)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($title);

    }

    public function body($body)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($body);

    }

    public function send()
    {

        $method = __FUNCTION__;

        return $this->handler()->$method();

    }

}