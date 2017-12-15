<?php
namespace app;
/**
 * 无线分类
 * Class category
 * @package app
 */
class category {

    //一维数组
    static public function toLevel($category, $delimiter = '———', $parent_id = 0, $level = 0) {

        $data = [];
        foreach ($category as $v) {
            if ($v['parent_id'] == $parent_id) {
                $v['level'] = $level + 1;
                $v['delimiter'] = str_repeat($delimiter, $level);
                $data[] = $v;
                $data = array_merge($data, self::toLevel($category, $delimiter, $v['id'], $v['level']));
            }
        }

        return $data;

    }

    //组成多维数组
    static public function toTree($category, $name = 'child', $pid = 0){

        $data = array();
        foreach ($category as $v) {
            if ($v['pid'] == $pid) {
                $v[$name] = self::toLevel($category, $name, $v['id']);
                $data[] = $v;
            }
        }

        return $data;
    }
}

?>