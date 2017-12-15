<?php

namespace app;

class config {

    public static function get_config_value($config_name = null){

        $config = db('config')->value('config');

        $config = json_decode($config, true);

        if($config_name == 'copyright'){

            return $config[$config_name] . '  由<a target="_blank" href="http://www.phprap.com">PHPRAP</a>强力驱动';

        }

        return $config_name ? $config[$config_name] : $config;

    }

    public static function get_project_config($field = null)
    {

        $project_config = config('project');

        return $field ? $project_config[$field] : $project_config;

    }


}