<?php
//默认HTTP配置
return [

    'uri_param'          => 'r',
    'page_param'         => 'p', // 分页参数
    'default_module'     => DEFAULT_MODULE,  //默认模块
    'default_controller' => 'index', //默认控制器
    'default_action'     => 'index', //默认方法
    'default_extension'  => 'html',  //默认后缀
    'allow_extension'    => ['html', 'json', 'php'], //允许访问后缀

];
