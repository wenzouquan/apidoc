<?php

namespace app\install\controller;

use gophp\controller;
use gophp\response;

class index extends controller {

    public function index()
    {

        response::redirect('install/step1');

    }

}