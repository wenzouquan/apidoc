<?php

namespace app\home\controller;

use gophp\request;
use gophp\response;
use gophp\session;

class logout extends auth {

    public function index(){

        if(request::isPost()){

            session('user_id', null);

            $data = ['code' => 200, 'msg' => '退出成功'];

            return response::ajax($data);

        }else{

            return response::ajax(['code' => 401, 'msg' => '非法请求方式']);

        }

    }

}