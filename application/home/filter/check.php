<?php

namespace app\home\filter;

use gophp\helper\file;
use gophp\response;

class check
{

    public function run()
    {

        if(!file::exists(RUNTIME_PATH.'/install.lock')){

            response::redirect('install/step1');exit;

        }

        return true;
    }

}
