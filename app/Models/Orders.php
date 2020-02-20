<?php

namespace App\Models;

class Orders{
    private $db;

    public function __construct(DB $dB)
    {
        $this->db = $dB;
    }

    public function getAll(){
        return $this->db->executeQuery("SELECT delivered, orders.id as 'Id', products.name as 'Products',customers.name as 'Customer',quantity as 'Quantity',date as 'Date',price as 'Price' FROM `orders` inner join customers on orders.customerId = customers.id inner join products on orders.productId = products.id;");
    }

    public function updateDeliveredOrders($params){
        $string = "";
        for($i=0; $i<count($params); $i++){
            if($i==(count($params)-1)){
                $string.="?";
                break;
            }
            $string.="?,";
        }
        return $this->db->updateQueryWithParams("update orders set delivered = 1 where id in (".$string.")",$params);
    }

    public function updateNoDeliveredOrders($params){
        $string = "";
        for($i=0; $i<count($params); $i++){
            if($i==(count($params)-1)){
                $string.="?";
                break;
            }
            $string.="?,";
        }
        return $this->db->updateQueryWithParams("update orders set delivered = 0 where id in (".$string.")",$params);
    }

    public function getAllOrdersForSelectedCustomer($id){
        $param = intval($id);
        return $this->db->executeQueryWithParams("SELECT delivered, orders.id as 'Id', products.name as 'Products',customers.name as 'Customer',quantity as 'Quantity',date as 'Date',price as 'Price' FROM `orders` inner join customers on orders.customerId = customers.id inner join products on orders.productId = products.id where orders.customerId = ?;", [$param]);
    }

    public function insertOrder($params){
        $paramsArray = explode(",", $params);
        return $this->db->execQueryWithParams("INSERT INTO `orders` (`id`, `customerId`, `productId`, `quantity`, `date`, `delivered`) VALUES (NULL, ?, ?, ?, NULL, '0');",$paramsArray);
    }

}