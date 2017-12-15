<?php

namespace app\install\controller;

use gophp\request;
use gophp\response;

class step3 extends auth {

    public function index(){

        if(session('step') < 3){

            response::redirect('install/step2');

        }

        if(request::isAjax()){

            $step3 = request::post('step3');

            session('admin', $step3);
            session('step', 4);

            response::ajax(['code' => 200, 'msg' => '提交成功']);

        }else{

            session('step', 3);

            $this->display('step3');

        }

    }

}