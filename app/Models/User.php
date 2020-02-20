<?php

    namespace App\Models;

    class User {
        private $db;

        public function __construct(DB $db){
            $this->db = $db;
        }

        public function getUser(string $email,string $password){
            $user = $this->db->executeQueryWithParams("select * from users where email = ? and password = MD5(?)",[$email,$password]);
            return $user;
        }
        
    }