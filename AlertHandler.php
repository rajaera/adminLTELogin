<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class AlertHandler {

    const ALERT_TYPE_REGISTRATION_ERROR = 'REGISTRATION_ERROR';
    const ALERT_TYPE_LOGIN_ERROR = 'LOGIN_ERROR';

    public static function regAlert($message = '', $alert_type = '') {
        $_SESSION[$alert_type] = $message;  
        
    }
    
    public static function hasAlert($alert_type) {
        return isset($_SESSION[$alert_type])?true:false;
    }

    public static function showAlert($alert_type) {        

        $html = "";
        if (isset($_SESSION[$alert_type])) {

            $errors = explode(',', $_SESSION[$alert_type]);

            $html .= "<ul>";



            foreach ($errors as $key => $value) {
                $html .= "<li>{$value}</li>";
            }

            $html .= "</ul>";
        }

        return $html;
    }
    
    public static function getAlert($alert_type) {
        return $_SESSION[$alert_type];
    }
    
    public  static function clearAlert($alert_type) {
        unset($_SESSION[$alert_type]);
    }

}
