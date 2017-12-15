<?php

namespace app\home\controller;

use gophp\reflect;
use gophp\request;
use gophp\response;

class field extends auth {

    /**
     * 添加/编辑字段
     */
    public function add(){

        if(request::isAjax()){

            $field  = request::post('field', []);

            $result = \app\field::add($field);

            response::ajax(['code' => $result['code'], 'msg' => $result['msg']]);

        }

    }

    // 添加header参数页面
    public function header()
    {

        $ids = request::get('id', '');

        list($api_id, $field_id) = explode('-', $ids);

        $field = \app\field::get_field_info($field_id);

        $field['api_id'] = $api_id ? $api_id : 0;
        $field['id']     = $field_id;

        $this->assign('field', $field);

        $this->display('field/header/add');

    }

    // 添加请求参数页面
    public function request()
    {

        $ids = request::get('id', '');

        list($api_id, $field_id) = explode('-', $ids);

        $field = \app\field::get_field_info($field_id);

        $field['api_id'] = $api_id ? $api_id : 0;
        $field['id']     = $field_id;

        $this->assign('field', $field);

        $this->display('field/request/add');

    }

    // 添加响应参数页面
    public function response()
    {

        $ids = request::get('id', '');

        list($api_id, $parent_id, $field_id) = explode('-', $ids);

        $field = \app\field::get_field_info($field_id);

        $methods = reflect::getMethods(\app\mock::class);

        $field['api_id']    = $api_id;
        $field['parent_id'] = $parent_id;
        $field['id']        = $field_id;

        $this->assign('field', $field);
        $this->assign('methods', json_encode($methods, JSON_UNESCAPED_UNICODE));

        $this->display('field/response/add');
    }

    // ajax载入参数列表
    public function load()
    {

        $method = request::post('method', 0);
        $api_id = request::post('api_id', 0);

        $fields = \app\field::get_field_list($api_id, $method);

        $api    = \app\api::get_api_info($api_id);

        $this->assign('api', $api);

        if($method == 1){

            $this->assign('request_fields', $fields);
            $this->display('field/request/load');

        }elseif($method == 2){

            $this->assign('response_fields', $fields);
            $this->display('field/response/load');

        }elseif($method == 3){

            $this->assign('header_fields', $fields);
            $this->display('field/header/load');

        }

    }

    // ajax载入响应json数据
    public function json()
    {

        $api_id = request::post('api_id', 0);

        $api = \app\api::get_api_info($api_id);

        // 获取返回json示例
        $respose_json = json_encode(\app\field::get_default_data($api_id), JSON_UNESCAPED_UNICODE);

        $this->assign('api', $api);
        $this->assign('respose_json', $respose_json);

        $this->display('field/response/json');

    }

    /**
     * 删除参数
     */
    public function delete()
    {

        $field_id = request::post('id', 0);

        $result   = \app\field::delete($field_id);

        response::ajax(['code' => $result['code'], 'msg' => $result['msg']]);

    }

    public function refresh()
    {

        $api_id = request::post('api_id', 0);

        $fields = db('field')->where('method', '=', 2)->where('api_id', '=', $api_id)->findAll();

        foreach ($fields as $field) {

            $data['default_value'] = \app\field::get_mock_value($field['mock']);
            db('field')->where('id', '=', $field['id'])->update($data);

        }

        response::ajax(['code' => 200, 'msg' => '刷新成功']);

    }

}