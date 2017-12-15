<?php

namespace gophp\view;

abstract class contract
{

    protected $config;

    abstract public function exists($viewFile);

    abstract public function assign($name, $value);

    abstract public function display($viewName);

    public function getViewFile($viewName = null)
    {

        $suffix = $this->config['template_suffix'];

        if(!$viewName){

            $viewName = CONTROLLER_NAME . DS . ACTION_NAME;
            $viewFile = VIEW_PATH . DS . $viewName . '.' . $suffix;

        }elseif($viewName && false === strpos(end(explode('/', $viewName)), '.')){

            // end(explode('/', $viewName)防止$viewName路径里带有/../等
            $viewFile = VIEW_PATH . DS . $viewName . '.' . $suffix;

        }else{

            $viewFile = $viewName;

        }

        return $viewFile;

    }

}