<?php

namespace gophp\traits;

trait instance
{

    private static $instance = null;

    // 获取单例
    final public static function instance()
    {

        if (!(self::$instance instanceof self)) {

            self::$instance = new static();

        }

        return self::$instance;

    }

    // 禁止克隆
    private function __clone()
    {

    }

}