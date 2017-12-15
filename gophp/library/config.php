<?php

namespace gophp;

class config
{

    public static $config = [];

    // 加载配置文件
    public static function load($name)
    {

        if(is_file($name)){

            $includeFile = $name;

        }elseif(is_file($configFile = CONFIG_PATH . DS . APP_ENV . DS . $name. '.php')){

            $includeFile = $configFile;

        }elseif(is_file($configFile = CONFIG_PATH . DS . $name. '.php')){

            $includeFile = $configFile;

        }elseif(is_file($configFile = COMMON_CONFIG . DS . APP_ENV . DS . $name. '.php')){

            $includeFile = $configFile;

        }elseif(is_file($configFile = COMMON_CONFIG . DS . $name. '.php')){

            $includeFile = $configFile;

        }elseif(is_file($configFile = GOPHP_CONFIG . DS . $name. '.php')){

            $includeFile = $configFile;

        }else{

            throw new exception( 'Config file '. $name . ' no exist');

        }

        $key = base64_encode($includeFile);

        if(!isset(self::$config[$key])){

            self::$config[$key] = include $includeFile;

        }

        return self::$config[$key];

    }

    // 获取配置项
    public static function get($name, $key = null)
    {

        $config = self::load($name);

        if(is_array($config) && $key){

            return $config[$key];

        }

        return $config;

    }

    // 获取所有配置信息
    public static function all()
    {

        return self::$config;

    }

}
