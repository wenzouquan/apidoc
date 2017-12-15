<?php

namespace gophp;

class controller
{

    public $module      = MODULE_NAME; // 当前模块名
    public $controlloer = CONTROLLER_NAME; // 当前控制器名
    public $action      = ACTION_NAME; // 当前方法

    /**
     * @desc 将变量赋值给模板
     * @param $name
     * @param $value
     */
    public function assign($name, $value)
    {

        view::instance()->assign($name, $value);

    }

    /**
     * @desc 展示模板
     * @param null $viewName 模板名或模板完整路径
     */
    public function display($viewName = null)
    {

        view::instance()->display($viewName);

    }

    /**
     * @desc 重定向
     * @param $uri 跳转地址
     * @param int $refresh 延迟跳转时间
     */
    public function redirect($uri, $refresh = 0)
    {

        response::redirect($uri, $refresh);

    }

    /**
     * @desc 成功
     * @param $message 提示信息
     * @param $url 跳转url
     * @param int $time 延迟跳转时间，单位秒
     */
    public function success($msg, $url = '', $time = 1)
    {

        $viewFile = config::get('view', 'error_template');

        if(!$url){

            $url = request::getReffer();

        }

        $message['type']   = 'success';
        $message['content'] = $msg;
        $message['url']     = $url;
        $message['time']    = $time;

        response::view($viewFile, $message);

    }

    /**
     * @desc 失败
     * @param $message 提示信息
     * @param $url 跳转url
     * @param int $time 延迟跳转时间，单位秒
     */
    public function error($msg, $url = '', $time = 3)
    {

        $viewFile = config::get('view', 'error_template');

        if(!$url){

            $url = request::getReffer();

        }

        $message['type']   = 'error';
        $message['content'] = $msg;
        $message['url']     = $url;
        $message['time']    = $time;

        response::view($viewFile, $message);

        $this->display($viewFile);

    }

    /**
     * @desc ajax返回
     * @param array $data
     * @param $type
     */
    public function ajaxReturn($data, $type = 'json')
    {

        return response::ajax($data, $type);

    }

    /**
     * @desc cli命令行返回
     * @param string $message
     * @param $type
     */
    public function cliReturn($message, $type = null)
    {

        response::cli($message, $type);

    }

}
