<?php

// 定义文件分隔符
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

// 定义框架目录
defined('GOPHP_PATH') or define('GOPHP_PATH',dirname(dirname(__FILE__)));

// 定义框架版本
defined('GOPHP_VERSION') or define('GOPHP_VERSION', '1.0.8');

// 定义框架类库目录
defined('GOPHP_LIB') or define('GOPHP_LIB', GOPHP_PATH . DS . 'library');

// 定义框架配置文件目录
defined('GOPHP_CONFIG') or define('GOPHP_CONFIG', GOPHP_PATH . DS . 'config');

// 定义根目录
defined('ROOT_PATH') or define('ROOT_PATH', dirname(GOPHP_PATH));

// 定义应用目录
defined('APP_PATH') or define('APP_PATH', ROOT_PATH . DS . 'application');

// 定义应用运行环境
defined('APP_ENV') or define('APP_ENV', ini_get('app_env') ? ini_get('app_env') : 'develop');

// 定义公共模块目录
defined('COMMON_PATH') or define('COMMON_PATH', APP_PATH . DS . 'common');

// 定义公共配置文件目录
defined('COMMON_CONFIG') or define('COMMON_CONFIG', COMMON_PATH . DS . 'config');

// 定义公共类库目录
defined('COMMON_LIB') or define('COMMON_LIB', COMMON_PATH . DS . 'library');

// 定义公共过滤器目录
defined('COMMON_FILTER') or define('COMMON_FILTER', COMMON_PATH . DS . 'filter');

// 定义公共视图目录
defined('COMMON_VIEW') or define('COMMON_VIEW', COMMON_PATH . DS . 'view');

// 定义vendor目录
defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . DS . 'vendor');

// 定义runtime文件目录
defined('RUNTIME_PATH') or define('RUNTIME_PATH', ROOT_PATH . DS . 'runtime');

// 定义日志目录
defined('LOG_PATH') or define('LOG_PATH', RUNTIME_PATH . DS . 'log');

// 定义web访问目录
defined('WEB_PATH') or define('WEB_PATH', ROOT_PATH . DS . 'public');

// 定义静态资源目录
defined('STATIC_PATH') or define('STATIC_PATH', WEB_PATH . DS . 'static');

// 定义文件上传目录
defined('UPLOAD_PATH') or define('UPLOAD_PATH', WEB_PATH . DS . 'upload');

// 定义错误调试变量
defined('DEBUG_PARAM') or define('DEBUG_PARAM', 'debug');

// 定义缓存变量
defined('CACHE_PARAM') or define('CACHE_PARAM', 'cache');

// 定义默认模块
defined('DEFAULT_MODULE') or define('DEFAULT_MODULE', 'home');


