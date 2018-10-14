<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//include 'db/DBFactory.php';

class Auth {
    
    

    public static function user() {
        if (isset($_SESSION['pomodoro-user-id'])) {
            return User::find($_SESSION['pomodoro-user-id']);
        }

        return null;
    }

    public static function logout() {

        unset($_SESSION['pomodoro-user-id']);


        return true;
    }

}
