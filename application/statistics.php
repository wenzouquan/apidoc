<?php

namespace app;

use gophp\db;

class statistics {

    // 获取今日新增数据
    public static function get_today_num($table)
    {

        $db = db::instance();

        $table_suffix = $db->suffix;
        $table_name   = $table_suffix . $table;

        $start_time = date('Y-m-d 00:00:00');
        $end_time   = date('Y-m-d 23:59:59');

        return $db->show(false)->query("SELECT count(*) FROM {$table_name} WHERE add_time > '{$start_time}' AND add_time < '{$end_time}'");

    }

    // 获取全部数据
    public static function get_all_num($table)
    {

        $db = db::instance();

        $table_suffix = $db->suffix;
        $table_name   = $table_suffix . $table;

        return $db->show(false)->query("SELECT count(*) FROM {$table_name}");

    }

}