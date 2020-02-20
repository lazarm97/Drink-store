<?php

    use App\Controllers\CustomerController;
    use App\Models\DB;

    require_once "../config/config.php";
    require_once "../config/autoload.php";

    $db = new DB(SERVER, DBNAME, USERNAME, PASSWORD);
    $customerController = new CustomerController($db);

    if(isset($_POST['action']) && $_POST['action'] == 'newCustomer'){
        $customerName = $_POST['customerName'];
        $customerAddress = $_POST['customerAddress'];
        $customerPhone = $_POST['customerPhone'];

        $customerNameReg = "/[^\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";
        $customerAddressReg = "/[^\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";
        $customerPhoneReg = "/0?(\+?381[6123456]|0[6123456]{1,3}){1}(([ \/\+_-]{1}\d)+|\d+){1,6}/";

        $greske = [];
        if(!preg_match($customerNameReg,$customerName))   array_push($greske,"Customer name was incorrent!");
        if(!preg_match($customerAddressReg,$customerAddress))   array_push($greske,"Customer address was incorrent!");
        if(!preg_match($customerPhoneReg,$customerPhone))   array_push($greske,"Customer phone was incorrent!");
        
        if(count($greske) > 0){
            http_response_code(500);
            echo json_encode($greske);
        }else{
            $params = [$customerName,$customerAddress,$customerPhone];
            $rez = $customerController->insertCustomer($params);
            if($rez){
                http_response_code(200);
                echo json_encode($customerController->getAll());
            }else{
                http_response_code(500);
                $db->putError("Error while inserting new customer!");
            }
        }
    }

    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $params = $_GET['params'];
        $rez = $customerController->deleteSelectedCustomers($params);
        if($rez > 0){
            http_response_code(200);
            echo json_encode($customerController->getAll());
        }else{
            http_response_code(500);
            $db->putError("Error while deleting customer!");
        }
    }

    if(isset($_GET['action']) && $_GET['action'] == 'getOne'){
        $id = $_GET['id'];
        $rez = $customerController->getOne($id);
        echo json_encode($rez);
    }

    if(isset($_POST['action']) && $_POST['action'] == 'update'){
        $customerName = $_POST['customerName'];
        $customerAddress = $_POST['customerAddress'];
        $customerPhone = $_POST['customerPhone'];
        $id = $_POST['id'];

        $customerNameReg = "/[^\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";
        $customerAddressReg = "/[^\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";
        $customerPhoneReg = "/0?(\+?381[6123456]|0[6123456]{1,3}){1}(([ \/\+_-]{1}\d)+|\d+){1,6}/";

        $greske = [];
        if(!preg_match($customerNameReg,$customerName))   array_push($greske,"Customer name was incorrent!");
        if(!preg_match($customerAddressReg,$customerAddress))   array_push($greske,"Customer address was incorrent!");
        if(!preg_match($customerPhoneReg,$customerPhone))   array_push($greske,"Customer phone was incorrent!");
        
        if(count($greske) > 0){
            http_response_code(500);
            echo json_encode($greske);
        }else{
            $params = [$customerName,$customerAddress,$customerPhone,$id];
            $rez = $customerController->updateCustomer($params);
            if($rez){
                http_response_code(204);
            }else{
                http_response_code(500);
            }
        }
    }