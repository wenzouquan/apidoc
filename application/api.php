<?php

namespace app;

use gophp\response;

class api {

    /**
     * 添加/编辑接口
     * @param $data
     */
    public static function add($post)
    {

        if(!$post || !is_array($post)){

            response::ajax(['code' => 300, 'msg' => '缺少必要参数']);

        }

        $api_id    = $post['id'] ? $post['id'] : 0;

        $module_id = $post['module_id'] ? $post['module_id'] : 0;

        if($module_id){

            $data['module_id'] = $module_id;

        }else{

            response::ajax(['code' => 301, 'msg' => '请选择所属模块']);

        }

        // 检测是否填写接口名
        if($title = $post['title']){

            $data['title'] = $title;

        }else{

            response::ajax(['code' => 302, 'msg' => '接口名称不能为空']);

        }

        // 检测接口名称是否已存在
        $result = db('api')->show(false)->where('module_id', '=', $module_id)->where('title', '=', $title)->where('id', 'not in', [$api_id])->find();

        if($result){

            response::ajax(['code' => 303, 'msg' => '该接口名称已存在']);

        }

        // 检测是否填写接口地址
        if($uri = $post['uri']){

            $data['uri'] = trim($uri, '/');

        }else{

            response::ajax(['code' => 304, 'msg' => '接口地址不能为空']);

        }

        // 检测是否填写接口简介
        if($intro = $post['intro']){

            $data['intro'] = $intro;

        }

        // 接口请求方式
        $data['method']    = $post['method'];
        $data['user_id']   = user::get_user_id();

        $api = api::get_api_info($api_id);

        if($api){
            // 更新
            $result =  db('api')->show(false)->where('id', '=', $api_id)->update($data);

            if($result === false){

                response::ajax(['code' => 303, 'msg' =>  '接口更新失败']);

            }

            $project = self::get_project_info($api_id);

            if($api['title'] != $data['title']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '接口',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的标题修改为<code>' . $data['title'] . '</code>',
                ];

                log::project($log);
            }

            if($api['module_id'] != $data['module_id']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '接口',
                    'content'    => '将接口<code>' . $api['title'] . '</code>由'.'<code>'._uri('module', $api['module_id'], 'title').'</code>移到<code>' . _uri('module', $data['module_id'], 'title') . '</code>',
                ];

                log::project($log);
            }

            if($api['method'] != $data['method']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '接口',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的请求方式由'.'<code>'.$api['method'].'</code>修改为<code>' . $data['method'] . '</code>',
                ];

                log::project($log);
            }

            if($api['uri'] != $data['uri']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '接口',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的请求路径由'.'<code>'.$api['uri'].'</code>修改为<code>' . $data['uri'] . '</code>',
                ];

                log::project($log);
            }

            if($api['intro'] != $data['intro']){

                $log = [
                    'project_id' => $project['id'],
                    'type'       => '更新',
                    'object'     => '接口',
                    'content'    => '将接口<code>' . $api['title'] . '</code>的简介由<code>' . $api['intro'] . '</code>'.'修改为<code>' . $data['intro'] . '</code>',
                ];

                log::project($log);
            }

            response::ajax(['code' => 200, 'msg' =>  '接口更新成功']);

        }else{

            // 新增
            $data['add_time'] = date('Y-m-d H:i:s');
            
            unset($data['id']);
            
            $id =  db('api')->show(false)->add($data);

            if(!$id){

                response::ajax(['code' => 500, 'msg' => '接口添加失败']);

            }

            $project = self::get_project_info($id);

            $module = module::get_module_info($module_id);

            // 记录日志
            $log = [
                'project_id' => $project['id'],
                'type'       => '添加',
                'object'     => '接口',
                'content'    => '给模块<code>' . $module['title'] . '</code>新增接口<code>' . $data['title'] . '</code>',
            ];

            log::project($log);

            response::ajax(['code' => 200, 'msg' => '接口添加成功']);

        }

    }

    /**
     * 根据模块id获取接口列表
     * @param $user_id
     */
    public static function get_api_info($api_id = 0)
    {

        $api_id = $api_id ? $api_id : 0;

        return db('api')->find($api_id);

    }

    /**
     * 根据模块id获取接口列表
     * @param $user_id
     */
    public static function get_api_list($module_id)
    {

        return db('api')->show(false)->where('module_id', '=', $module_id)->findAll();

    }

    public static function get_method_list($method_id = 0)
    {

        $method[1] = 'GET';
        $method[2] = 'POST';
        $method[3] = 'PUT';

        return $method_id ? $method[$method_id] : $method;

    }


    public static function get_project_info($api_id)
    {

        $api = db('api')->find($api_id);

        $module = module::get_module_info($api['module_id']);

        $project = project::get_project_info($module['project_id']);

        return $project;

    }

}
