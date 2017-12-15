<?php

namespace app;

use gophp\response;

class module {

    /**
     * 根据模块id获取模块信息
     * @param $user_id
     */
    public static function get_module_info($module_id)
    {

        return db('module')->find($module_id);

    }

    /**
     * 验证字段名是否存在
     * @param $data
     * @param $field_id
     * @return bool
     */
    public static function check_name($data, $field_id)
    {

        $field_id = isset($field_id) ? $field_id : 0;

        $result = db('field')->show(false)->where('api_id', '=', $data['api_id'])->where('name', '=', $data['name'])->where('method', '=', $data['method'])->where('id', 'not in', [$field_id])->find();

        if($result){

            return true;

        }else{

            return false;

        }

    }


    /**
     * 根据字段id获取项目信息
     * @param $field_id
     * @return array
     */
    public static function get_project_info($field_id)
    {

        $module = self::get_module_info($field_id);

        return project::get_project_info($module['project_id']);

    }

    /**
     * 添加/编辑字段
     * @param $data
     */
    public static function add($data)
    {

        if(!$data || !is_array($data)){

            response::ajax(['code' => 300, 'msg' => '缺少必要参数']);

        }

        $field_id = $data['id'] ? $data['id'] : 0;

        $field = self::get_field_info($field_id);

        $api_id     = $data['api_id'] ? $data['api_id'] : 0;

        $api        = api::get_api_info($api_id);

        $module     = _uri('module', $api['module_id']);

        $project_id = $module['project_id'];

        if(!$api){

            response::ajax(['code' => 301, 'msg' => '请选择所属接口']);

        }

        if($data['method'] == 1){

            $type_title = '请求字段';

        }elseif($data['method'] == 2){

            $type_title = '响应字段';

        }

        if($field){
            // 更新
            $result =  db('field')->show(false)->where('id', '=', $field_id)->update($data);

            if($result === false){

                response::ajax(['code' => 303, 'msg' => $type_title .'更新失败']);

            }

            if($field['name'] != $data['name']){

                $log = [
                    'project_id' => $data['id'],
                    'type'       => '更新',
                    'object'     => '项目',
                    'content'    => '将接口<code>' . $api['name'] . '</code>的' . $type_title .'<code>'.$field['name'] .'</code>名字修改为<code>' . $data['name'] . '</code>',
                ];

                log::project($log);
            }

            response::ajax(['code' => 200, 'msg' => $type_title . '更新成功']);

        }else{

            // 新增
            $data['add_time'] = date('Y-m-d H:i:s');

            unset($data['id']);

            $id =  db('field')->show(false)->add($data);

            if(!$id){

                response::ajax(['code' => 500, 'msg' => $type_title . '添加失败']);

            }

            // 记录日志
            $log = [
                'project_id' => $project_id,
                'type'       => '添加',
                'object'     => '接口',
                'content'    => '给接口<code>' . $api['title'] . '</code>新增' . $type_title . '<code>' . $data['name'] . '('.$data['title'].')'. '</code>',
            ];

            log::project($log);

            response::ajax(['code' => 200, 'msg' => $type_title . '添加成功']);

        }

    }

    public static function delete($field_id)
    {

        $field = field::get_field_info($field_id);

        if(!$field){

            response::ajax(['code' => 300, 'msg' => '抱歉，要删除的字段不存在!']);

        }

        if($field['method'] == 1){

            $type_title = '请求字段';

        }elseif($field['method'] == 2){

            $type_title = '响应字段';

        }

        $api     = self::get_api_info($field_id);
        $project = self::get_project_info($field_id);

        $result = db('field')->show(false)->delete($field_id);

        if(!$result){

            response::ajax(['code' => 500, 'msg' => $type_title . '删除失败!']);

        }

        // 记录日志
        $log = [
            'project_id' => $project['id'],
            'type'       => '删除',
            'object'     => '字段',
            'content'    => '删除接口<code>' . $api['title'] . '</code>' . $type_title . '<code>' . $field['name'] . '('.$field['title'].')'. '</code>',
        ];

        log::project($log);

        response::ajax(['code' => 301, 'msg' => $type_title . '删除成功!']);

    }

}