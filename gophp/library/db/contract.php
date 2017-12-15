<?php

namespace gophp\db;

use gophp\page;

abstract class contract
{

    abstract public function connect();

    abstract public function table($table, $prefix);

    abstract public function find($field);

    abstract public function findAll($field);

    abstract public function page(page $page);

    abstract public function update(array $data);

    abstract public function inc($field, $offset = 1);

    abstract public function dec($field, $offset = 1);

    abstract public function add(array $data);

    abstract public function addAll();

    abstract public function delete($id);

    abstract public function count($field);

    abstract public function max($field);

    abstract public function min($field);

    abstract public function avg($field);

    abstract public function sum($field);

    abstract public function where($field , $expression, $value, $logic = 'AND');

    abstract public function orderBy($order);

    abstract public function limit($offset, $rows = 0);

    abstract public function join($join, $type);

    abstract public function on($on);

    abstract public function show($bool = false);

    public function __destruct()
    {
        $this->db = null;
    }

}