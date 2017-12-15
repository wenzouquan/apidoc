<?php

namespace gophp;

use gophp\helper\dir;
use gophp\helper\file;

class app
{

    public static $namespace;
    public static $config = [];
    public static $error  = [];

    // 运行应用
    public static function run()
    {

        self::$config    = config::get('app');

        // 获取APP命名空间
        self::$namespace = '\\'.self::$config['app_namespace'];

        // 设定错误和异常处理
        set_error_handler([static::class, "errorHandler"]);
        set_exception_handler([static::class, "exceptionHandler"]);
        register_shutdown_function([static::class, "shutdownHandler"]);

        // 设置页面编码
        date_default_timezone_set(self::$config['default_timezone']);

        // 设置页面编码，这里需要优化下，cli模式下无需设置
        header("Content-type: text/html; charset=".self::$config['default_charset']);

        // 设置X-Powered-By
        header('X-Powered-By:GoPHP V' . GOPHP_VERSION);

        // 路由分发
        route::dispatch();


    }

    // 致命错误捕获
    public static function shutdownHandler()
    {

        if ($e = error_get_last()) {

            switch($e['type']){

                case E_ERROR:
                case E_PARSE:
                case E_CORE_ERROR:
                case E_COMPILE_ERROR:
                case E_USER_ERROR:

                    self::$error['code'] = $e['type'];
                    self::$error['file'] = $e['file'];
                    self::$error['line'] = $e['line'];
                    self::$error['message'] = $e['message'];

                    self::show();

                    break;

            }
        }

    }

    // 自定义错误处理
    public static function errorHandler($errno, $errstr, $errfile, $errline)
    {

        switch ($errno) {

            case E_ERROR:
            case E_PARSE:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:

                self::$error['code']    = $errno;
                self::$error['file']    = $errfile;
                self::$error['line']    = $errline;
                self::$error['message'] = $errstr;

                self::show();

                break;

        }
    }

    // 自定义异常处理
    public function exceptionHandler($e)
    {

        self::$error['code']    =   $e->getCode();
        self::$error['file']    =   $e->getFile();
        self::$error['line']    =   $e->getLine ();
        self::$error['message'] =   $e->getMessage();
        self::$error['trace']   =   $e->getTrace();

        self::show();

    }

    // 错误展示
    public function show()
    {

        $view = view::instance();

        // 获取模板后缀
        $suffix = $view->suffix;

        if(APP_DEBUG){

            $viewFile = $view->config['debug_template'] . '.' . $suffix;

        }else{

            $viewFile = $view->config['404_template'] . '.' . $suffix;

        }

        self::$error['title'] or self::$error['title'] = config::get('app', 'error_message');

        // 写入日志
        $message = 'message:' . self::$error['message'] . ' file:' . self::$error['file'] . ' url:' . request::getUrl(true);

        log::write($message, log::ERROR);

        if(request::isCLI()){

            response::cli($message, 'error');

        }else{

            // 展示错误信息
            $view->assign('error', self::$error);

            $view->display($viewFile);
        }

    }

}