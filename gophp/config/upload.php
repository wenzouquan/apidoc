<?php
//默认上传配置
return [

    'driver'       => 'local',
    'local'        => [
        'max_size'     => 8,
        'allow_suffix' => 'doc|xls|ppt|txt|zip|rar|jpg|jpeg|png',
        'save_dir'   => 'upload',
        'save_name'  => '',
    ],
    'ftp'          => [
        'max_size'     => 8,
        'allow_suffix' => 'doc|xls|ppt|txt|zip|rar|jpg|jpeg|png',
    ],
    'oss'          => [
        'max_size'     => 8,
        'allow_suffix' => 'doc|xls|ppt|txt|zip|rar|jpg|jpeg|png',
        'oss_access_id'     => 'LTAIrnxN82nPDPMD',
        'oss_access_secret' => '3x5NjbjSqjtMRgGOT71cWr08Ht8HNs',
        'oss_endpoint'      => 'http://oss-cn-shanghai.aliyuncs.com/'
    ],
    'qiniu'        => [],

];


