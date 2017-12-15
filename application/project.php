<?php

namespace app;

use gophp\response;

class project {

    /**
     * 根据项目id获取项目详情
     * @param $user_id
     */
    public static function get_project_info($project_id)
    {

        if(!$project_id){
            return [];
        }

        return db('project')->show(false)->find($project_id);

    }

    /**
     * 根据项目id获取项目成员数
     * @param $user_id
     */
    public static function get_member_num($project_id)
    {

        if(!$project_id){

            return 0;

        }

        return db('member')->show(false)->where('project_id', '=', $project_id)->count();

    }

    /**
     * 根据项目id获取项目模块数
     * @param $user_id
     */
    public static function get_module_num($project_id)
    {

        if(!$project_id){

            return 0;

        }

        return db('module')->show(false)->where('project_id', '=', $project_id)->count();

    }

    /**
     * 根据项目id获取项目接口数
     * @param $user_id
     */
    public static function get_api_num($project_id)
    {

        $project_id = $project_id ? $project_id : 0;

        $module_ids = db('module')->where('project_id', '=', $project_id)->column('id');

        return db('api')->show(false)->where('module_id', 'in', $module_ids)->count();

    }

    /**
     * 检测项目标题是否重复
     * @param $title
     * @param $project_id
     * @return bool
     */
    public static function check_title($title, $project_id)
    {

        $project_id = isset($project_id) ? $project_id : 0;

        $result = db('project')->show(false)->where('title', '=', $title)->where('id', 'not in', [$project_id])->find();

        if($result){

            return true;

        }else{

            return false;

        }

    }

    /**
     * 添加/编辑项目
     * @param $data
     * @return bool
     */
    public static function add($data)
    {

        if(!$data || !is_array($data)){

            response::ajax(['code' => 300, 'msg' => '缺少必要参数']);

        }

        $project_id = $data['id'] ? $data['id'] : 0;

        $project = project::get_project_info($project_id);

        if($project){

            // 判断是否有编辑权限
            if(!member::has_rule($project_id, 'project', 'update')){

                response::ajax(['code' => 301, 'msg' => '抱歉，您没有编辑权限']);

            };

            $data['update_time'] = date('Y-m-d H:i:s');

            //更新操作
            $result =  db('project')->show(false)->where('id', '=', $project['id'])->update($data);

            if($result === false){

                response::ajax(['code' => 302, 'msg' => '项目更新失败']);

            }

            // 记录日志
            if($project['title'] != $data['title']){

                $log = [
                    'project_id' => $data['id'],
                    'type'       => '更新',
                    'object'     => '项目',
                    'content'    => '将项目名<code>' . $project['title'] . '</code>修改为<code>' . $data['title'] . '</code>',
                ];

                log::project($log);
            }

            if($project['intro'] != $data['intro']){

                $log = [
                    'project_id' => $data['id'],
                    'type'       => '更新',
                    'object'     => '项目',
                    'content'    => '将项目描述<code>' . $project['intro'] . '</code>修改为<code>' . $data['intro'] . '</code>',
                ];

                log::project($log);
            }

            if($project['allow_search'] != $data['allow_search']){

                $log = [
                    'project_id' => $data['id'],
                    'type'       => '更新',
                    'object'     => '项目',
                    'content'    => '将项目由<code>' . ($project['allow_search'] ? '允许搜索' : '禁止搜索') . '</code>修改为<code>' . ($data['allow_search'] ? '允许搜索' : '禁止搜索') . '</code>',
                ];

                log::project($log);
            }

            response::ajax(['code' => 200, 'msg' => '项目更新成功']);

        }else{

            if(!$data['title']){

                response::ajax(['code' => 301, 'msg' => '项目标题不能为空']);

            }

            if(self::check_title($data['title'], $project_id)){

                response::ajax(['code' => 302, 'msg' => '该项目名称已存在']);

            }

            if(!$data['intro']){

                response::ajax(['code' => 303, 'msg' => '项目简介不能为空']);

            }

            //新增操作
            $data['user_id']  = user::get_user_id();
            $data['add_time'] = date('Y-m-d H:i:s');

            unset($data['id']);

            $id  = db('project')->show(false)->add($data);

            //记录日志
            $log = [
                'project_id' => $id,
                'type'       => '添加',
                'object'     => '项目',
                'content'    => '新增项目<code>' . $data['title'] . '</code>',
            ];

            log::project($log);

            if($id){

                response::ajax(['code' => 200, 'msg' => '项目添加成功']);

            }else{

                response::ajax(['code' => 304, 'msg' => '项目添加失败']);

            }

        }


    }

    /**
     * 删除项目
     * @param $project_id
     * @return bool
     */
    public static function delete($project_id)
    {

        $project = project::get_project_info($project_id);

        if(!$project){

            return false;

        }

        $result = db('project')->show(false)->delete($project_id);

        if($result){

            return true;

        }else{

            return false;

        }

    }

}