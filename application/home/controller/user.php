<?php

namespace app\home\controller;

use app\member;
use gophp\crypt;
use gophp\db;
use gophp\request;
use gophp\response;

class user extends auth {

    public function index(){

        if(request::isGet()){

            $users = db('user')->findAll();

            $this->assign('users', $users);

            $this->display('user/list');

        }elseif(request::isPost()){

            $name     = request::post('name', '');
            $password = request::post('password', '');

            if(!$name){

                response::ajax(['code' => 400, 'msg' => '昵称不能为空']);
            }

            $data['name'] = $name;

            if($password){

                $data['password'] = md5(encrypt($password));
            }

            $user = db('user')->show(false)->where('id', '=', $this->user_id)->update($data);

            if($user !== false){

                if($password){

                    // 如果修改密码，需要重新登录
                    session('user_id', null);

                }

                response::ajax(['code' => 200, 'msg' => '个人资料修改成功']);

            }

        }else{

            response::ajax('非法请求方式');
        }
    }

    public function select(){

        $project_id = request::get('project_id', 0);
        $name       = request::get('name', '');

        $member_ids = '';

        // 获取已经是成员的用户id
        $member_id  = db('member')->where('project_id', '=', $project_id)->column('user_id');

        $member_id && $member_ids = implode(',', $member_id) . ',';

        // 排除掉已是成员的和自己的id
        $member_ids = $member_ids . $this->user_id;

        $data = [];

        if(!$name){

            return response::ajax($data);

        }

        $db     = db::instance();
        $suffix = $db->suffix;

        $sql  = "SELECT id,name,email FROM {$suffix}user WHERE id NOT IN ($member_ids) AND (name LIKE '%{$name}%' OR email LIKE '%{$name}%')";

        $user = $db->show(false)->query($sql);

        if(!$user){

            return response::ajax($data);

        }

        foreach ($user as $k => $v) {
            $data[$k]['id'] = $v['id'];
            $data[$k]['email'] = $v['email'];
            $data[$k]['name'] = $v['name'] . '(' . $v['email'] . ')';
        }

        return response::ajax($data);

    }

}