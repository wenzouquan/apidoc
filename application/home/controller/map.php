<?php

namespace app\home\controller;

use gophp\request;
use gophp\response;

class map extends auth {


    public function index()
    {

        response::redirect('project/select');

    }

    /**
     * 导出数据字典
     */
    public function export()
    {

        $id         = request::get('id', '');
        $project_id = id_decode($id);
        $project    = \app\project::get_project_info($project_id);

        if(!$project){
            $this->error('抱歉，要导出的项目不存在');
        }

        $maps   = db('db_map')->where('project_id', '=', $project_id)->orderBy('id asc')->findAll();

        $file_name = $project['title'] . '数据字典.html';

        header ("Content-Type: application/force-download");
        header ("Content-Disposition: attachment;filename=$file_name");

        $this->assign('project', $project);
        $this->assign('maps', $maps);

        $this->display('map/export');

    }

    /**
     * 编辑接口
     */
    public function edit()
    {

        $project_id = request::post('id', 0);
        $project    = \app\project::get_project_info($project_id);

        if(!$project){
            $this->error('抱歉，要编辑的项目不存在');
        }

        $maps   = db('db_map')->where('project_id', '=', $project_id)->orderBy('id asc')->findAll();

        $this->assign('project', $project);
        $this->assign('maps', $maps);

        $this->display('map/edit');

    }

    /**
     * 删除数据字典
     */
    public function delete()
    {

        $project_id = request::post('id', 0);
        $password   = request::post('password', '');

        $project = \app\project::get_project_info($project_id);

        if(!$project){

            response::ajax(['code' => 301, 'msg' => '请选择要删除的项目!']);

        }

        if(!\app\user::check_password($password)){

            response::ajax(['code' => 302, 'msg' => '抱歉，密码验证失败!']);

        }

        $result  = db('db_map')->show(false)->where('project_id', '=', $project_id)->delete();

        if($result){

            response::ajax(['code' => 200, 'msg' => '删除成功!']);

        }else{

            response::ajax(['code' => 403, 'msg' => '删除失败!']);

        }

    }

}