<?php

namespace app;

use gophp\helper\file;
use gophp\schema;

class db {

    /**
     * 数据字典
     */
    public static function map($project_id, $sql_path)
    {

        if(!$project_id || !is_file($sql_path)){
            return false;
        }

        $sql_content = file_get_contents($sql_path);

        $sql_array   = array_filter(explode(';', $sql_content));

        if(!$sql_array){
            return false;
        }

        $db = \gophp\db::instance();

        foreach ($sql_array as $k =>$v) {
            if(strpos($v, 'CREATE TABLE') != false || strpos($v, 'create table') != false){

                $old_table_name = str_replace(['CREATE TABLE','create table', '`'], '', explode('(', $v)[0]);
                $old_table_name = trim($old_table_name);
                $new_table_name = $old_table_name . '_' . $project_id;

                $query_sql = str_replace($old_table_name, $new_table_name, $v);

                $db->query("DROP TABLE IF EXISTS $new_table_name;");
                $db->query($query_sql);

                $fileds[$old_table_name] =  schema::instance()->getFieldList($new_table_name);

                ob_flush();
                flush();
            }
        }

        // 先清空项目的数据字典表
        db('db_map')->show(false)->where('project_id', '=', $project_id)->delete();

        // 循环插入数据字典表
        foreach ($fileds as $table_name => $filed) {

            $new_table_name = $table_name . '_' . $project_id;

            $data['project_id'] = $project_id;
            $data['table_name'] = $table_name;
            $data['table_comment'] = schema::instance()->getTableComment($new_table_name);
            $data['field_json'] = json_encode($filed, JSON_UNESCAPED_UNICODE);
            $data['user_id']    = user::get_user_id();
            $data['add_time']   = date('Y-m-d H:i:s');

            $result = db('db_map')->add($data);

            if(!$result){

                return false;
            }

            $result = $db->query("DROP TABLE IF EXISTS $new_table_name;");

            $result and file::delete($sql_path);

        }

        return true;

    }


}