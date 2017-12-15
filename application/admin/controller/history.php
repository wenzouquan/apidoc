<?php

namespace app\admin\controller;

use gophp\db;
use gophp\page;
use gophp\request;

class history extends auth {

    // 登录历史
    public function login()
    {

        $user_id = request::get('user_id', 0);
        $search  = request::get('search', []);

        $db = db::instance();

        $table_suffix = $db->suffix;
        $table_name   = $table_suffix .'login_log';

        if($user_id){

            $where = "user_id = $user_id ";

        }

        if($name = trim($search['name'])){

            $user_sql = 'select id from ' . $table_suffix . 'user where ' .  "(name like '%{$name}%' or email like '%{$name}%') ";

            $user_ids = $db->show(false)->query($user_sql);

            $user_ids = array_column($user_ids, 'id');

            $user_ids = $user_ids ? $user_ids : 0;

            $where = $where ? $where .= ' and ' : '';

            if($user_ids){

                $where .= "user_id in (" . implode(',', $user_ids) . ')';

            }else{

                $where .= 'user_id in (0)';

            }

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

        $sql   = "select * from $table_name $where order by id desc";

        $total = count($db->show(false)->query($sql));

        $pre_rows = 10;

        $page  = new page($total, $pre_rows);

        $historys = $db->show(false)->query($sql, $pre_rows);

        $this->assign('search', $search);
        $this->assign('historys', $historys);
        $this->assign('page', $page);

        $this->display('history/login');

    }

}