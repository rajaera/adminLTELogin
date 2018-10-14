<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class LoginForm extends User {

    public function validate() {
        $post_data_val = array_filter(array_values($this->attributes));
        if (!$post_data_val || count($post_data_val) < 2) {
//username or password field has not been filled
            $empty_fields = array();
            foreach ($this->attributes as $key => $value) {
                if (empty($value)) {
                    $empty_fields[] = ucfirst($key);
                }
            }
            
            $this->validation_errors = array(implode(',', $empty_fields) . ' must be provided!');

            return false;
        } else {
            //username and password fields have been fiiled

            $user = User::findByAttributes(array('email' => $this->email));

            if (password_verify($this->password, $user->password)) {
                return true;
            }

            $this->validation_errors = array('email or password is incorrect!');
            return false;
        }
    }

}
