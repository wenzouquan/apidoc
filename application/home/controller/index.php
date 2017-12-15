<?php

namespace app\home\controller;

use gophp\response;

class index extends auth {

    public function index(){

        response::redirect('project/select');

    }

}