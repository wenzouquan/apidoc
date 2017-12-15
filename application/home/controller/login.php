<?php

namespace app\home\controller;

use app\user;
use gophp\captcha;
use app\config;
use gophp\controller;
use gophp\request;
use gophp\response;

class login extends controller {

    public function index(){

        $user_id = user::get_user_id();

        // 是否开启登录验证码
        $login_captcha = config::get_config_value('login_captcha');

        if($user_id){

            response::redirect('project/select');

        }elseif(request::isPost()){

            $email    = request::post('email', '');
            $password = request::post('password', '');
            $code     = request::post('code', '');


            $captcha = captcha::instance()->check('login', $code);

            if($login_captcha && $captcha['code'] != 200){

                return response::ajax(['code' => 402, 'msg' => '验证码错误或已失效!']);

            }

            $password = md5(encrypt($password));

            $user     = db('user')->show(false)->where('email', '=', $email)->where('password', '=', $password)->find();

            if($user && $user['status'] == 1){

                // 添加登录日志
                db('login_log')->add([
                    'user_id' => $user['id'],
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'add_time'=> date('Y-m-d H:i:s'),
                    'ip'      => request::getClientIp(),
                    'address' => get_ip_address(),
                    'device'  => get_visit_source(),
                ]);

                session('user_id', $user['id'], 24*3600);

                $data = ['code' => 200, 'msg' => '登录成功'];

            }elseif($user && !$user['status']){

                $data = ['code' => 400, 'msg' => '抱歉，您已被禁用，请联系管理员!'];

            }else{

                $data = ['code' => 401, 'msg' => '用户名或密码错误'];

            }

            $this->ajaxReturn($data);

        }else{

            $this->assign('login_captcha', $login_captcha);
            $this->display('login');

        }

    }

    public function code(){

        $code = captcha::instance()->show('login');

        echo $code;

    }

}