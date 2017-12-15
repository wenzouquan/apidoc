<?php

namespace app;

class log {


    public static function login($project_id)
    {

    }

    public static function add($data)
    {

    }

    public static function project($data)
    {

        $user = user::get_user_info();

        $data['user_id']    = $user['id'];
        $data['user_name']  = $user['name'];
        $data['user_email'] = $user['email'];
        $data['add_time']   = date('Y-m-d H:i:s');

        return db('project_log')->show(false)->add($data);

    }

    public static function module($data)
    {

        $user = user::get_user_info();

        $data['user_id']   = $user['id'];
        $data['user_name'] = $user['name'] . '(' . $user['email'] . ')';
        $data['add_time']  = date('Y-m-d H:i:s');

        return db('project_log')->show(false)->add($data);

    }

    public static function api($data)
    {

        $user = user::get_user_info();

        $data['user_id']   = $user['id'];
        $data['user_name'] = $user['name'] . '(' . $user['email'] . ')';
        $data['add_time']  = date('Y-m-d H:i:s');

        return db('project_log')->show(false)->add($data);

    }

    public static function field($data)
    {

        $user = user::get_user_info();

        $data['user_id']   = $user['id'];
        $data['user_name'] = $user['name'] . '(' . $user['email'] . ')';
        $data['add_time']  = date('Y-m-d H:i:s');

        return db('project_log')->show(false)->add($data);

    }

    public static function member($data)
    {

        $user = user::get_user_info();

        $data['user_id']   = $user['id'];
        $data['user_name'] = $user['name'] . '(' . $user['email'] . ')';
        $data['add_time']  = date('Y-m-d H:i:s');

        return db('project_log')->show(false)->add($data);

    }


}