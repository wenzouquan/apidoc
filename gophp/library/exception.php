<?php
/**
 * 异常基类
 * Auth:勾国印
 * Blog:www.gouguoyin.cn
 */

namespace gophp;

class exception extends \Exception
{

    protected $sql;

    public function __construct($message, $sql = '', $code = 0)
    {

        parent::__construct($message, $code);

        $this->sql   = $sql;

    }

    public function getSQL()
    {

        return $this->sql;

    }

}