<?php

namespace app;

use gophp\db;
use gophp\response;

class member {

    /**
     * 根据成员id获取成员详情
     * @param $user_id
     */
    public static function get_member_info($member_id)
    {

        if(!$member_id){
            return [];
        }

        return db('member')->show(false)->find($member_id);

    }

    public static function get_member_list($project_id)
    {

        return db('member')->show(false)->where('project_id', '=', $project_id)->orderBy('id desc')->findAll();

    }

    /**
     * 添加/编辑成员
     * @param $data
     * @return bool
     */
    public static function add($data)
    {

        if(!$data || !is_array($data)){

            response::ajax(['code' => 300, 'msg' => '缺少必要参数']);

        }

        $member_id = $data['id'] ? $data['id'] : 0;

        $member  = \app\member::get_member_info($member_id);

        $user    = \app\user::get_user_info($data['user_id']);
        $project = \app\project::get_project_info($data['project_id']);

        if($member){

            //更新操作
            $rule = [
                'project_rule'=> $data['project_rule'],
                'module_rule' => $data['module_rule'],
                'api_rule'    => $data['api_rule'],
                'member_rule' => $data['member_rule'],
                'map_rule'    => $data['map_rule'],
            ];

            $result =  db('member')->show(false)->where('id', '=', $member_id)->update($rule);

            if($result === false){

                response::ajax(['code' => 303, 'msg' => '权限更新失败']);

            }

            //记录日志
            $user_name_email = '<code>'.$user['name'] . '(' . $user['email'] . ')</code>';

            if($member['project_rule'] != $data['project_rule']) {

                $log = [
                    'project_id' => $member['project_id'],
                    'type'       => '更新',
                    'object'     => '权限',
                    'content'    => '将' . $user_name_email . '的项目权限由<code>' . member::get_rules_title($member['project_rule']) . '</code>修改为<code>' . member::get_rules_title($data['project_rule']) . '</code>',
                ];

                log::project($log);
            }

            if($member['module_rule'] != $data['module_rule']) {
                $log = [
                    'project_id' => $member['project_id'],
                    'type'       => '更新',
                    'object'     => '权限',
                    'content'    => '将' . $user_name_email . '的模块权限由<code>' . member::get_rules_title($member['module_rule']) . '</code>修改为<code>' . member::get_rules_title($data['module_rule']) . '</code>',
                ];

                log::project($log);
            }

            if($member['api_rule'] != $data['api_rule']) {
                $log = [
                    'project_id' => $member['project_id'],
                    'type'       => '更新',
                    'object'     => '权限',
                    'content'    => '将' . $user_name_email . '的接口权限由<code>' . member::get_rules_title($member['api_rule']) . '</code>修改为<code>' . member::get_rules_title($data['api_rule']) . '</code>',
                ];

                log::project($log);
            }

            if($member['member_rule'] != $data['member_rule']) {
                $log = [
                    'project_id' => $member['project_id'],
                    'type'       => '更新',
                    'object'     => '权限',
                    'content'    => '将' . $user_name_email . '的成员权限由<code>' . member::get_rules_title($member['member_rule']) . '</code>修改为<code>' . member::get_rules_title($data['member_rule']) . '</code>',
                ];

                log::project($log);
            }

            response::ajax(['code' => 200, 'msg' => '权限更新成功']);

        }else{

            //新增操作
            if(!$user){

                response::ajax(['code' => 301, 'msg' => '该用户不存在']);

            }

            if(!$project){

                response::ajax(['code' => 302, 'msg' => '该项目不存在']);

            }

            $data['add_time'] = date('Y-m-d H:i:s');
            
            unset($data['id']);
            
            $id =  db('member')->show(false)->add($data);

            if(!$id){

                response::ajax(['code' => 303, 'msg' => '成员添加失败']);

            }

            //记录日志
            $user = user::get_user_info($data['user_id']);
            $log = [
                'project_id' => $data['project_id'],
                'type'       => '添加',
                'object'     => '成员',
                'content'    => '新增成员<code>' . $user['name'] .'('. $user['email'] . ')</code>',
            ];

            log::project($log);

            response::ajax(['code' => 200, 'msg' => '成员添加成功']);

        }


    }

    /**
     * 删除成员
     * @param $project_id
     * @return bool
     */
    public static function delete($member_id)
    {

        $member = self::get_member_info($member_id);

        if(!$member){

            response::ajax(['code' => 301, 'msg' => '该成员不存在!']);

        }

        if(!user::is_creater($member['project_id']) && !user::is_admin()){

            response::ajax(['code' => 302, 'msg' => '抱歉，您无权操作!']);

        }

        $result = db('member')->show(false)->delete($member_id);

        if(!$result){

            response::ajax(['code' => 303, 'msg' => '成员移除失败']);

        }

        //记录日志
        $user = user::get_user_info($member['user_id']);
        $log = [
            'project_id' => $member['project_id'],
            'type'       => '移除',
            'object'     => '成员',
            'content'    => '移除成员<code>' . $user['name'] .'('. $user['email'] . ')</code>',
        ];

        log::project($log);

        response::ajax(['code' => 200, 'msg' => '成员移除成功']);

    }

    public static function get_rules_title($rules)
    {

        if(!$rules){

            return '';

        }

        $rule_list = explode(',', $rules);

        $title  = '';

        foreach ($rule_list as $rule){

            if($rule == 'look'){
                $title .= '查看、';
            }
            if($rule == 'update'){
                $title .= '编辑、';
            }
            if($rule == 'delete'){
                $title .= '删除、';
            }
            if($rule == 'remove'){
                $title .= '移除、';
            }
            if($rule == 'transfer'){
                $title .= '转让、';
            }
            if($rule == 'export'){
                $title .= '导出、';
            }
            if($rule == 'import'){
                $title .= '导入、';
            }

        }

        return trim($title, '、');

    }

    /**
     * 判断当前登录用户是否拥有权限
     * @param $project_id //项目id
     * @param $type //权限对象
     * @param $option //操作类型
     * @return bool
     */
    public static function has_rule($project_id, $type, $option)
    {

        $project_id = $project_id ? $project_id : 0;

        if(user::is_admin() || user::is_creater($project_id)){

            return true;

        }

        if(!in_array($type, ['project', 'module', 'api', 'member', 'map'])){

            return false;

        }

        if(!in_array($option, ['look', 'add', 'update', 'remove', 'delete', 'transfer', 'import', 'export'])){

            return false;

        }

        $user_id = user::get_user_id();

        $member  = db('member')->show(false)->where('project_id', '=', $project_id)->where('user_id', '=', $user_id)->find();

        if(!$member){

            return false;

        }

        $rules = explode(',', $member[$type . '_rule']);

        if(in_array($option, $rules)){

            return true;

        }

        return false;

    }

}
