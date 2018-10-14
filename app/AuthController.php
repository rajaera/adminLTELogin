<?php

session_start();
$config = include '../db/config.php';
define('DB_TYPE', $config['type']);
define('DB_HOST', $config['host']);
define('DB_NAME', $config['database']);
define('DB_USERNAME', $config['username']);
define('DB_PASSWORD', $config['password']);
include_once '../db/DataBase.php';
include_once '../db/DBFactory.php';
include_once '../db/PHPDataObject.php';
include_once '../model/ActiveRecord.php';
include_once '../model/User.php';
include_once '../model/LoginForm.php';
include_once '../AlertHandler.php';

$login = new LoginForm();
$login->setAttributes($_POST);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


if (!$login->validate()) {

    

    AlertHandler::regAlert(implode(',', $login->validatation_errors()), AlertHandler::ALERT_TYPE_LOGIN_ERROR);


    header("Location: ../login.php"); /* Redirect browser */
    exit();
} else {
    $user = User::findByAttributes(array('email' => $login->email));
    
    $_SESSION['pomodoro-user-id'] = $user->{$user->getPrimaryKey()};
    header("Location: ../dashboard.php"); /* Redirect browser */
    exit();
}


