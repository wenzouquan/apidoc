<?php

namespace gophp;

use gophp\helper\file;
use gophp\traits\call;
use PDO;

class backup
{

    private $db     = null;
    private $stmt   = null;
    private $schema = null;
    private $config = [];
    private $savePath;

    use call;

    private function __construct()
    {

        $this->db = db::instance()->connect();
        $config   = config::get('db');
        $driver   = $config['driver'];

        $this->schema = schema::instance();

        $this->savePath = RUNTIME_PATH . '/data';

        $this->config = $config[$driver];

    }

    // 备份数据库
    public function backup()
    {
        $sql = '';
        $tables = $this->schema->getTables();

        foreach ($tables as $table) {
            // 如果存在则删除表
            $sql .= "DROP TABLE IF EXISTS `" . $table . '`;\n';

            $file = $this->savePath . '/all.sql';

            file::create($file, $sql);

        }

        dump($sql);

    }

    // 还原数据库
    public function getTableComment($table)
    {

        $db_name    = $this->config['name'];

        $sql = "SELECT table_comment FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '{$db_name}' 
AND table_name LIKE '{$table}' ";

        $this->stmt = $this->query($sql);

        $table = $this->stmt->fetch(PDO::FETCH_ASSOC);

        return $table['table_comment'];

    }



    // 执行原生sql
    private function query($sql)
    {

        try {

            $this->stmt = $this->db->query($sql);

        } catch(\PDOException $e) {

            throw new exception($e->getMessage(), $sql);

        }

        return $this->stmt;

    }

}