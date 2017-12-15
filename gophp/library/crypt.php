<?php

namespace gophp;

use gophp\crypt\contract;
use gophp\traits\driver;

class crypt extends contract
{

    public $config;
    public $driver;
    public $method;

    use driver;

    private function __construct()
    {

        $config       = config::get('crypt');

        $this->driver = $config['driver'];

        $this->config = $config[$this->driver];

    }

    public function encrypt($str)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($str);

    }

    public function decrypt($str)
    {

        $method = __FUNCTION__;

        return $this->handler()->$method($str);

    }

}