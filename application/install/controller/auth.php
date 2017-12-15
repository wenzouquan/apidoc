<?php

namespace app\install\controller;

use gophp\controller;
use gophp\helper\file;

class auth extends controller {

    public function __construct()
    {

        if(file::exists(RUNTIME_PATH.'/install.lock')){
            exit('<stong>程序已经安装，如果您确定要重新安装，请先删除 runtime/install.lock 再重新运行</stong>');
        }

    }

}