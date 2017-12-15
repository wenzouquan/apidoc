<?php

namespace app\home\controller;

use app\db;
use gophp\controller;
use gophp\helper\file;
use gophp\request;
use gophp\response;

class upload extends controller {

    public function sql(){


        $upload = \gophp\upload::instance();

        $project_id = request::post('id', 0);

        $project = \app\project::get_project_info($project_id);

        if(!$project){

            response::ajax(['code' => 300, 'msg' => '请选择要上传的项目!']);

        }

        $upload->max_size = 2;
        $upload->allow_suffix = 'sql';

        $file_name = $upload->file('sql-file');

        if($error = $upload->getError()){

            response::ajax(['code' => 301, 'msg' => $error]);

        }

        $sql_path = WEB_PATH . $file_name;

        $result  = db::map($project_id, $sql_path);

        if($result){

            response::ajax(['code' => 200, 'msg' => '导入成功']);

        }

        response::ajax(['code' => 303, 'msg' => '导入失败']);

    }

}