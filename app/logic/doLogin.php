<?php
    
    use App\Controllers\LoginController;
    use App\Models\DB;

    use  App\helpers\Session;


    require_once "../config/config.php";
    require_once "../config/autoload.php";
    
    $db = new DB(SERVER, DBNAME, USERNAME, PASSWORD);
    $loginController = new LoginController($db);
    $session = new Session();
    
    $email = $_POST["email"];
    $password = $_POST["password"];
    $error = 0;
    if (empty($email)) {
        $error = 1;
        $db->putError("Email is required");
        $session->setSession("ErrorLogin", ["Email is required"]);
      } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $error = 1;
            $db->putError("Invalid email format");
          $session->setSession("ErrorLogin", ["Invalid email format"]);
        }
      }
      if (empty($password)) {
        $error = 1;
        $db->putError("Password is required");
        $session->setSession("ErrorLogin", ["Password is required"]);
      } else {
        if (!preg_match("/(?=.*[A-Z])(?=.*[a-z]).*/",$password)) {
          $error = 1;
            $db->putError("Invalid password format");
          $session->setSession("ErrorLogin", ["Invalid password format"]);
        }
      }

      if($error == 0){
        $user = $loginController->getUser($email,$password);
        if(count($user)==1){
            $session->setSession("User", $user);
            $session->unsetSession("ErrorLogin");
            header("Location:../../index.php?page=orders");
        }else{
            $db->putError("Email or password are incorect!");
            $session->setSession("ErrorLogin", ["Email or password are incorect!"]);
            header("Location:../../index.php");
        }       
      }else{
        header("Location:../../index.php");
      }
