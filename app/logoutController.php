<?php
session_start();

include_once '../Auth.php';

Auth::logout();




session_destroy();
header("Location: ../login.php"); /* Redirect browser */
exit();


