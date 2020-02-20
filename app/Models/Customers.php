<?php

namespace App\Models;

class Customers{
    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getAll(){
        return $this->db->executeQuery("SELECT * FROM customers;");
    }

    public function insertCustomer($params){
        return $this->db->execQueryWithParams("INSERT INTO `customers` (`id`, `name`, `address`, `phone`) VALUES (NULL, ?, ?, ?);",$params);
    }

    public function deleteSelectedCustomers($params){
        $string = "";
        for($i=0; $i<count($params); $i++){
            if($i==(count($params)-1)){
                $string.="?";
                break;
            }
            $string.="?,";
        }
        return $this->db->updateQueryWithParams("delete from customers where id in (".$string.")", $params);
    }

    public function getOne($id){
        return $this->db->executeQueryWithParams("SELECT * FROM customers where id = ?;", $id);
    }

    public function updateCustomer($params){
        return $this->db->updateQueryWithParams("update customers set name = ?, address = ?, phone = ? where id = ?",$params);
    }
}