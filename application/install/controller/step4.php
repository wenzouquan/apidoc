<?php

namespace app\install\controller;

use gophp\db;
use gophp\helper\file;
use gophp\request;
use gophp\response;

class step4 extends auth {

    public function index(){

        set_time_limit(0);

        if(session('step') < 4){

            response::redirect('install/step3');

        }

        $_sql = file_get_contents(APP_PATH.'/install/data/db.sql');
        $_arr = array_filter(explode(';', $_sql));

        $db   = db::instance();

        foreach ($_arr as $k => $v) {

            $v = str_replace('doc_', $db->suffix, $v);

            if($table = explode('EXISTS', $v)[1]){

                $tables[] = $table;

            }

//            $k%30 == 0 and sleep(1);

            $db->query($v);

            ob_flush();
            flush();

        }

        // 管理员账号入库
        $admin = session('admin');

        $data['email']    = $admin['email'];
        $data['name']     = $admin['name'];
        $data['status']   = 1;
        $data['type']     = 2;
        $data['device']   = get_visit_source();
        $data['password'] = md5(encrypt($admin['password']));
        $data['ip']       = request::getClientIp();
        $data['address']  = get_ip_address();
        $data['add_time'] = date('Y-m-d H:i:s');

        $admin_id = db('user')->add($data);

        if($admin_id){

            // 创建安装锁文件
            if(!file::create(RUNTIME_PATH.'/install.lock','phprap v' . GOPHP_VERSION . 'install at  ' . date('Y-m-d H:i:s'))){

                $this->error('安装失败，请确认 ' . RUNTIME_PATH . ' 目录有读写权限');
                exit;

            }

        }else{

            $this->error('安装失败，请稍候再试');
            exit;

        }

        session('user_id', $admin_id, 24*3600);
        session('step', 4);

        $this->assign('tables', $tables);
        $this->display('step4');

    }

}
