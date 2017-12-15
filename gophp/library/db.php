<?php

namespace gophp;

use gophp\db\contract;
use gophp\traits\driver;
use gophp\helper\str;

class db extends contract
{

    public $config;
    public $driver;
    public $handler;
    public $suffix;

    use driver;

    private function __construct()
    {

        $config = config::get(RUNTIME_PATH.'/config/db.php');

        $this->driver = $config['driver'];

        $this->config = $config[$this->driver];

        $this->suffix = $this->config['prefix'];

    }


    public function connect()
    {

        $driver = self::class . '\\driver\\' . $this->driver;

        if(!class_exists($driver)){

            $className = reflect::getName(self::class);

            throw new exception( ucfirst($className) . ' driver ' . str::quote($this->driver) . ' not exist');

        }

        $this->handler = $this->handler();

        return $this->handler->connect();

    }

    public function table($table, $prefix = null)
    {

        $this->connect();

        $method = __FUNCTION__;

        $this->handler->$method($table, $prefix);

        return $this;
    }

    public function where($field , $expression, $value, $logic = 'AND')
    {

        $method = __FUNCTION__;

        $this->handler->$method($field , $expression, $value, $logic);

        return $this;

    }

    public function order($order)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($order);

    }

    public function limit($offset, $rows = 0)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($offset, $rows);

    }

    public function join($join, $type = 'inner')
    {

        $method = __FUNCTION__;

        return $this->handler->$method($join, $type);

    }

    public function on($on)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($on);

    }

    public function show($bool = false)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($bool);

    }

    public function query($sql)
    {

        $this->connect();

        $method = __FUNCTION__;

        $this->handler->$method($sql);

        return $this;

    }

    public function find($field = '*')
    {

        $method = __FUNCTION__;

        return $this->handler->$method($field);

    }

    public function column($field)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($field);

    }

    public function value($field)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($field);

    }

    public function findAll($field = '*')
    {

        $method = __FUNCTION__;

        return $this->handler->$method($field);

    }

    public function select($field)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($field);

    }

    public function page(page $page)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($page);

    }

    public function update(array $data)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($data);
    }

    public function inc($field, $offset = 1)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($field, $offset);
    }

    public function dec($field, $offset = 1)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($field, $offset);

    }

    public function add(array $data)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($data);

    }


    public function addAll()
    {

        $method = __FUNCTION__;

        return $this->handler->$method();

    }

    public function delete($id = null)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($id);

    }

    public function count($field = '*')
    {

        $method = __FUNCTION__;

        return $this->handler->$method($field);

    }

    public function max($field)
    {

    }

    public function min($field)
    {

    }

    public function avg($field)
    {

    }

    public function sum($field)
    {

    }

    public function orderBy($order)
    {

        $method = __FUNCTION__;

        return $this->handler->$method($order);

    }

    public function beginTransaction(){

        $method = __FUNCTION__;

        return $this->handler->$method();
    }

    public function commit(){

        $method = __FUNCTION__;

        return $this->handler->$method();
    }

    public function rollBack(){

        $method = __FUNCTION__;

        return $this->handler->$method();
    }


}
