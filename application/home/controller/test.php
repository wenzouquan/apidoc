<?php

namespace app\home\controller;

use app\category;
use app\china;
use app\id;
use app\notify;
use app\statistics;
use app\tree;
use gophp\backup;
use gophp\config;
use gophp\controller;
use gophp\crypt;
use gophp\curl;
use gophp\db;
use gophp\helper\file;
use gophp\helper\url;
use gophp\reflect;
use gophp\request;
use gophp\schema;
use app;


//ini_set("display_errors", "On");
//error_reporting(E_ALL ^ E_NOTICE);
class test extends controller {

    public function index()
    {

        $project_id = 1;


        // 先清空项目的数据字典表
        $a = demo();



         dump($a);exit;



    }


}