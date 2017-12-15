<?php

namespace app\home\controller;

use gophp\request;
use gophp\response;

class member extends auth {

    /**
     * 添加/编辑成员
     */
    public function add(){

        if(request::isPost()){

            $member_id  = request::post('id', 0);
            $user_id    = request::post('user_id', 0);
            $project_id = request::post('project_id', 0);

            $project_rule = request::post('project_rule', []);
            $module_rule  = request::post('module_rule', []);
            $api_rule     = request::post('api_rule', []);
            $member_rule  = request::post('member_rule', []);
            $map_rule     = request::post('map_rule', []);

            $project_rules = implode(',', $project_rule);
            $module_rules  = implode(',', $module_rule);
            $api_rules     = implode(',', $api_rule);
            $member_rules  = implode(',', $member_rule);
            $map_rules     = implode(',', $map_rule);

            $member = [
                'id'          => $member_id,
                'project_rule'=> $project_rules,
                'module_rule' => $module_rules,
                'api_rule'    => $api_rules,
                'member_rule' => $member_rules,
                'map_rule'    => $map_rules,
                'project_id'  => $project_id,
                'user_id'     => $user_id,
            ];

            $result = \app\member::add($member);

            if($result){

                response::ajax(['code' => 200, 'msg' => '操作成功']);

            }else{

                response::ajax(['code' => 303, 'msg' => '操作失败']);

            }

        }else{

            $ids = request::get('id', '');

            list($project_id, $member_id) = explode('-', $ids);

            $member = \app\member::get_member_info($member_id);

            $member['project_id'] = $project_id;

            $member['user'] = \app\user::get_user_info($member['user_id']);

            $project_rules = explode(',', $member['project_rule']);
            $module_rules  = explode(',', $member['module_rule']);
            $api_rules     = explode(',', $member['api_rule']);
            $member_rules  = explode(',', $member['member_rule']);
            $map_rules     = explode(',', $member['map_rule']);

            $this->assign('member', $member);

            $this->assign('project_rules', $project_rules);
            $this->assign('module_rules', $module_rules);
            $this->assign('api_rules', $api_rules);
            $this->assign('member_rules', $member_rules);
            $this->assign('map_rules', $map_rules);

            $this->display('member/add');

        }

    }

    /**
     * 删除成员
     */
    public function delete(){

        $member_id = request::post('member_id', 0);

        $result = \app\member::delete($member_id);

        response::ajax(['code' => $result['code'], 'msg' => $result['msg']]);

    }

}