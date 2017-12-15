<?php

namespace app\admin\controller;

use app\config;
use gophp\db;
use gophp\page;
use gophp\request;
use gophp\response;

class user extends auth {

    public function index(){

        $project_id = request::get('project_id', 0);
        $search     = request::get('search', []);

        $db = db::instance();

        $table_suffix = $db->suffix;
        $table_name   = $table_suffix .'user';

        if($project_id){

            $user_sql = 'select user_id from ' . $table_suffix . 'member where project_id = ' . $project_id;

            $user_ids = $db->show(false)->query($user_sql);

            $user_ids = array_column($user_ids, 'user_id');

            $where = $where ? $where .= ' and ' : '';

            if($user_ids){

                $where .= "id in (" . implode(',', $user_ids) . ')';

            }else{

                $where .= 'id in (0)';

            }

        }

        if($name = $search['name']){

            $where = "(name like '%{$name}%' or email like '%{$name}%') ";

        }

        if($device = $search['device']){

            $where = $where ? $where .= ' and ' : '';

            $where .= "device = '{$device}' ";

        }

        $where = $where ? ' where ' . $where : '';

        $sql   = "select * from $table_name $where order by id DESC ";

        $total = count($db->show(false)->query($sql));

        $pre_rows = 10;

        $page  = new page($total, $pre_rows);

        $users = $db->show(false)->query($sql, $pre_rows);

        //获取默认密码
        $default_password = config::get_config_value('default_password');

        $this->assign('page', $page);
        $this->assign('users', $users);
        $this->assign('search', $search);
        $this->assign('default_password', $default_password);

        $this->display('user/index');

    }

    /**
     * 重置密码
     */
    public function reset_password()
    {

        $user_id = request::post('user_id', 0);

        $user = \app\user::get_user_info($user_id);

        if(!$user){

            response::ajax(['code' => 301, 'msg' => '抱歉，该会员不存在']);

        }

        $default_password = md5(encrypt(config::get_config_value('default_password')));

        $result = db('user')->where('id', '=', $user_id)->update(['password' => $default_password]);

        if($result !== false){

            response::ajax(['code' => 200, 'msg' => '密码重置成功!']);

        }else{

            response::ajax(['code' => 500, 'msg' => '密码重置失败!']);

        }

    }

    /**
     * 更改状态
     */
    public function change_status()
    {

        $user_id = request::post('user_id', 0);

        $user = \app\user::get_user_info($user_id);

        if(!$user){

            response::ajax(['code' => 301, 'msg' => '抱歉，该会员不存在']);

        }

        $result = db('user')->where('id', '=', $user_id)->update(['status' => 1-$user['status']]);

        if($result !== false){

            response::ajax(['code' => 200, 'msg' => '状态更新成功!']);

        }else{

            response::ajax(['code' => 500, 'msg' => '状态更新失败!']);

        }

    }

}