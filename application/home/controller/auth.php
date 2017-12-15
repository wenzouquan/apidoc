<?php

namespace app\home\controller;

use app\user;
use gophp\controller;
use gophp\response;

class auth extends controller {

    public $user_id;

    public function __construct()
    {

        // 判断是否登录
        $this->user_id = user::get_user_id();

        if(!$this->user_id){

            response::redirect('login');

        }

    }

}