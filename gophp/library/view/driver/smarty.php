<?php

namespace gophp\view\driver;

use gophp\exception;
use gophp\view\contract;

class smarty extends contract
{

    protected $config;
    protected $view;

    public function __construct($config)
    {

        $this->config = $config;

        $this->view = new \Smarty();

        if(!is_dir(RUNTIME_PATH)){

            mkdir(RUNTIME_PATH, 0777, true);

        }

        $this->view->template_dir    = VIEW_PATH;
        $this->view->cache_dir       = RUNTIME_PATH . '/cache';
        $this->view->compile_dir     = RUNTIME_PATH . '/compile';
        $this->view->left_delimiter  = $this->config['left_delimiter'];
        $this->view->right_delimiter = $this->config['right_delimiter'];
        $this->view->debug_tpl       = $this->config['debug_template'];
        $this->view->force_compile   = true;
        $this->view->caching         = false;
        $this->view->cache_lifetime  = $this->config['cache_lifetime'];

        if(APP_DEBUG){

            // 强制编译
            $this->view->force_compile = true;

        }

        //增加自定义插件目录
        $pluginPath = $this->config['plugin_path'];

        if(is_dir($pluginPath)){

            $this->view->addPluginsDir($pluginPath);

        }

    }

    public function exists($viewFile)
    {

        return $this->view->templateExists($viewFile);

    }

    public function assign($name, $value)
    {

        $this->view->assign($name, $value);

    }

    public function display($viewName = null)
    {

        $viewFile = $this->getViewFile($viewName);

        if($this->exists($viewFile)){

            $this->view->display($viewFile);

        }

    }

}