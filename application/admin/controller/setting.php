<?php

namespace app\admin\controller;

use app\config;
use gophp\request;
use gophp\response;

class setting extends auth {

    /**
     * 管理配置
     */
    public function index()
    {
        if(request::isAjax()){

            $config = request::post('config', []);

            if(!$config){

                response::ajax(['code' => 300, 'msg' => '缺失必要参数']);

            }

            if(db('config')->find()){

                $result = db('config')->update(['config' => json_encode($config, JSON_UNESCAPED_UNICODE)]);

            }else{

                $result = db('config')->add(['config' => json_encode($config, JSON_UNESCAPED_UNICODE)]);

            }

            if($result !== false){

                response::ajax(['code' => 200, 'msg' => '系统配置成功']);

            }else{

                response::ajax(['code' => 304, 'msg' => '该模块名称已存在']);

            }

        }else{

            $config = config::get_config_value();

            $this->assign('config', $config);
            $this->display('setting/index');

        }

    }


}