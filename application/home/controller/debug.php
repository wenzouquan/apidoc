<?php

namespace app\home\controller;

use app\api;
use gophp\controller;
use gophp\curl;
use gophp\request;
use gophp\response;

class debug extends controller {

    // 获取接口id
    public function index()
    {
        $api     = request::post('api', []);
        $request = request::post('request', []);

        if(!$url = $api['url']){

            response::ajax(['code'=> 300, 'msg' => '请求地址不存在']);

        }

        if(!$method = $api['method']){

            response::ajax(['code'=> 300, 'msg' => '请求方式不存在']);

        }

        $data = [];

        foreach ($request as $k=>$v){
            foreach ($v as $k1=>$v1){
                $data[$request['key'][$k1]] = $v1;
            }
        }

        $curl = new curl($url, $method, $data);

        if($info = $curl->getInfo()){

            $info = serialize($info);

        }

        if($body = $curl->getBody()){
            $body = serialize($body);
        }

        if($header = $curl->getHeader()){
            $header = serialize($header);
        }

        response::ajax(['info' => $info,'header' => $header,'body' => $body]);

    }

    public function load()
    {

        $info = request::post('info', '');
        $header = request::post('header', '');
        $body = request::post('body', '');

        if($info){

            $this->assign('info', unserialize($info));

        }

        if($header){

            $this->assign('headers', unserialize($header));

        }

        if($body){

            $this->assign('body', unserialize($body));

        }

        $this->display('debug/load');

    }

    // 获取接口详情
    public function __call($name, $arguments)
    {

        $id  = id_decode($this->action);

        $api = api::get_api_info($id);

        if(!$api){

            $this->error('该接口不存在');

        }

        $project = api::get_project_info($id);

        // 获取项目环境域名
        $envs    = json_decode($project['envs'], true);

        foreach ($envs as $k => $env) {
            $envs[$k]['name'] = $env['name'];
            $envs[$k]['title'] = $env['title'];
            $envs[$k]['url'] = $env['domain'] . '/' . $api['uri'];
        }

        $encode_id = id_encode($api['id']);

        $mock = [
            'name' => 'mock',
            'title' => '虚拟地址',
            'url' => url("mock/$encode_id", '', true),
        ];

        array_unshift($envs, $mock);

        // 获取请求参数列表
        $request_fields = \app\field::get_field_list($id, 1);

        // 获取header参数列表
        $header_fields = \app\field::get_field_list($id, 3);

        $methods = \app\api::get_method_list();

        $this->assign('api', $api);
        $this->assign('envs', $envs);
        $this->assign('methods', $methods);

        $this->assign('request_fields', $request_fields);
        $this->assign('header_fields', $header_fields);

        $this->display('debug/detail');

    }

}