<?php

namespace gophp;

use gophp\helper\dir;
use gophp\traits\call;

class route
{

    private $config;
    private $module;     //当前模块名
    private $controller; //当前控制器名
    private $action;     //当前方法名
    private $handler;    //当前控制器实例化句柄

    use call;

    // 初始化
    private function __construct()
    {

        $this->config = config::get('http');

        if(request::isCLI()){

            if(!defined('MODULE_NAME') || !defined('CONTROLLER_NAME') || !defined('ACTION_NAME')){

                response::cli('cli模式必须绑定模块、控制器和方法','error');

            }

        }else{

            $uriParam = $this->config['uri_param'];

            $urlParse = $this->parse(request::get($uriParam));

            defined('MODULE_NAME') or define('MODULE_NAME',     $urlParse['module']); //定义当前模块名常量
            defined('CONTROLLER_NAME') or define('CONTROLLER_NAME', $urlParse['controller']); //定义当前控制器名常量
            defined('ACTION_NAME') or define('ACTION_NAME',     $urlParse['action']); //定义当前方法名常量

        }

        $this->module     = MODULE_NAME;
        $this->controller = CONTROLLER_NAME;
        $this->action     = ACTION_NAME;

        define('MODULE_PATH',     APP_PATH. '/' . MODULE_NAME); //定义当前模块目录常量
        define('CONTROLLER_PATH', MODULE_PATH . '/controller'); //定义当前模块控制器目录常量
        define('MODEL_PATH',      MODULE_PATH . '/model'); //定义当前模块模型目录常量
        define('VIEW_PATH',       MODULE_PATH . '/view'); //定义当前模块视图目录常量
        define('CONFIG_PATH',     MODULE_PATH . '/config'); //定义当前模块配置目录常量
        define('FILTER_PATH',     MODULE_PATH . '/filter'); //定义当前模块过滤器目录常量

    }

    // URL解析
    private function parse($uri)
    {

        $defaultModule     = $this->config['default_module']; // 默认模块
        $defaultController = $this->config['default_controller']; // 默认控制器名
        $defaultAction     = $this->config['default_action']; // 默认方法名

        $module      = $defaultModule;
        $controller  = $defaultController;
        $action      = $defaultAction;

        // 获取所有模块
        $allowModule = dir::getSubDir(APP_PATH);

        // 排除公共模块
        unset($allowModule[array_search("common", $allowModule)]);

        $baseUri = explode('.', $uri)[0];

        $urlInfo = array_filter(explode( '/', $baseUri));

        // 重建索引
        $urlInfo = array_values($urlInfo);

        switch (count($urlInfo)) {

            case 0:

                break;

            case 1:

                if(in_array($urlInfo[0], $allowModule) && $urlInfo[0] != $defaultModule){

                    $module     = $urlInfo[0];

                }else{

                    $controller = $urlInfo[0];

                }

                break;

            case 2:

                if(in_array($urlInfo[0], $allowModule) && $urlInfo[0] != $defaultModule){

                    $module     = $urlInfo[0];
                    $controller = $urlInfo[1];

                }else{

                    $controller = $urlInfo[0];
                    $action     = $urlInfo[1];

                }

                break;

            case 3:

                if(in_array($urlInfo[0], $allowModule) && $urlInfo[0] != $defaultModule){

                    $module     = $urlInfo[0];
                    $controller = $urlInfo[1];
                    $action     = $urlInfo[2];

                }

                break;

            default:

                if(in_array($urlInfo[0], $allowModule) && $urlInfo[0] != $defaultModule){

                    $module     = array_shift($urlInfo);
                    $action     = array_pop($urlInfo);
                    $controller = implode('\\', $urlInfo);

                }else{

                    $action     = array_pop($urlInfo);
                    $controller = implode('\\', $urlInfo);

                }

                break;

        }

        return [
            'module'     => $module,
            'controller' => $controller,
            'action'     => $action,
        ];

    }

    // URL分发
    protected function dispatch()
    {

        // 拼装完整控制器类名
        $fullController  = app::$namespace. '\\' . $this->module . '\\' . 'controller\\' . $this->controller;

        // 拼装完整空控制器类名
        $emptyController = app::$namespace. '\\' . $this->module . '\\' . 'controller\\call';

        if(!class_exists($fullController) && class_exists($emptyController)){

            $fullController = $emptyController;

        }elseif(!class_exists($fullController)){

            throw new exception('Controller ' . $fullController . ' not exist');

        }

        if(!method_exists($fullController, $this->action) && !method_exists($fullController, '__call')){

            throw new exception( 'Method ' . $this->action . ' not exist');

        }

        // 执行全局过滤器
        filter::globals();

        // 执行模块过滤器
        filter::module();

        // 单例模式实例化控制器
        if (!($this->handler)) {

            $this->handler = new $fullController();

        }

        // 执行控制方法
        return call_user_func([$this->handler, $this->action]);

    }

    // URL生成
    protected function url($uri = null, $arguments = [], $isAbsolute = false, $extension = null)
    {

        $defaultModule     = $this->config['default_module'];
        $defaultController = $this->config['default_controller'];
        $defaultAction     = $this->config['default_action'];
        $uriParam          = $this->config['uri_param'];

        if($arguments && is_array($arguments)){

            $arguments = array_merge(request::get(), $arguments);
            unset($arguments[$uriParam]);

        }

        $uriInfo = array_filter(explode('/', $uri));
        $uriInfo = array_values($uriInfo);

        switch (count($uriInfo)) {

            case 0:

                break;

            case 1:

                $module     = $defaultModule;
                $controller = $uriInfo[0];
                $action     = $defaultAction;

                break;

            case 2:

                $module     = $defaultModule;
                $controller = $uriInfo[0];
                $action     = $uriInfo[1];

                break;

            case 3:

                $module     = $uriInfo[0];
                $controller = $uriInfo[1];
                $action     = $uriInfo[2];

                break;

        }

        $route = [
            'module'     => $module,
            'controller' => $controller,
            'action'     => $action,
        ];

        $siteUrl   = $isAbsolute ? request::getDomain().'/': '/';
        $extension = $extension ? $extension : $this->config['default_extension'];
        $urlQuery  = http_build_query($arguments);

        if($module == $defaultModule){

            unset($route['module']);

        }

        if($action == $defaultAction){

            unset($route['action']);
        }

        if ($controller == $defaultController && $action == $defaultAction) {

            unset($route['controller']);

        }

        if ($module == $defaultModule && $controller == $defaultController && $action == $defaultAction){

            unset($route);

        }

        if(!$uri){

            $urlPath = request::getPath();

            //去掉后缀
            $urlPath = explode('.', $urlPath)[0];



        }elseif($uri = implode('/', $route)){

            $urlPath = $uri;

        }else{

            $urlPath = '';

        }

        $urlPath = trim($urlPath, '/');

        if($urlPath){

            $url = $siteUrl . $urlPath . '.' . $extension;

        }else{

            $url = $siteUrl;

        }

        if(strpos($urlPath, '?') !== false){

            return $url .'&'. $urlQuery;

        }elseif($urlQuery){

            return $url .'?'. $urlQuery;

        }else{

            return $url;

        }

    }

}
