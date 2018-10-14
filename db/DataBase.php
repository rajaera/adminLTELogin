<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

interface DataBase {

    public function getConnection();//connection
    public function save($table, $attributes = array());//boolean
    public function update($table, $attributes = array());//boolean
    public function getLastInsertedId();//integer
    
            

}
