<?php

namespace gophp;

use gophp\traits\driver;

class upload
{

    public $config;
    public $driver;
    public $max_size;
    public $allow_suffix;
    public $save_dir;
    public $save_name;

    use driver;

    private function __construct()
    {

        $config = config::get('upload');

        $this->driver = $config['driver'];

        $this->config = $config[$this->driver];

    }

    public function file($inputName)
    {

        $this->max_size and $this->config['max_size'] = $this->max_size;
        $this->allow_suffix and $this->config['allow_suffix'] = $this->allow_suffix;
        $this->save_dir and $this->config['save_dir'] = $this->save_dir;
        $this->save_name and $this->config['save_name'] = $this->save_name;

        $method = __FUNCTION__;

        return $this->handler()->$method($inputName);

    }

    public function getError()
    {

        $method = __FUNCTION__;

        return $this->handler()->$method();

    }

    private function __get($name)
    {

        if(isset($this->$name)) {

            return($this->$name);

        } else {

            return null;
        }
    }

    private function __set($name, $value)
    {
        $this->$name = $value;
    }

}