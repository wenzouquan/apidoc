<?php

namespace gophp;

use gophp\helper\file;

class response
{

    public static $statusCode;

    public static $headers = [];

    public static function setStatusCode($code) {

        if ($code < 100 || $code > 599) {

            throw new exception('Http Error', $code . ' is not a valid HTTP return status code');

        }

        $statusCodes = [
            // Informational 1xx
            100 => 'Continue',
            101 => 'Switching Protocols',

            // Success 2xx
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',

            // Redirection 3xx
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',  // 1.1
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            // 306 is deprecated but reserved
            307 => 'Temporary Redirect',

            // Client Error 4xx
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',
            // Server Error 5xx
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            509 => 'Bandwidth Limit Exceeded',
        ];

        self::$statusCode = $code;

        if(isset($statusCode[$code])){

            header( 'HTTP/1.1 ' . $code . ' ' . $statusCodes[$code]);
            header( 'Status:' . $code . ' ' . $statusCodes[$code]);

        }

    }

    public static function getStatusCode()
    {

        return self::$statusCode;

    }

    public static function setHeader($name, $value)
    {

        if(is_array($value)){

            $options = [];

            foreach ($value as $k => $v) {

                if (is_string($k) && ! is_array($v)) {

                    $options[] = $k . '=' . $v;

                } elseif (is_array($v)) {

                    $key       = key($v);
                    $options[] = $key . '=' . $v[$key];

                } elseif (is_numeric($k)) {

                    $options[] = $v;

                }
            }

            $value = implode(', ', $options);

        }

        if(!self::$headers[$name]){

            header($name .':'. $value);

        }

    }

    public static function setContentType($mime, $charset='UTF-8')
    {

        if (!empty($charset)) {

            $mime .= '; charset='. $charset;

        }

        self::setHeader('Content-Type', $mime);

    }

    public static function noCache()
    {

        unset(self::$headers['Cache-control']);

        self::setHeader('Cache-control', ['no-store', 'max-age=0', 'no-cache']);

    }

    // 跳转
    public static function redirect($uri, $refresh = 0)
    {

        if(validate::isUrl($uri)){

            $url = $uri;

        }else{

            $url = route::url($uri);

        }

        header("refresh:$refresh;url=$url");

        exit;

    }

    // 强制下载
    public static function download($file, $name = null)
    {

        if (!file_exists($file)) {

            return false;

        }

        // 获取文件后缀
        $extension = file::getInfo($file, 'extension');

        $filename  = $name ? $name . '.' . $extension : basename($file);

        // http headers
        header('Content-Type: application-x/force-download');
        header("Content-Disposition: attachment; filename= {$filename}");
        header('Content-length: ' . filesize($file));
        header('Pragma: no-cache');

        ob_clean();

        flush();

        readfile($file);

        exit;

    }

    // 视图输出
    public static function view($viewFile, $data = [])
    {

        $view     = view::instance();

        $suffix   = $view->suffix;

        $viewFile = $viewFile . '.' . $suffix;

        $view->assign($data);

        $view->display($viewFile);

        exit;

    }

    // ajax输出
    public static function ajax($data, $type = 'json')
    {

        $type = isset($type) ? strtoupper( $type ) : 'json';

        switch ( $type ) {

            case "XML" :

                header('Content-Type:text/xml; charset=utf-8');

                $ouput = xml_encode($data);

                break;

            case "JSON" :

//                header('Content-Type:application/json; charset=utf-8');

                $ouput = json_encode($data, JSON_UNESCAPED_UNICODE);

                break;

            case "JSONP" :

                header('Content-Type:application/json; charset=utf-8');

                $callback = request::get('callback');

                $ouput = $callback."(".json_encode($data, JSON_UNESCAPED_UNICODE).");";

                break;

            default:

                header('Content-Type:application/json; charset=utf-8');

                $ouput = json_encode($data, JSON_UNESCAPED_UNICODE);

                break;

        }

        exit($ouput);

    }

    // cli输出
    public static function cli($message, $type = null)
    {

        $type = strtolower( trim($type) );

        switch ($type) {

            case "success" : // 成功绿色

                $message = '【success】' . $message;

                $ouput  =  "\033[;36m $message \x1B[0m\n";

                break;

            case "error" : // 错误红色

                $message = '【error】' . $message;

                $ouput   =  "\033[;31m $message \x1B[0m\n";

                break;

            case "warning" : // 警告黄色

                $message = '【warning】' . $message;

                $ouput   =  "\033[;33m $message \x1B[0m\n";

                break;

            case "notice" : // 提示蓝色

                $message = '【notice】' . $message;

                $ouput   =  "\033[;34m $message \x1B[0m\n";

                break;

            default :

                $message = '【error】response::cli($message, $type)方法type参数缺失或错误';

                $ouput   =  "\033[;31m $message \x1B[0m\n";

                break;

        }

        exit($ouput);

    }

}
