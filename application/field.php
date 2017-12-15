<?php

namespace app;

use gophp\reflect;
use gophp\response;

class field {

    /**
     * 根据模块id获取接口列表
     * @param $user_id
     */
    public static function get_field_info($field_id)
    {

        return db('field')->find($field_id);

    }

    /**
     * 获取字段类型列表
     * @param $type
     * @return mixed
     */
    public static function get_type_list($type = 0)
    {

        $field_type_list = config::get_project_config('field_type');

        return $type ? $field_type_list[$type] : $field_type_list;

    }

    /**
     * 获取接口字段列表
     * @param $api_id //接口id
     * @param $method  //类型，1：请求字段2：响应字段
     * @return array
     */
    public static function get_field_list($api_id, $method = 0)
    {

        $field_list = db('field')->where('api_id', '=', $api_id)->where('method', '=', $method)->orderBy('id asc')->findAll();

        if(!$field_list){
            return [];
        }

        return category::toLevel($field_list, '&nbsp;&nbsp;&nbsp;&nbsp;');

    }

    /**
     * 根据mock规则返回模拟数据
     * @param $rule
     * @return int|null|string
     */
    public static function get_mock_value($rule)
    {

        $data = explode('|', $rule);

        $type = $data[0];

        if(!$type){

            return ;

        }

        $rule = $data[1] ? $data[1] : '';

        $value = $data[2] ? $data[2] : '';

        if(reflect::hasMethod(mock::class, $type)){

            $mock = new mock();

            return $mock->$type($rule, $value);

        }else{

            return false;

        }

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
     * 根据字段id获取接口信息
     * @param $field_id
     * @return array
     */
    public static function get_api_info($field_id)
    {

        $field = self::get_field_info($field_id);

        if(!$field){

            return [];

        }

        return api::get_api_info($field['api_id']);

    }

    /**
     * 根据字段id获取模块信息
     * @param $field_id
     * @return mixed
     */
    public static function get_module_info($field_id)
    {

        $api = self::get_api_info($field_id);

        return _uri('module', $api['module_id']);

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
    public static function add($post)
    {

        if(!$post || !is_array($post)){

            response::ajax(['code' => 300, 'msg' => '缺少必要参数']);

        }

        $field_id = $post['id'] ? $post['id'] : 0;

        $field    = self::get_field_info($field_id);

        if($api = api::get_api_info($post['api_id'])){

            $data['api_id'] = $post['api_id'];

        }else{

            response::ajax(['code' => 301, 'msg' => '请选择所属接口']);

        }

        // 检测是否填写字段名称
        if($name = $post['name']){

            $data['name'] = $name;

        }else{

            response::ajax(['code' => 302, 'msg' => '参数名称不能为空']);

        }

        // 检测是否填写字段标题
        if($title = $post['title']){

            $data['title'] = $title;

        }else{

            response::ajax(['code' => 302, 'msg' => '参数标题不能为空']);

        }

        // 检测是否填写字段类型
        if($type = $post['type']){

            $data['type'] = $type;

        }else{

            response::ajax(['code' => 303, 'msg' => '参数类型不能为空']);

        }

        // 检测是否填写参数方法
        if($method = $post['method']){

            $data['method'] = $method;

        }else{

            response::ajax(['code' => 304, 'msg' => '参数方法不能为空']);

        }

        // 检测字段名称是否已存在
        if(field::check_name(['api_id' => $api['id'], 'name' => $name, 'method' => $method], $field_id)){

            response::ajax(['code' => 305, 'msg' => '该参数名称已存在']);

        }

        // 检测是否填写mock规则
        if($mock = $post['mock']){

            $rule = explode('|', $mock);

            $type = $rule[0];

            if(!$type){

                response::ajax(['code' => 306, 'msg' => '无效的MOCK规则']);

            }

            if(!reflect::hasMethod(mock::class, $type)){

                response::ajax(['code' => 307, 'msg' => '无效的MOCK规则']);

            }

            $data['mock'] = $mock;

        }

        // 检测是否填写字段简介
        if($intro = $post['intro']){

            $data['intro'] = $intro;

        }

        if($post['method'] == 1){

            $type_title = '请求字段';

            $data['default_value'] = isset($post['default_value']) ? $post['default_value'] : '';

        }elseif($post['method'] == 2){

            $type_title = '响应字段';

            $mcok_value = \app\field::get_mock_value($mock);

            $data['default_value'] = $mcok_value ? $mcok_value : '';

        }elseif($post['method'] == 3){

            $type_title = 'header字段';

            $data['default_value'] = $post['default_value'];

        }

        $data['method']      = $post['method'];
        $data['is_required'] = $post['is_required'];
        $data['parent_id'] = $post['parent_id'];
        $data['user_id']   = user::get_user_id();

        if($field){
            // 更新
            $result =  db('field')->show(false)->where('id', '=', $field_id)->update($data);

            if($result === false){

                response::ajax(['code' => 303, 'msg' => $type_title .'更新失败']);

            }

            $project = self::get_project_info($field_id);

            if($field['name'] != $data['name']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '字段',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的' . $type_title .'<code>'.$field['name'] .'</code>名字修改为<code>' . $data['name'] . '</code>',
                ];

                log::project($log);
            }

            if($field['mock'] != $data['mock']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '字段',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的' . $type_title .'<code>'.$field['name'] .'</code>的MOCK规则由'.'<code>' . $field['mock'] . '</code>'.'修改为<code>' . $data['mock'] . '</code>',
                ];

                log::project($log);
            }

            if($field['title'] != $data['title']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '字段',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的' . $type_title .'<code>'.$field['title'] .'</code>标题修改为<code>' . $data['title'] . '</code>',
                ];

                log::project($log);
            }

            if($data['method'] == 3 && $field['default_value'] != $data['default_value']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '字段',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的' . $type_title .'<code>'.$field['name'] .'</code>的值由'.'<code>' . $field['default_value'] . '</code>'.'修改为<code>' . $data['default_value'] . '</code>',
                ];

                log::project($log);
            }

            if($field['intro'] != $data['intro']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '字段',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的' . $type_title .'<code>'.$field['name'] .'</code>的简介由'.'<code>' . $field['intro'] . '</code>'.'修改为<code>' . $data['intro'] . '</code>',
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

            $project = self::get_project_info($id);

            if($post['method'] == 3){

                $log_content = '给接口<code>' . $api['title'] . '</code>新增' . $type_title . '<code>' . $data['name'] . '</code>,字段值为<code>'. $data['default_value']. '</code>';

            }else{

                $log_content = '给接口<code>' . $api['title'] . '</code>新增' . $type_title . '<code>' . $data['name'] . '('.$data['title'].')'. '</code>';

            }

            // 记录日志
            $log = [
                'project_id' => $project['id'],
                'type'       => '添加',
                'object'     => '字段',
                'content'    => $log_content,
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

        }elseif($field['method'] == 3){

            $type_title = 'header字段';

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

        response::ajax(['code' => 200, 'msg' => $type_title . '删除成功!']);

    }

    /**
     * 获取响应字段默认值数组
     * @param int $parend_id
     * @return mixed
     */
    public static function get_default_data($api_id, $parend_id=0)
    {

        $fields = \db('field')->where('method', '=', 2)->where('api_id', '=', $api_id)->where('parent_id', '=', $parend_id)->findAll();

        foreach ($fields as $k => $v){

            $name = $v['name'];

            if($v['type'] == 'array'){

                $data[$name][] = self::get_default_data($api_id, $v['id']);

            }else if($v['type'] == 'object'){

                $data[$name] = self::get_default_data($api_id, $v['id']);

            }else{

                $data[$name] = $v['default_value'];

            }
        }

        return $data;

    }

    /**
     * 获取响应字段mock数组
     * @param int $parend_id
     * @return mixed
     */
    public static function get_mock_data($api_id, $parend_id=0)
    {

        $api_id = $api_id ? $api_id : 0;

        $fields = \db('field')->where('method', '=', 2)->where('api_id', '=', $api_id)->where('parent_id', '=', $parend_id)->findAll();

        foreach ($fields as $k => $v){

            $name = $v['name'];

            if($v['type'] == 'array'){

                $value = self::get_mock_data($api_id, $v['id']);

                $data[$name][] = $value ? $value : array();

            }if($v['type'] == 'object'){

                $value = self::get_mock_data($api_id, $v['id']);

                $data[$name] = $value ? $value : (object)array();

            }else{

                $v['mock'] and $value = field::get_mock_value($v['mock']);

                $data[$name] = $value;

            }
        }

        return $data;

    }

}
