<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//include_once './db/DBFactory.php';

abstract class ActiveRecord {

    protected $db;
    protected $table_name;
    protected $attributes = array();
    protected $validation_errors = array();
    protected $is_new_record = true;
    protected $primery_key = 'id';

    public function __construct() {
        $this->db = DBFactory::getDataBase();
    }

    public final static function model() {
        return get_called_class();
    }
    
    public static function table() {
        return '';
    }

    public static function find($id) {
        $db = DBFactory::getDataBase();



        $modelName = self::model();
        $model = new $modelName;


        $result = $db::find($id, $modelName::table());
        if ($result) {
            foreach ($result as $key => $value) {
                $model->{$key} = $value;
            }
            $model->is_new_record = false;
        } else {
            $model = null;
        }
        return $model;
    }

    public static function findByAttributes($attr = array()) {
        $db = DBFactory::getDataBase();


        $modelName = self::model();
        $model = new $modelName();

        $result = $db::findByAttributes($modelName::table(), $attr);
        if ($result) {
            foreach ($result as $key => $value) {
                $model->{$key} = $value;
            }
            $model->is_new_record = false;
        } else {
            $model = null;
        }
        return $model;
    }

    

//return string

    public function save() {
        if ($this->is_new_record) {
            $this->attributes['created_at'] = date('Y-m-d H:i:s', time());
            $modelName = self::model();
            if ($this->db->save($modelName::table(), $this->attributes)) {
                $this->{$this->primery_key} = $this->db->getLastInsertedId();
                $this->is_new_record = false;
                return true;
            }
        } else {
            $modelName = self::model();
            $this->attributes['updated_at'] = date('Y-m-d H:i:s', time());
            return $this->db->update($modelName::table(), $this->attributes);
        }
    }

    public function setAttributes($post_array) {
        $this->attributes = $post_array;
        foreach ($this->attributes as $key => $value) {
            $this->attributes[$key] = htmlspecialchars($value);
            $this->{$key} = $this->attributes[$key];
        }
    }

    public function dropAttributes($attr_arrr) {
        foreach ($attr_arrr as $key => $value) {
            unset($this->attributes[$value]);
            unset($this->{$value});
        }
    }

    public function unsetAttributes() {
        foreach ($this->attributes as $key => $value) {
            unset($this->{$value});
        }

        unset($this->attributes);
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function validate() {
        if (count($this->attributes) > 0) {

            return true;
        }
        return false;
    }

    public function validatation_errors() {
        return $this->validation_errors;
    }

    public function is_new_record() {
        $this->is_new_record;
    }
    
    public function getPrimaryKey() {
        $this->primery_key;
    }

}
