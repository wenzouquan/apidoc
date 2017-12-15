<?php

namespace gophp;

use gophp\helper\file;
use gophp\traits\call;

class log {

    private $config = [];
    private $name;
    private $extension;
    private $path;
    private $file;

    const EMERGENCY = 'emergency';
    const ALERT     = 'alert';
    const CRITICAL  = 'critical';
    const ERROR     = 'error';
    const WARNING   = 'warning';
    const NOTICE    = 'notice';
    const INFO      = 'info';
    const DEBUG     = 'debug';

    use call;

    private function __construct()
    {

        $this->config    = config::get('log');

        if($this->config['format']){

            $this->path  = $this->config['save_path'] . DS . date($this->config['format']);

        }else{

            $this->path  = $this->config['save_path'];

        }

        $this->name      = date('Y-m-d');

        $this->extension = $this->config['extension'];

    }

    // 设置日志保存路径
    protected function path($path)
    {

        is_dir($path) and $this->path = $path;

        return $this;
    }

    // 设置日志文件名
    protected function name($name)
    {

        $info = explode('.', $name);

        if($info[1]){

            $this->name      = $info[0];

            $this->extension = $info[1];

        }elseif($info[0]){

            $this->name = $name;

        }

        return $this;

    }

    // 写入日志
    protected function write($message, $level)
    {

        $this->file = $this->path . DS . $this->name . '.' . $this->extension;

        if($message){

            $message = '【' . $level . '】' . date('Y-m-d H:i:s') . ' --> ' . $message;

            file::create($this->file, $message);

        }

    }

    protected function delete($name, $format = null)
    {

        if($format){

            $format = explode('-', $format);
            $format = implode('/', $format);

        }else{

            $format = date('Y/m/d');

        }

        $path  = $this->config['save_path'] . DS . $format;

        $file = $path . DS . $name . '.' . $this->extension;

        return file::delete($file);

    }

}
