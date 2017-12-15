<?php
/**
 * cache契约
 */
namespace gophp\cache;

abstract class contract
{

    /**
     * 判断指定键是否存在
     * @param $key
     * @return mixed
     */
    abstract public function exists($key);

    /**
     * 获取指定键的值
     * @param $key
     * @param null $default
     * @return mixed
     */
    abstract public function get($key);

    /**
     * 设置指定键的值
     * @param $key
     * @param $value
     * @param int $expire
     * @return mixed
     */
    abstract public function set($key, $value, $expire = 0);

    /**
     * 删除指定键
     * @param $key
     * @return mixed
     */
    abstract public function delete($key);

    /**
     * 删除所有缓存
     * @return mixed
     */
    abstract public function clean();

}