<?php
namespace App\helpers;
session_start();

class Session{

    public function __construct(){}

    public function setSession(string $name, array $array){
        $_SESSION[$name] = $array;
    }

    public function unsetSession(string $name){
        unset($_SESSION[$name]);
    }

    public function destroySession(){
        session_destroy();
    }

    public function setSessionError(string $name, string $text){
        $_SESSION[$name] = $text;
    }
}