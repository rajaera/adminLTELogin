<?php

class RegisterForm extends User{
    
        
    public function validate() {
        $post_data_val = array_filter(array_values($this->attributes));
        if (!$post_data_val || count($post_data_val) < 4) {
            //username or password field has not been filled
            $empty_fields = array();
            foreach ($this->attributes as $key => $value) {
                if (empty($value)) {
                    $empty_fields[] = ucfirst($key);
                }
            }

            $this->validation_errors = array('Please fill all required fields!');

            return false;
        } else {
            
            
            //username and password fields have been fiiled

            $user = User::findByAttributes(array('email' => $this->email));

            if ($user) {
                $this->validation_errors = array("Email [{$user->email}] already registered!");
                return false;
            }
            
            if($this->password !== $this->retype_password){
                $this->validation_errors = array("Password and retyped passwords are not matched!");
                return false;
            }

            
            return true;
        }
    }
    
    public function encrypt_password() {
        $this->attributes['password'] = password_hash($this->attributes['password'], PASSWORD_DEFAULT);
    }
}
