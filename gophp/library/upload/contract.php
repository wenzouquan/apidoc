<?php

namespace gophp\upload;

abstract class contract
{

    protected $config;
    protected $error;
    protected $info;

    abstract function file($inputName);

    // 判断是否有文件上传
    public function exist($inputName)
    {

        $uploadInfo = $_FILES[$inputName];

        if(is_uploaded_file($uploadInfo['tmp_name'])){

            return true;

        }else{

            return false;
        }
    }

    protected function check($info)
    {

        if(!in_array($info['suffix'], explode('|', $this->config['allow_suffix']))){

            $this->error = '文件类型不允许上传';
            return false;

        }

        $uploadMaxFileSize = ini_get('upload_max_filesize');
        $postMaxFileSize   = ini_get('post_max_size');

        if($info['size'] >= $uploadMaxFileSize * 1024 * 1024){

            $this->error = '上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值！';
            return false;

        }

        if($info['size'] >= $postMaxFileSize * 1024 * 1024){

            $this->error = '上传的文件超过了 php.ini 中 post_max_size 选项限制的值！';
            return false;

        }

        if($info['size'] >= $this->config['max_size'] * 1024 * 1024){

            $this->error = '上传的文件超过了配置文件里限制的最大值！';
            return false;

        }

        return true;

    }

    // 获取上传文件信息
    public function getInfo()
    {

        return $this->info;

    }

    // 获取错误信息
    public function getError()
    {
        return $this->error;
    }

}