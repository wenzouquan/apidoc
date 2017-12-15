<?php

namespace gophp\view\driver;

use gophp\exception;
use gophp\view\contract;

class php extends contract
{

    protected $data = [];

    public function __construct($config)
    {

        $this->config = $config['php'];

    }

    // 模板是否存在
    public function exists($viewFile)
    {

        return file_exists($viewFile);

    }

    // 模板赋值
    public function assign($name, $value)
    {

        $this->data[$name] = $value;

    }

    // 获取模板内容
    public function fetch($viewName)
    {

        $viewFile = $this->getViewFile($viewName);

        if($this->exists($viewFile)){

            extract($this->data);

            return file_get_contents($viewFile);

        }
    }

    // 渲染模板
    public function display($viewName = null)
    {

        $viewFile = $this->getViewFile($viewName);

        if($this->exists($viewFile)){

            extract($this->data);

            require $viewFile;

        }else{

            throw new exception('View Error', 'Template file ' . $viewFile . ' not exist');

        }

    }

}