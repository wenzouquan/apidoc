<?php

namespace app\install\controller;

use gophp\db;
use gophp\request;
use gophp\response;
use gophp\schema;

class step2 extends auth {

    public function index(){

        if(session('step') < 2){

            response::redirect('install/step1');

        }

        if(request::isAjax()){

            $step2 = request::post('step2');
            $step2['charset'] = 'UTF8';

            $db['driver'] = 'mysql';
            $db['mysql']  =  $step2;

            $config_content = "<?php\r\nreturn\n" . var_export($db,true) . "\r\n?>";

            $config_file    = RUNTIME_PATH . '/config/db.php';

            $schema = schema::instance();

            if(file_put_contents($config_file, $config_content) === false){

                response::ajax(['code' => 301, 'msg' => '数据库配置文件写入错误，请检查runtime/config/db.php是否有可写权限']);

            }

            if($schema->ping() === false){

                response::ajax(['code' => 302, 'msg' => '数据库连接失败，请检查数据库配置项']);

            }

            if($schema->ping($step2['name']) === false){

                $schema->createDB($step2['name']) or response::ajax(['code' => 304, 'msg' => "创建数据库{$step2['name']}失败,请检查权限或手动创建"]);

            }

            $require_mysql_version = '5.1.0';

            if(!version_compare($schema->version(), $require_mysql_version, '>=' )){

                response::ajax(['code' => 305, 'msg' => 'MySQL版本不能低于' . $require_mysql_version]);

            }

            session('step', 3);

            response::ajax(['code' => 200, 'msg' => '提交成功']);

        }else{

            session('step', 2);

            $this->display('step2');

        }

    }

}