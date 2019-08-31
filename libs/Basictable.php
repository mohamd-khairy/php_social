<?php

class BasicTable {

    static protected $table_name;
    public $primary_key;
    public $fields = array();

    public function __construct() {
        $db = DatabaseManager::getInstance();
        $this->dbh = $db->dbh;
    }

    protected function getFieldsAsString() {
        $sqlStatment = array();
        foreach ($this->fields as $field) {
            $sqlStatment[] = $field . "='" . $this->$field . "'";
        }
        return implode(',', $sqlStatment);
    }

    protected function getFieldsContent() {
        $sqlStatment = array();
        foreach ($this->fields as $field) {
            if ($field == 'u_password') {
                $sqlStatment[] = $field . "='" . md5($_POST[$field]) . "'";
            } else {
                $sqlStatment[] = $field . "='" . $_POST[$field] . "'";
            }
        }
        return implode(',', $sqlStatment);
    }

    public function delete($primary_key) {

        return $this->dbh->query("delete from " . static::$table_name . " where $this->primary_key = $primary_key ");
    }

    public function delete_special($key, $id) {

        return $this->dbh->query("delete from " . static::$table_name . " where {$key}= '$id'");
    }

    public function create() {
        $this->dbh->exec("insert into " . static::$table_name . " set " . $this->getFieldsContent());
        return $this->dbh->lastInsertId();
    }

    public function insert() {
        $this->dbh->exec("insert into " . static::$table_name . " set " . $this->getFieldsAsString());
        return $this->dbh->lastInsertId();
    }

    public function insertCompose() {
        return $this->dbh->exec("insert into " . static::$table_name . " set " . $this->getFieldsAsString());
    }

    public function update($primary_key) {
        return $this->dbh->exec("update " . static::$table_name . " set " . $this->getFieldsAsString() . " where " . $this->primary_key . "=" . $primary_key);
    }

    public function Edit($primary_key) {
        return $this->dbh->exec("update " . static::$table_name . " set " . $this->getFieldsContent() . " where " . $this->primary_key . "=" . $primary_key);
    }

    static public function getRandom($num = 1) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " ORDER BY RAND() LIMIT $num")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAll($offset = 0) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " limit $offset," . PER_PAGE_COUNT)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAll_limit($offset = 0, $end = 5) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " limit $offset,$end")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData() {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name)->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllData_By_reverse() {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " ORDER BY " . static::$primary . " desc")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function getAllDataby_key_and_value($key, $value) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where  {$key} = '$value' ORDER BY " . static::$primary . " ASC")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_Data_by_id($id) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where " . static::$primary . " = '$id' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function checkUser($e, $p) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where u_email = '{$e}' and u_password = '{$p}' ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_by_id($id) {
        $m = $this->dbh->query("select * from " . static::$table_name . " where $this->primary_key = '$id' ")->fetchAll(PDO::FETCH_CLASS, get_called_class());
        return $m[0];
    }

    static public function getCount() {
        $n = DatabaseManager::getInstance()->dbh->query("select count(*) as count from " . static::$table_name)->fetchAll();
        return $n[0];
    }

    static public function getorderCount($order) {
        $n = DatabaseManager::getInstance()->dbh->query("select sum($order) as sum from " . static::$table_name)->fetchAll();
        return $n[0];
    }

    static public function get_data_by_one_or_two_value($key1, $value1, $key2, $value2) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where $key1 = '$value1' or $key2 = '$value2'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function get_data_by_two_value($key1, $value1, $key2, $value2) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where $key1 = '$value1' and $key2 = '$value2'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function search_with_two_value($key1, $value1, $key2, $value2) {
        if ($value2 == 'all') {
            $key2 = 1;
            $value2 = 1;
        }
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where $key1 like '%$value1%' and $key2 = '$value2'")->fetchAll(PDO::FETCH_ASSOC);
    }

    static public function search($key, $value) {
        return DatabaseManager::getInstance()->dbh->query("select * from " . static::$table_name . " where $key like '%$value%'")->fetchAll(PDO::FETCH_ASSOC);
    }

}
