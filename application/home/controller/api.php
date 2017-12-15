<?php

namespace app\home\controller;

use app\log;
use gophp\request;
use gophp\response;
use gophp\validate;

class api extends auth {

    /**
     * 添加接口
     */
    public function add(){

        if(request::isAjax()){

            $api = request::post('api', []);

            $result = \app\api::add($api);

            response::ajax(['code' => $result['code'], 'msg' => $result['msg']]);

        }else{

            $module_id = get('id', 0);

            $module = _uri('module', $module_id);

            $this->assign('module', $module);

            $this->display('api/add');

        }

    }

    /** 
     * 删除接口
     */
    public function delete()
    {

        $api_id   = request::post('id', 0);
        $password = request::post('password', '');

        $api = \app\api::get_api_info($api_id);

        if(!$api){

            response::ajax(['code' => 301, 'msg' => '请选择要删除的接口!']);

        }

        if(!\app\user::check_password($password)){

            response::ajax(['code' => 302, 'msg' => '抱歉，密码验证失败!']);

        }

        $result  = db('api')->show(false)->delete($api_id);

        $project = \app\api::get_project_info($api_id);

        $module  = \app\module::get_module_info($api['module_id']);

        if($result){

            // 记录日志
            $log = [
                'project_id' => $project['id'],
                'type'       => '删除',
                'object'     => '接口',
                'content'    => '删除模块<code>'.$module['title'].'</code>下的接口<code>' . $api['title'] . '</code>',
            ];

            log::project($log);

            response::ajax(['code' => 200, 'msg' => '删除成功!']);

        }else{

            response::ajax(['code' => 403, 'msg' => '删除失败!']);

        }

    }

    /**
     * 编辑接口
     */
    public function edit()
    {

        $api_id = request::post('id', 0);

        // 判断接口是否存在
        $api = _uri('api', $api_id);

        if(!$api){

            $this->error('抱歉，该接口不存在');

        }

        $project_id = _uri('module', $api['module_id'], 'project_id');

        $modules = db('module')->where('project_id', '=', $project_id)->findAll();

        // 获取请求参数列表
        $request_fields = \app\field::get_field_list($api_id, 1);

        // 获取响应参数列表
        $response_fields = \app\field::get_field_list($api_id, 2);

        // 获取header参数列表
        $header_fields = \app\field::get_field_list($api_id, 3);

        // 获取返回json示例
        $respose_json = json_encode(\app\field::get_default_data($api_id), JSON_UNESCAPED_UNICODE);

        $this->assign('api', $api);
        $this->assign('modules', $modules);
        $this->assign('request_fields', $request_fields);
        $this->assign('response_fields', $response_fields);
        $this->assign('header_fields', $header_fields);
        $this->assign('respose_json', $respose_json);

        $this->display('api/edit');

    }


    public function load()
    {

        $api_id = request::post('id', 0);

        $api    = _uri('api', $api_id);

        // 判断接口是否存在
        if(!$api){

            $this->error('抱歉，该接口不存在');

        }

        $api['module'] = _uri('module', $api['module_id']);

        $project_id = _uri('module', $api['module_id'], 'project_id');

        $project = _uri('project', $project_id);

        // 获取项目模块
        $modules = db('module')->where('project_id', '=', $project_id)->findAll();

        // 获取请求参数列表
        $request_fields = \app\field::get_field_list($api_id, 1);

        // 获取响应参数列表
        $response_fields = \app\field::get_field_list($api_id, 2);

        // 获取header参数列表
        $header_fields = \app\field::get_field_list($api_id, 3);

        $this->assign('api', $api);
        $this->assign('project', $project);
        $this->assign('modules', $modules);
        $this->assign('request_fields', $request_fields);
        $this->assign('response_fields', $response_fields);
        $this->assign('header_fields', $header_fields);

        $this->display('api/load');

    }

    /**
     * 接口详情
     * @param $id
     * @param $arguments
     */
    public function __call($id, $arguments)
    {

        $api_id = id_decode($id) ? id_decode($id) : 0;
        $api    = \app\api::get_api_info($api_id);

        // 判断接口是否存在
        if(!$api){

            $this->error('抱歉，该接口不存在');

        }

        $api['decode_id'] = $id;

        $api['module'] = _uri('module', $api['module_id']);

        $project_id    = _uri('module', $api['module_id'], 'project_id');

        $project       = _uri('project', $project_id);
        $project['encode_id'] = id_encode($project_id);

        if(!\app\member::has_rule($project_id, 'api', 'look')){

            $this->error('抱歉，您无权查看该接口');

        }

        $envs    = json_decode($project['envs'], true);

        // 获取项目模块
        $modules = db('module')->where('project_id', '=', $project_id)->findAll();

        // 获取header参数列表
        $header_fields = \app\field::get_field_list($api_id, 3);

        // 获取请求参数列表
        $request_fields = \app\field::get_field_list($api_id, 1);

        // 获取响应参数列表
        $response_fields = \app\field::get_field_list($api_id, 2);

        // 获取返回json示例
        $respose_json = json_encode(\app\field::get_default_data($api_id), JSON_UNESCAPED_UNICODE);

        $this->assign('api', $api);
        $this->assign('project', $project);
        $this->assign('envs', $envs);
        $this->assign('modules', $modules);
        $this->assign('header_fields', $header_fields);
        $this->assign('request_fields', $request_fields);
        $this->assign('response_fields', $response_fields);
        $this->assign('respose_json', $respose_json);

        $this->display('api/detail');

    }
}