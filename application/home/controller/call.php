<?php

namespace app\home\controller;

use gophp\controller;
use gophp\response;

class call extends controller {

    public function index(){

        response::redirect('index');

    }

    public function __call($name, $arguments)
    {

        response::redirect($this->controlloer);

    }

}