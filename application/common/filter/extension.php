<?php

namespace app\common\filter;

use gophp\config;
use gophp\log;
use gophp\request;

class extension
{

    public function run()
    {

        $httpExtension  = request::getExtension();

        $allowExtension = config::get('http', 'allow_extension');

        if($httpExtension && !in_array($httpExtension, $allowExtension)){

            return $httpExtension . '扩展不允许访问';

        }

        return true;
    }

}
