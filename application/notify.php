<?php

namespace app;

class notify {

    public static function get_notify_list()
    {

        $user_id = user::get_user_id();
        $notifys = db('notify')->show(false)->where('is_readed', '=', 0)->where('to_user_id', '=', $user_id)->limit(5)->orderBy('add_time desc')->findAll();

        return $notifys;

    }


    public static function add($data)
    {

        $user = user::get_user_info();

        $data['user_id']   = $user['id'];
        $data['user_name'] = $user['name'];
        $data['add_time']  = date('Y-m-d H:i:s');

        $result = db('notify')->add($data);

        return $result;

    }

}