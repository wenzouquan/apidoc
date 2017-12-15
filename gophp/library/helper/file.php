<?php

namespace gophp\helper;

class file
{

    public static $map = [];

    // 获取文件基本信息
    public static function getInfo($file, $field = '')
    {

        $info = [];

        if(!self::exists($file)){

            return false;

        }

        $fileInfo          = new \SplFileInfo($file);

        $info['size']      = $fileInfo->getSize();

        $info['type']      = $fileInfo->getType();

        $info['extension'] = strtolower($fileInfo->getExtension());

        $info['base_path'] = $fileInfo->getPath();

        $info['file_path'] = $fileInfo->getRealPath();

        $info['base_name'] = $fileInfo->getBasename('.'.$fileInfo->getExtension());

        $info['file_name'] = $fileInfo->getFilename();

        $info['group']     = $fileInfo->getGroup();

        $info['owner']     = $fileInfo->getOwner();

        $info['auth']      = $fileInfo->getPerms();

        $info['last_access_time'] = date('Y-m-d H:i:s', $fileInfo->getATime());

        $info['last_modify_time'] = date('Y-m-d H:i:s', $fileInfo->getMTime());

        $info['isExecutable'] = $fileInfo->isExecutable();

        $info['isReadable']   = $fileInfo->isReadable();

        $info['isWritable']   = $fileInfo->isWritable();

        return $field ? $info[$field] : $info;

    }

    public static function getSize($file)
    {

        return self::getInfo($file, 'extension');

    }

    // 判断文件是否存在
    public static function exists($file)
    {

        return file_exists($file);

    }

    // 加载文件
    public static function load($file, $data = null)
    {

        $key = base64_encode($file);

        if(!self::exists($file)){

            return false;

        }

        if(!is_null($data)){

            extract($data, EXTR_OVERWRITE);

        }

        if(!self::$map[$key]){

            self::$map[$key] = $file;

            include $file;

        }

        return true;

    }

    // 创建文件
    public static function create($file, $data = null)
    {

        $str = '';

        if (is_array($data)) {

            foreach ( $data as $k => $v ) {

                $str .= $k . " : " . $v . "  ";

            }

        } else {

            $str = $data . "\r\n";

        }

        $path = dirname($file);

        dir::exists($path) or dir::create($path);

        if(file_put_contents($file, $str, FILE_APPEND)){

            return true;

        }

        return false;

    }

    // 删除文件
    public static function delete($file)
    {

        return self::exists($file) ? unlink($file) : false;

    }

    // 移动文件
    public static function move($oldFile, $newFile)
    {

        return self::exists($oldFile) ? rename($oldFile, $newFile) : false;

    }

    // 复制文件
    public static function copy($oldFile, $newFile)
    {

        return self::exists($oldFile) ? copy($oldFile, $newFile) : false;

    }

}