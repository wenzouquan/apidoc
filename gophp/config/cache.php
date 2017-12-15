<?php
//默认CACHE配置
use gophp\config;

return [

    'driver' => 'redis',

    'redis'  => config::get('redis'),

    'file'   => [
        'save_path' => '',
    ],

    'expire' => 0,

];


