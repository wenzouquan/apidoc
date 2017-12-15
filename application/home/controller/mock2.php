<?php

namespace app\home\controller;

use app\api;
use app\field;
use gophp\controller;
use gophp\request;
use gophp\response;

class mock2 extends controller {

    public $id;

    // 获取接口id
    public function __construct()
    {
        try{
             $data=db('doc_api')->where('uri', '=', 'get/list')->find();
            $this->id = $data['id'];
            $api = api::get_api_info($this->id);
            if(!$api){
                response::ajax(['code'=> 500, 'msg' => '该mock接口不存在']);
            }
        }catch(\Exception $e){
             response::ajax(['code'=> 500, 'msg' => $e->getMessage()]);
        }
    
    }

    // 获取接口详情
    public function __call($name, $arguments)
    {

        $api    = api::get_api_info($this->id);

        $request_data  = [];

        if($api['method'] != request::getMethod()){

            response::ajax(['code'=> 300, 'msg' => '非法请求方式[' . request::getMethod() . ']']);

        }

        switch (request::getMethod()) {

            case 'GET':

                $request_data = $_GET;
                unset($request_data['r']);
                break;

            case 'POST':

                $request_data = $_POST;
                break;

            case 'PUT':

                parse_str(file_get_contents('php://input'), $request_data);
                break;
        }

        // 获取请求参数列表
        $request_fields = \app\field::get_field_list($this->id, 1);

        foreach ($request_fields as $k => $request_field) {

            $name  = $request_field['name'];
            $type  = $request_field['type'];
            $value = $request_data[$name];

            if($request_field['is_required'] && $value == ''){

                response::ajax(['code'=> 301+$k, 'msg' => '缺少必要参数' . $name]);

            }

            if($type == 'string' && !is_string($value)){

                response::ajax(['code'=> 301+$k, 'msg' =>  $name . '字段类型必须是' . field::get_type_list($type)]);

            }

            if($type == 'int' && !is_numeric($value)){

                response::ajax(['code'=> 301+$k, 'msg' =>  $name . '字段类型必须是' . field::get_type_list($type)]);

            }

            if($type == 'float' && !is_float((floatval($value)))){

                response::ajax(['code'=> 301+$k, 'msg' =>  $name . '字段类型必须是' . field::get_type_list($type)]);

            }

            if($type == 'boolean' &&  in_array($value, ['true', 'false'])){

                response::ajax(['code'=> 301+$k, 'msg' =>  $name . '字段类型必须是' . field::get_type_list($type)]);

            }

            if($type == 'array' && !is_array($value)){

                response::ajax(['code'=> 301+$k, 'msg' =>  $name . '字段类型必须是' . field::get_type_list($type)]);

            }

            if($type == 'object' && !is_a($value)){

                response::ajax(['code'=> 301+$k, 'msg' =>  $name . '字段类型必须是' . field::get_type_list($type)]);

            }

            if($type == 'null' && !is_null($value)){

                response::ajax(['code'=> 301+$k, 'msg' =>  $name . '字段类型必须是' . field::get_type_list($type)]);

            }

            if($type == 'json' && is_null(json_decode($value))){

                response::ajax(['code'=> 301+$k, 'msg' =>  $name . '字段类型必须是' . field::get_type_list($type)]);

            }

        }

        $mock_data = field::get_mock_data($this->id);

        response::ajax($mock_data);

    }

}