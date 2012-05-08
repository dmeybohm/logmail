<?php

class Logmail_Db {
    protected $db;
    protected $class_prefix = "Logmail_";

    public static function connect($config) {
        if ($config['driver'] === 'sqlite') {
            $dsn = "sqlite:" . $config['db'];
            $pdo = new PDO($dsn);
        } else {
            $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['db']}";
            $pdo = new PDO($dsn, $config['user'], $config['pass']);
        }
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $class = __CLASS__;
        return new $class($pdo);
    }

    public function __construct($db) {
        $this->db = $db;
    }

    public function prepare($sql) {
        return $this->db->prepare($sql);
    }

    public function query($sql) {
        return $this->db->query($sql);
    }

    public function find($table, $conditions=array()) {
    }

    public function get($table, $fields = null) {
        if (empty($fields)) {
            $fields = "*";
        } else if (is_array($fields)) {
            $fields = $this->prepareFields($fields);
        } else {
            throw new Exception("Invalid type for fields: ".get_class($fields));
        }
        $sql = "SELECT {$fields}, '$table' as __table FROM `$table`";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    protected function prepareFields($fields) {
        foreach ($fields as &$field) {
            $fields = "`".addslashes($field)."`";
        }
        return join(",", $fields);
    }

    public function save($obj) {
        if (empty($obj)) {
            throw new Exception("Trying to save empty object");
        }
        $table = $this->getTable($obj);
        $keys = array();
        $vals = array();
        if (isset($obj->id)) {
            $sql = "UPDATE `$table` SET ";
            foreach ($obj as $key => $val) {
                if ($key == 'id') {
                    continue;
                }
                $sql .= "`$key` = :$key";
            }
            $stmt .= " WHERE id = ".$obj->id;
            $stmt = $this->db->prepare($sql);
        } else {
            $sql = "INSERT INTO `$table` (";
            $sql .= join(",", array_map(array($this,'escapekey'), array_keys((array)$obj)));
            $sql .= ") VALUES (";
            $sql .= join(",", array_map(array($this,'escapeval'), array_values((array)$obj)));
            $sql .= ")";
        }
        // add parameters:
        foreach ($obj as $key => $val) {
            $stmt->bindParam(':'.$key, $val);
        }

        $this->db->query($sql);
        if (!isset($obj->id)) {
            $obj->id = $this->db->lastInsertId();
        }
        return $obj->id;
    }

    public function obj($table, $id) {
        return $this->find($table, array('id' => $id));
    }

    protected function getTable($obj) {
        return str_replace($this->class_prefix, '', $obj->__table);
    }

    public function escapekey($key) {
        return "`".$key."`";
    }

    public function escapeval($val) {
        return ':'.$val;
    }
}
