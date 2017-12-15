<?php

namespace app\admin\controller;

use gophp\schema;

class index  extends auth {

    public function index(){

        $user   = \app\user::get_user_info();

        $last_login = \app\user::get_last_login();

        $system = [
            'gophp_version' => GOPHP_VERSION,
            'php_version'   => PHP_VERSION,
            'mysql_version' => schema::instance()->version(),
        ];

        $this->assign('user', $user);
        $this->assign('last_login', $last_login);
        $this->assign('system', $system);

        $this->display('index');

    }

}