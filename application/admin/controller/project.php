<?php

namespace app\admin\controller;

use gophp\db;
use gophp\page;
use gophp\request;

class project extends auth {

    public function index()
    {

        $search = request::get('search', []);

        $creater_id = request::get('creater_id', 0);
        $joiner_id  = request::get('joiner_id', 0);

        $db = db::instance();

        $table_suffix = $db->suffix;
        $table_name   = $table_suffix .'project';

        if($creater_id){

            $where = "user_id = $creater_id";

        }

        if($joiner_id){

            $joiner_ids = $db->table('member')->where('user_id', '=', $joiner_id)->column('project_id');

            if($joiner_ids){

                $where .= "id in (" . implode(',', $joiner_ids) . ')';

            }else{

                $where .= "id = 0";

            }

        }

        if($title = trim($search['project'])){

            $where = "title like '%{$title}%'";

        }

        if($user = trim($search['user'])){

            $user_sql = 'select id from ' . $table_suffix . 'user where ' .  "(name like '%{$user}%' or email like '%{$user}%') ";

            $user_ids = $db->show(false)->query($user_sql);

            $user_ids = array_column($user_ids, 'id');

            $where = $where ? $where .= ' and ' : '';

            if($user_ids){

                $where .= "user_id in (" . implode(',', $user_ids) . ')';

            }else{

                $where .= 'user_id in (0)';

            }

        }

        $where = $where ? ' where ' . $where : '';

        $sql   = "select * from $table_name $where order by id desc";

        $total = count($db->show(false)->query($sql));

        $pre_rows = 10;

        $page  = new page($total, $pre_rows);

        $projects = $db->show(false)->query($sql, $pre_rows);

        $this->assign('search', $search);
        $this->assign('page', $page);
        $this->assign('projects', $projects);

        $this->display('project/index');

    }

    /**
     * 删除项目
     */
    public function delete(){

        $project_id = request::post('project_id', 0);
        $password   = request::post('password', '');

        $project    = \app\project::get_project_info($project_id);

        if(!$project){

            response::ajax(['code' => 301, 'msg' => '请选择要删除的项目!']);

        }

        if(!user::check_password($password)){

            response::ajax(['code' => 302, 'msg' => '抱歉，密码验证失败!']);

        }

        if(!user::is_creater($project_id) && !user::is_admin()){

            response::ajax(['code' => 303, 'msg' => '抱歉，您无权删除该项目!']);

        }

        if(\app\project::delete($project_id)){

            response::ajax(['code' => 200, 'msg' => '删除成功!']);

        }else{

            response::ajax(['code' => 403, 'msg' => '删除失败!']);

        }

    }


}