<?php

namespace gophp;

use gophp\helper\str;
use gophp\traits\driver;
use PDO;

class schema
{

    private $db     = null;
    private $stmt   = null;

    use driver;

    private function __construct()
    {

        $config = config::get(RUNTIME_PATH.'/config/db.php');

        $this->driver = $config['driver'];

        $this->config = $config[$this->driver];

    }

    // 检测连接状态
    public function ping($dbName = null)
    {

        try{

            $dsn = "mysql:host={$this->config['host']};port={$this->config['port']};";

            if($dbName){

                $dsn .= "dbname={$dbName}";

            }

            $this->db = new PDO($dsn, $this->config['user'], $this->config['password']);

            return true;

        }catch (\PDOException $e){

            return false;
        }

    }

    // 连接数据库
    public function connect($dbName = null)
    {

        try{

            $this->ping($dbName);

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true); //使用缓冲查询，仅mysql有效
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, true); //启用预处理语句的模拟
            $this->db->setAttribute(PDO::ATTR_CASE, PDO::CASE_NATURAL); //强制列名小写
            $this->db->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_NATURAL); //指定数据库返回的NULL值在php中对应的数值
            $this->db->setAttribute(PDO::ATTR_AUTOCOMMIT, 1); //开启自动提交

            //设置字符集
            $this->db->exec('SET NAMES ' . $this->config['charset']);

            return $this->db;

        }catch (\PDOException $e){

            throw new exception("mysql connect Error:" . $e->getMessage());
        }

    }

    // 获取所有表
    public function getTables()
    {

        $sql    = 'SHOW TABLES FROM ' . $this->config['name'];

        $this->stmt = $this->query($sql);

        return $this->stmt->fetchAll(PDO::FETCH_COLUMN);

    }

    // 获取表备注
    public function getTableComment($table)
    {

        $db_name    = $this->config['name'];

        $sql = "SELECT table_comment FROM INFORMATION_SCHEMA.TABLES WHERE table_schema = '{$db_name}' 
AND table_name LIKE '{$table}' ";

        $this->stmt = $this->query($sql);

        $table = $this->stmt->fetch(PDO::FETCH_ASSOC);

        return $table['table_comment'];

    }

    // 创建库
    public function createDB($dbName)
    {

        $sql = "create database `{$dbName}`";

        return $this->connect()->query($sql);

    }

    // 删除表
    public function dropTable($table)
    {

        $sql = "DROP TABLE IF EXISTS `$table`";

        $this->stmt = $this->query($sql);

        if($this->stmt->rowCount() !== false){

            return true;

        }

        return false;

    }

    // 获取主键字段
    public function getPK($table)
    {

        $pk  = 'id';

        $sql = "DESC $table";

        $this->stmt = $this->query($sql);

        $fields     = $this->stmt->fetchAll();

        foreach($fields as $field){

            if($field['Key'] == 'PRI'){

                $pk = $field['Field'];

            }

        }

        return $pk;

    }

    // 获取所有字段
    public function getFields($table)
    {

        $sql = 'SHOW COLUMNS FROM ' . $table;

        $this->stmt = $this->query($sql);

        return $this->stmt->fetchAll(PDO::FETCH_COLUMN);

    }

    public function getFieldList($table = '')
    {

        $db_name    = $this->config['name'];

        $sql = <<<EOT
SELECT 
c.table_name, 
c.column_name as field, 
c.ordinal_position as sort, 
c.column_type as type,
c.column_default as default_value,
CASE 
WHEN c.IS_NULLABLE = 'YES' THEN '1' ELSE '0' 
END AS is_null, 

CASE
WHEN c.column_key = 'PRI' THEN '1' ELSE '0' 
END AS is_pk,

c.column_comment as comment
FROM information_schema.columns c, information_schema.tables t
WHERE c.table_schema = t.table_schema
  AND c.table_name   = t.table_name
  AND c.table_schema = "$db_name"
EOT;

        if($table){

            $sql .= " AND c.table_name = '$table'";

        }

        $sql .= ' ORDER BY c.table_name, c.ordinal_position';

        $this->stmt = $this->query($sql);

        $fields     =  $this->stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($fields as $field) {
            $table_name = $field['table_name'];
            unset($field['table_name']);
            $data[$table_name][] = $field;
        }

        return $table ? $data[$table_name] : $data;

    }

    // 获取单个字段信息
    public function getField($table, $field)
    {

        $sql = 'SHOW FULL FIELDS FROM ' . $table;

        $this->stmt = $this->query($sql);

        $fields = $this->stmt->fetchAll(PDO::FETCH_ASSOC);

        $fieldInfo = [];

        foreach ($fields as $k => $v) {

            if($v['Field'] == $field){

                $fieldInfo = $v;

            }

        }

        // 返回字符串键名全为小写的数组
        return array_change_key_case($fieldInfo, CASE_LOWER);

    }

    // 删除字段
    public function dropField($table, $field){

        $sql  = "ALTER TABLE `$table` DROP `$field`";

        $this->stmt = $this->query($sql);

        if($this->stmt->rowCount() !== false){

            return true;

        }

        return false;

    }

    // 获取创建表sql语句
    public function getCreateTableSql($table)
    {

        $stmt = $this->query("SHOW CREATE TABLE $table");

        $creat_table =  $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $creat_table[0]['Create Table'];

    }

    // 获取删除表sql语句
    public function getDeleteTableSql($table)
    {

        $sql = "DROP TABLE IF EXISTS `" . $table ."`";

        return $sql;

    }

    // 获取批量插入数据sql语句
    public function getInsertTableSql($table)
    {

        $sql = '';

        $data = $this->query("select * from $table")->fetchAll(\PDO::FETCH_ASSOC);

        if($data){

            $sql .= "INSERT INTO `$table` VALUES ";

            foreach ($data as $k=>$v) {

                $sql .= '('.implode(',', array_map(array($this, 'addQuote'), $v)).'),';

            }
        }

        return trim($sql, ',');

    }

    // 执行原生sql
    public function query($sql)
    {

        try {

            $this->db = $this->connect($this->config['name']);

            $this->stmt = $this->db->query($sql);

        } catch(\PDOException $e) {

            throw new exception($e->getMessage(), $sql);

        }

        return $this->stmt;

    }

    public function version()
    {

        $stmt = $this->connect()->query('select VERSION()');

        $versions =  $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $versions[0]['VERSION()'];

    }

    // 给字符串添加单引号
    private function addQuote($str)
    {

        if(is_numeric($str)){

            return $str;

        }

        return str::quote($str, str::single);

    }

}