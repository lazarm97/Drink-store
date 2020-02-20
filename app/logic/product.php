<?php

    use App\Controllers\ProductController;
    use App\Models\DB;

    require_once "../config/config.php";
    require_once "../config/autoload.php";

    $db = new DB(SERVER, DBNAME, USERNAME, PASSWORD);
    $productController = new ProductController($db);

    if(isset($_GET['action']) && $_GET['action'] == 'delete'){
        $params = $_GET['params'];
        $rez = $productController->deleteSelectedProducts($params);
        if($rez >= 1){
            http_response_code(200);
            echo json_encode($productController->getAll());
        }
        else{
            http_response_code(500);
            $db->putError("Error while deleting product!");
        } 
    }

    if(isset($_POST['action']) && $_POST['action'] == 'update'){
        $productName = $_POST['productName'];
        $productStock = $_POST['productStock'];
        $productPrice = $_POST['productPrice'];
        $orgImage = $_POST['orgImage'];
        $smallImage = $_POST['smallImage'];
        $productDescription = $_POST['productDescription'];
        $id = $_POST['id'];

        $productNameReg = "/[^\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";
        $productStockReg = "/\d+/";
        $productPriceReg = "/\d+\,{1}\d+/";
        $productImageReg = isset($orgImage);
        $productDescriptionReg = "/[^\"\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";

        $greske = [];
        if($productImageReg == 0)   array_push($greske,"Upload image!");
        if(!preg_match($productNameReg,$productName))   array_push($greske,"Product name was incorrent!");
        if(!preg_match($productStockReg,$productStock))   array_push($greske,"Product stock was incorrent!");
        if(!preg_match($productPriceReg,$productPrice))   array_push($greske,"Product price was incorrent!");
        if(!preg_match($productDescriptionReg,$productDescription))   array_push($greske,"Product description was incorrent!");
        
        if(count($greske) > 0){
            http_response_code(500);
            echo json_encode($greske);
        }else{
            $params = [$productName,$productStock,$productPrice,$productDescription,$orgImage,$smallImage,$id];
            $rez = $productController->updateProduct($params,$smallImage,$orgImage);
            if($rez == 1){
                http_response_code(204);
            }
            else{
                http_response_code(500);
                $db->putError("Error while updating product!");
            } 
        }
    }

    if(isset($_GET['action']) && $_GET['action'] == 'getOne'){
        $id = $_GET['id'];
        $rez = $productController->getOne($id);
        if(count($rez) == 1){
            http_response_code(200);
            echo json_encode($rez);
        }else{
            http_response_code(500);
            $db->putError("Error while getting product!");
        }
    }

    if(isset($_POST['action']) && $_POST['action'] == 'newProduct'){
        $productName = $_POST['productName'];
        $productStock = $_POST['productStock'];
        $productPrice = $_POST['productPrice'];
        $orgImage = $_POST['orgImage'];
        $productDescription = $_POST['productDescription'];

        $productNameReg = "/[^\.\,\"\?\!\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";
        $productStockReg = "/\d+/";
        $productPriceReg = "/\d+\,{1}\d+/";
        $productImageReg = isset($orgImage);
        $productDescriptionReg = "/[^\"\;\:\#\$\%\&\(\)\*\+\-\/\<\>\=\@\[\]\\\^\_\{\}\|\~]+/";

        $greske = [];
        if($productImageReg == 0)   array_push($greske,"Upload image!");
        if(!preg_match($productNameReg,$productName))   array_push($greske,"Product name was incorrent!");
        if(!preg_match($productStockReg,$productStock))   array_push($greske,"Product stock was incorrent!");
        if(!preg_match($productPriceReg,$productPrice))   array_push($greske,"Product price was incorrent!");
        if(!preg_match($productDescriptionReg,$productDescription))   array_push($greske,"Product description was incorrent!");

        if(count($greske) > 0){
            http_response_code(500);
            echo json_encode($greske);
        }else{
            $params = [$productName,$productStock,$productPrice,$productDescription];
            $rez = $productController->insertProduct($params,$orgImage);
            if($rez == 1){
                http_response_code(200);
                echo json_encode($productController->getAll());
            }
            else{
                http_response_code(500);
                $db->putError("Error while inserting new product!");
            } 
        }
    }