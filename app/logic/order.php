<?php

    use App\Controllers\OrderController;
    use App\Models\DB;
    session_start();

    require_once "../config/config.php";
    require_once "../config/autoload.php";

    $db = new DB(SERVER, DBNAME, USERNAME, PASSWORD);
    $orderController = new OrderController($db);
    $customerRole = $_SESSION['User'][0]->roleId;

    if(isset($_GET['action']) && $_GET['action'] == 'delivered'){
        $params = $_GET['params'];
        $customerId = $_SESSION['User'][0]->customerId;
        $rez = $orderController->updateDeliveredOrders($params);
        if($rez >= 1){
            http_response_code(200);
            if($customerRole == 1) echo json_encode($orderController->getAllOrdersForSelectedCustomer($customerId));
            else echo json_encode($orderController->getAll());
        }
        else{
            http_response_code(500);
            $db->putError("Error while updating delivered option!");
        } 
    }

    if(isset($_GET['action']) && $_GET['action'] == 'noDelivered'){
        $params = $_GET['params'];
        $customerId = $_SESSION['User'][0]->customerId;
        $rez = $orderController->updateNoDeliveredOrders($params);
        if($rez >= 1){
            http_response_code(200);
            if($customerRole == 1) echo json_encode($orderController->getAllOrdersForSelectedCustomer($customerId));
            else echo json_encode($orderController->getAll());
        }else{
            http_response_code(500);
            $db->putError("Error while updating delivered option!");
        } 
    }

    if(isset($_GET['action']) && $_GET['action'] == 'newOrder'){
        $productId = $_GET['productId'];
        $quantity = $_GET['qty'];
        $customerId = $_SESSION['User'][0]->customerId;
        $params = $customerId.",".$productId.",".$quantity;
        $rez = $orderController->newOrder($params);
        if($rez){
            http_response_code(204);
        }else{
            http_response_code(500);
            $db->putError("Error while inserting new order!");
        }
    }