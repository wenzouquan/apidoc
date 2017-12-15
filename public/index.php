<?php

// 定义根目录
define('ROOT_PATH', __DIR__ . '/..');

// 定义web访问目录
define('WEB_PATH', ROOT_PATH . '/public');

// 定义应用目录
define('APP_PATH', ROOT_PATH . '/application');

// 定义静态资源目录
define('STATIC_URL', '/static');

define('APP_DEBUG', false);

// 引入核心框架
require ROOT_PATH . '/gophp/init.php';
