<?php
session_start();
$config = include '../db/config.php';
define('DB_TYPE', $config['type']);
define('DB_HOST', $config['host']);
define('DB_NAME', $config['database']);
define('DB_USERNAME', $config['username']);
define('DB_PASSWORD', $config['password']);
include_once '../db/DataBase.php';
include_once '../db/PHPDataObject.php';
include_once '../db/DBFactory.php';
include_once '../model/ActiveRecord.php';
include_once '../model/User.php';
include_once '../model/RegisterForm.php';
include_once '../AlertHandler.php';

$register = new RegisterForm();
$register->setAttributes($_POST);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!$register->validate()) {

    AlertHandler::regAlert(implode(',', $register->validatation_errors()), AlertHandler::ALERT_TYPE_REGISTRATION_ERROR);

    header("Location: ../register.php"); /* Redirect browser */
    exit();
} else {
    $register->dropAttributes(array('retype_password', 'i_agree'));
    $register->encrypt_password();
    if ($register->save()) {
       
        $_SESSION['reg_user_email'] = $register->email;
        header("Location: ../reg_success.php"); /* Redirect browser */
        exit();
    } else {
        
        AlertHandler::regAlert('Something went wrong! please try again!', AlertHandler::ALERT_TYPE_REGISTRATION_ERROR);

        header("Location: ../register.php"); /* Redirect browser */
        exit();
    }
}




/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

