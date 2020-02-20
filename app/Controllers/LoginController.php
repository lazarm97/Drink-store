<?php

    namespace App\Controllers;
    use App\Models\User;
    
    class LoginController{
        private $db;
        
        
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function getUser($email,$password){
            $userModel = new User($this->db);
            return $userModel->getUser($email,$password);
        }
    }