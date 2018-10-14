<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DBFactory{
    public static function getDataBase() {
        if(DB_TYPE === 'mysql'){
            return PHPDataObject::getInstance();
        }
    }
}