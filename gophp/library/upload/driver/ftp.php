<?php

namespace gophp\upload\driver;

use gophp\config;

class ftp
{

    private $smarty = null;
    private $config = []; //配置信息

    public function __construct()
    {
        $this->config = config::get('upload');
    }

    public function __destruct()
    {

        $this->smarty = null;

    }

}