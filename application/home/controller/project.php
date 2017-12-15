<?php

namespace app\home\controller;

use app\member;
use gophp\db;
use gophp\helper\number;
use gophp\page;
use gophp\request;
use gophp\response;
use app\user;

class project extends auth {


    public function index()
    {

        response::redirect('project/select');

    }

    /**
     * 选择项目
     */
    public function select()
    {

        $user_id = $this->user_id;

        //创建的项目
        $create_projects = db('project')->show(false)->where('user_id', '=', $user_id)->findAll();

        //参与的项目
        $join_projects  = db('member')->show(false)->where('user_id', '=', $user_id)->findAll();

        $this->assign('create_projects', $create_projects);
        $this->assign('join_projects', $join_projects);

        $this->display('project/select');

    }

    /**
     * 添加/编辑项目
     */
    public function add(){

        if(request::isAjax()){

            $project  = request::post('project', []);
            $env      = request::post('env', []);

            $data = [];

            foreach ($env as $k=>$v){
                foreach ($v as $k1=>$v1){
                    $data[$k1][$k] = trim($v1, '/');
                }
            }

            $project['envs'] = json_encode($data, JSON_UNESCAPED_UNICODE);

            $result = \app\project::add($project);

            response::ajax(['code' => $result['code'], 'msg' => $result['msg']]);

        }else{

            $project_id = get('id', 0);

            $project = \app\project::get_project_info($project_id);

            // 获取项目环境域名
            $envs    = json_decode($project['envs'], true);

            // 获取项目成员
            $members = member::get_member_list($project_id);

            $this->assign('project', $project);
            $this->assign('members', $members);
            $this->assign('envs', $envs);

            $this->display('project/add');

        }

    }

    /**
     * 转让项目
     */
    public function transfer(){

        if(request::isAjax()){


            $project_id = request::post('id', 0);
            $password   = request::post('password', '');
            $user_id    = request::post('user_id', 0);

            if(!user::is_creater($project_id) && !user::is_admin()){

                response::ajax(['code' => 301, 'msg' => '抱歉，您无权转让该项目']);

            }

            if(!$project = \app\project::get_project_info($project_id)){

                response::ajax(['code' => 302, 'msg' => '该项目不存在']);

            }

            if(!user::get_user_info($user_id)){

                response::ajax(['code' => 303, 'msg' => '该用户不存在']);

            }

            if(!user::check_password($password)){

                response::ajax(['code' => 304, 'msg' => '抱歉，密码验证失败!']);

            }

            $result = \app\project::add(['id'=>$project_id,'user_id' => $user_id]);

            if($result !== false){

                response::ajax(['code' => 200, 'msg' => '转让成功!']);

            }else{

                response::ajax(['code' => 500, 'msg' => '转让失败!']);

            }

        }else{

            $project_id = get('id', 0);

            $project = \app\project::get_project_info($project_id);

            // 获取项目成员
            $members = member::get_member_list($project_id);

            $this->assign('project', $project);
            $this->assign('members', $members);

            $this->display('project/transfer');

        }

    }

    /** 
     * 删除项目
     */
    public function delete(){

        $project_id = request::post('id', 0);
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

    /**
     * 退出项目
     */
    public function quit(){

        $project_id = request::post('project_id', 0);
        $user_id    = request::post('user_id', 0);

        if(!$user_id){

            $tip = '退出';

            $user_id = $this->user_id;

        }else{

            $tip = '移除';

        }

        $project = \app\project::get_project_info($project_id);

        if(!$project){

            response::ajax(['code' => 301, 'msg' => '请选择要退出的项目!']);

        }

        if(!user::is_joiner($project_id)){

            response::ajax(['code' => 302, 'msg' => '该会员不是该项目的成员!']);

        }

        $result = db('member')->show(false)->where('project_id', '=', $project_id)->where('user_id', '=', $user_id)->delete();

        if($result){

            response::ajax(['code' => 200, 'msg' => $tip . '成功!']);

        }else{

            response::ajax(['code' => 303, 'msg' => $tip . '失败!']);

        }
    }

    /**
     * 搜索项目
     */
    public function search()
    {

        $search = request::get('search', []);

        $db = db::instance();

        $table_suffix = $db->suffix;
        $table_name   = $table_suffix .'project';

        if($title = trim($search['project'])){

            $where = "title like '%{$title}%'";

        }

        if($user = trim($search['user'])){

            $user_sql = 'select id from ' . $table_suffix . 'user where ' .  "(name like '%{$user}%' or email like '%{$user}%') ";

            $user_ids = $db->query($user_sql);

            $user_ids = array_column($user_ids, 'id');

            $where = $where ? $where .= ' and ' : '';

            if($user_ids){

                $where .= "user_id in (" . implode(',', $user_ids) . ')';

            }else{

                $where .= 'user_id in (0)';

            }

        }

        $where = $where ? $where .= ' and ' : '';

        $where .= 'allow_search = 1';

        $where = $where ? ' where ' . $where : '';

        $sql   = "select * from $table_name $where order by id desc";

        $total = count($db->query($sql));

        $pre_rows = 10;

        $page  = new page($total, $pre_rows);

        $projects = $db->show(false)->query($sql, $pre_rows);

        $this->assign('search', $search);
        $this->assign('page', $page);
        $this->assign('projects', $projects);

        $this->display('project/search');

    }

    /**
     * 导出项目
     */
    public function export()
    {

        $id         = request::get('id', '');
        $project_id = id_decode($id);
        $project    = \app\project::get_project_info($project_id);

        if(!$project){
            $this->error('抱歉，要导出的项目不存在');
        }

        $modules   = db('module')->where('project_id', '=', $project_id)->orderBy('id asc')->findAll();

        // 获取项目环境域名
        $envs      = json_decode($project['envs'], true);

        $file_name = $project['title'] . '接口离线文档.html';

        header ("Content-Type: application/force-download");
        header ("Content-Disposition: attachment;filename=$file_name");

        $this->assign('project', $project);
        $this->assign('modules', $modules);
        $this->assign('envs', $envs);

        $this->display('project/export');

    }

    /**
     * 项目详情
     * @param $id
     * @param $arguments
     */
    public function __call($encode_id, $arguments)
    {
        $tab        = request::get('tab', 'home');

        $project_id = id_decode($encode_id);

        $project    = \app\project::get_project_info($project_id);

        // 判断项目是否存在
        if(!$project){

            $this->error('抱歉，该项目不存在');

        }

        if(!member::has_rule($project_id, 'project', 'look')){

            $this->error('抱歉，您无权查看该项目');

        }

        // 获取项目模块
        $modules = db('module')->where('project_id', '=', $project_id)->findAll();

        // 获取项目环境域名
        $envs    = json_decode($project['envs'], true);

        $this->assign('tab', $tab);
        $this->assign('project', $project);
        $this->assign('modules', $modules);
        $this->assign('envs', $envs);

        switch ($tab) {

            case 'member':

                // 获取项目成员，含分页
                $model = db('member')->where('project_id', '=', $project_id);
                $total = $model->show(false)->count();
                $page  = new page($total, 10);
                $model = db('member')->where('project_id', '=', $project_id);
                $members  = $model->page($page)->orderBy('id desc')->findAll();

                $this->assign('members', $members);
                $this->assign('page', $page);
                $this->display('project/member');

                break;

            case 'map':

                // 获取项目数据字典，含分页
                $model = db('db_map')->where('project_id', '=', $project_id);
                $maps  = $model->orderBy('id desc')->findAll();

                $this->assign('maps', $maps);

                $this->display('map/index');
                break;

            case 'history':

                // 项目动态，含分页
                $model = db('project_log')->where('project_id', '=', $project_id);
                $total = $model->show(false)->count();
                $page  = new page($total, 10);
                $model = db('project_log')->where('project_id', '=', $project_id);
                $historys  = $model->page($page)->orderBy('id desc')->findAll();

                $this->assign('historys', $historys);
                $this->assign('page', $page);
                $this->display('project/history');
                break;

            default:

                $this->display('project/home');
                break;

        }

    }

}