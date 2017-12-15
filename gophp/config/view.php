<?php
//默认视图配置
return [

    'driver'             => 'smarty', //视图驱动

    'smarty' => [
        'template_suffix' => 'html', //模板文件扩展名
        'left_delimiter'  => '{{', //左定界符
        'right_delimiter' => '}}', //右定界符
        'debug_template'     => COMMON_VIEW . '/debug', //DEBUG模板
        '404_template'       => COMMON_VIEW . '/404', //404模板
        'error_template'     => COMMON_VIEW . '/message', //错误消息模板
        'success_template'   => COMMON_VIEW . '/message', //成功消息模板
        'cache_enable'    => false, //是否缓存
        'cache_lifetime'  => 120, //缓存时间，单位秒
        'plugin_path'     => COMMON_PATH . '/smarty',
    ],

    'php' => [
        'template_suffix' => 'php', //模板文件后缀
    ],

];


