<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//include 'ActiveRecord.php';
class User extends ActiveRecord {
    
    public function __construct() {
        parent::__construct();
        $this->primery_key = 'tms_id';
    }
    
    public static function table() {
        return 'tms_user';
    }
    
    public function getPrimaryKey() {
        
        return $this->primery_key;
    }

    public function validate() { 
        if (count($this->attributes) > 0) {

            return true;
        }
        return false;
    }

}
