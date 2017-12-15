<?php

namespace gophp;

use gophp\helper\file;

class filter
{

    // 全局过滤器
    public static function globals()
    {

        return self::handler('globals');

    }

    // 模块过滤器
    public static function module()
    {

        return self::handler('module');

    }

    // 控制器过滤器
    public static function controller($filter, array $only = [], array $except = [])
    {

        // 加载过滤器
        self::load($filter);

        // 拼装过滤器的命名空间
        $namespace = app::$namespace. '\\' .MODULE_NAME. '\\filter\\';
        // 拼装完整的过滤器类名
        $filter  = $namespace . $filter;
        // 实例化过滤器
        $handler = new $filter();

        if (!method_exists($handler, 'run')) {

            throw new exception('Filter ' . $filter . ' must has run method');

        }

        if(array_filter($only) && !in_array(ACTION_NAME, $only)){

            return true;

        }elseif(array_filter($except) && in_array(ACTION_NAME, $except)){

            return true;

        }

        $result  = $handler->run();

        if($result !== true){

            throw new exception( $result);

        }

        return true;

    }

    // 加载过滤器
    private static function load($filter)
    {

        if(is_file($include = FILTER_PATH . DS . APP_ENV . DS . $filter. '.php')){

            $file = $include;

        }elseif(is_file($include = FILTER_PATH . DS . $filter. '.php')){

            $file = $include;

        }elseif(is_file($include = COMMON_FILTER . DS . APP_ENV . DS . COMMON_FILTER . '.php')){

            $file = $include;

        }elseif(is_file($include = COMMON_FILTER . DS . $filter. '.php')){

            $file = $include;

        }

        return file::load($file);

    }

    private static function handler($type = 'module')
    {

        switch ($type) {

            case 'globals':

                $file = COMMON_CONFIG . DS . 'filter.php';

                if(is_file($file)){

                    $name = 'common';

                    $rule = config::get($file, 'rule');

                }

                break;

            case 'module':

                $file = CONFIG_PATH . DS . 'filter.php';

                if(is_file($file)){

                    $name = MODULE_NAME;

                    $rule = config::get($file, 'rule');

                }

                break;

        }

        if(!$rule){

            return false;
        }

        // 拼装过滤器的命名空间
        $namespace = app::$namespace. "\\{$name}\\filter\\";

        $filters   = explode(',', $rule);

        foreach ($filters as $filter) {

            $filter  = $namespace . $filter;

            $handler = new $filter();

            if (!method_exists($handler, 'run')) {

                throw new exception('Filter ' . $filter . ' must has run method');

            }

            $result  = $handler->run();

            if($result !== true){

                throw new exception($result);

                break;

            }

        }

        return true;

    }

}