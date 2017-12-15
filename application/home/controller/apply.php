<?php

namespace app\home\controller;

use app\config;
use app\member;
use app\notify;
use gophp\page;
use gophp\request;
use gophp\response;
use app\user;

class apply extends auth {

    /**
     * 申请加入项目
     */
    public function index()
    {

        $user_id = $this->user_id;

        if(request::isAjax()){

            $project_id = request::post('project_id', 0);

            $project = \app\project::get_project_info($project_id);

            if(!$project){

                response::ajax(['code' => 301, 'msg' => '抱歉，您申请加入的项目不存在']);

            }

            if(user::is_creater($project_id)){

                response::ajax(['code' => 302, 'msg' => '抱歉，您是该项目的创建者，无需加入']);

            }

            if(user::is_joiner($project_id)){

                response::ajax(['code' => 303, 'msg' => '抱歉，您已经是该项目成员']);

            }

            $apply = db('apply')->where('project_id', '=', $project_id)->where('user_id', '=', $user_id)->find();

            if($apply && $apply['status'] == 0){

                response::ajax(['code' => 304, 'msg' => '抱歉，您已经提交加入申请，请耐心等待审核']);

            }

            $data = [
                'project_id' => $project_id,
                'creater_id' => $project['user_id'],
                'user_id'    => $user_id,
                'add_time'   => date('Y-m-d H:i:s'),
            ];

            $result = db('apply')->add($data);

            if($result){

                $notify = [
                    'type' => '申请加入项目',
                    'project_id' => $project_id,
                    'to_user_id' => $project['user_id'],
                    'message' => $project['title'],
                ];

                notify::add($notify);

                response::ajax(['code' => 200, 'msg' => '您的申请已提交成功，请耐心等待项目创建者申请']);

            }else{

                response::ajax(['code' => 303, 'msg' => '抱歉，您的申请提交失败，请重试！']);

            }

        }else{

            $applys = db('apply')->where('creater_id', '=', $user_id)->orderBy('id desc')->findAll();

            $this->assign('applys', $applys);

            $this->display('apply/index');

        }

    }
    
    /**
     * 通过加入项目申请
     */
    public function pass()
    {

        if(request::isAjax()){

            $apply_id = request::post('apply_id', 0);

            $apply = db('apply')->find($apply_id);

            $project_id = $apply['project_id'];
            $user_id    = $apply['user_id'];

            $project    = \app\project::get_project_info($project_id);

            if(!$project){

                response::ajax(['code' => 301, 'msg' => '抱歉，该项目不存在']);

            }

            if(!user::is_creater($project_id)){

                response::ajax(['code' => 302, 'msg' => '抱歉，您无权操作']);

            }

            $result = db('apply')->where('id', '=', $apply_id)->update(['status' => 1]);

            if($result !== false){

                $member = [
                    'project_id' => $project_id,
                    'user_id'    => $user_id,
                    'project_rule' => 'look',
                    'module_rule'  => 'look',
                    'api_rule'    => 'look',
                    'member_rule' => 'look',
                    'add_time'    => date('Y-m-d H:i:s'),
                ];

                member::add($member);

                $notify = [
                    'type' => '同意您加入项目',
                    'project_id' => $project_id,
                    'to_user_id' => $user_id,
                    'message' => $project['title'],
                ];

                notify::add($notify);

                response::ajax(['code' => 200, 'msg' => '申请通过']);

            }else{

                response::ajax(['code' => 200, 'msg' => '操作失败']);

            }
        }

    }

}