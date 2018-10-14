<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//include_once  'DataBase.php';
class PHPDataObject implements DataBase {

    protected $connection;
    protected $last_insert_id;
    private static $instance;

    private function __construct() {
        try {
            //$this->connection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
            $this->connection = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            throw new Exception($ex->getMessage(), 404);
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new PHPDataObject();
        }

        return self::$instance;
    }

    public function getConnection() {
        return $this->connection;
    }

    public function save($table, $attributes = array()) {
        $key_val_arr = array_filter($attributes, array($this, 'filter_empty'));
        $keys_arr = array_keys($key_val_arr);

        $fields = implode(',', $keys_arr);
        $values_arr = array_values($key_val_arr);
        $values = "'" . implode("', '", $values_arr) . "'";



        $sql = "INSERT INTO " . $table . " ($fields)
                VALUES ($values)";
        try {
            $this->connection->exec($sql);
            $this->last_insert_id = $this->connection->lastInsertId();
        } catch (PDOException $ex) {
            throw new Exception($ex->getMessage(), 404);
        }

        return true;
    }

    function filter_empty($var) {
        return !empty(trim($var));
    }

    public function getLastInsertedId() {
        return $this->last_insert_id;
    }

    

    public function update($table, $attributes = array()) {
        
    }

    public static function find($id, $table) {

        $connection = self::$instance->getConnection();

        try {

            $rs = $connection->query("SELECT * FROM $table LIMIT 0");
            for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columns[] = $col['name'];
            }

            $rs = $connection->query("SHOW KEYS FROM $table WHERE Key_name = 'PRIMARY'");

            $row = $rs->fetch(PDO::FETCH_ASSOC);
            $primary_key = $row['Column_name'];


            $stmt = $connection->prepare("SELECT " . implode(',', $columns) . " FROM $table WHERE $primary_key=?");
            $stmt->execute([$id]);

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

    public static function findByAttributes($table, $attr = array()) {

        $connection = self::$instance->getConnection();

        $fields = array_keys($attr);
        $values = array_values($attr);



        try {

            $prepareFields = "";
            $i = 0;
            $len = count($fields);
            foreach ($fields as $key => $val) {
                if ($i == $len - 1) {
                    $prepareFields .= $val . "=?";
                } else {
                    $prepareFields .= $val . "=? AND ";
                }

                $i++;
            }

            $rs = $connection->query("SELECT * FROM $table LIMIT 0");
            for ($i = 0; $i < $rs->columnCount(); $i++) {
                $col = $rs->getColumnMeta($i);
                $columns[] = $col['name'];
            }



            $stmt = $connection->prepare("SELECT " . implode(',', $columns) . " FROM $table WHERE $prepareFields");
            $stmt->execute($values);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $ex) {
            throw new Exception($ex);
        }
    }

}
