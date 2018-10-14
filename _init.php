<?php
session_start();


$config = include 'db/config.php';
define('DB_TYPE', $config['type']);
define('DB_HOST', $config['host']);
define('DB_NAME', $config['database']);
define('DB_USERNAME', $config['username']);
define('DB_PASSWORD', $config['password']);

include_once 'model/ActiveRecord.php';
include_once 'model/User.php';
include_once   'Auth.php';