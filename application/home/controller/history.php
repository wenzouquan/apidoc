<?php

namespace app\home\controller;

use app\user;
use gophp\db;
use gophp\page;
use gophp\request;

class history extends auth {

    // 登录历史
    public function login()
    {

        $user_id = user::get_user_id();
        $search  = request::get('search', []);

        $db = db::instance();

        $table_suffix = $db->suffix;
        $table_name   = $table_suffix .'login_log';

        if($user_id){

            $where = "user_id = $user_id ";

        }


        if($ip = trim($search['ip'])){

            $where = $where ? $where .= ' and ' : '';

            $where = "ip like '%{$ip}%'";

        }

        if($device = trim($search['device'])){

            $where = $where ? $where .= ' and ' : '';

            $where .= " device = '{$device}' ";

        }

        $where = $where ? ' where ' . $where : '';

        $sql   = "select * from $table_name $where";

        $total = count($db->query($sql));

        $pre_rows = 10;

        $page  = new page($total, $pre_rows);

        $historys = $db->show(false)->query($sql, $pre_rows);

        $this->assign('search', $search);
        $this->assign('historys', $historys);
        $this->assign('page', $page);

        $this->display('history/login');

    }

}