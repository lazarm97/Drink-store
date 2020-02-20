<?php

namespace App\Models;

class Products{
    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    public function getAll(){
        return $this->db->executeQuery("SELECT * FROM products;");
    }

    public function getOne($id){
        return $this->db->executeQueryWithParams("SELECT * FROM products where id = ?;", $id);
    }

    public function deleteProducts($params){
        $string = "";
        for($i=0; $i<count($params); $i++){
            if($i==(count($params)-1)){
                $string.="?";
                break;
            }
            $string.="?,";
        }
        return $this->db->updateQueryWithParams("delete from products where id in (".$string.")", $params);
    }

    public function updateProduct($params){
        return $this->db->updateQueryWithParams("update products set name = ?, stock = ?, price = ?, description = ?, org_image = ?, small_image = ? where id = ?",$params);
    }

    public function insertProduct($params){
        return $this->db->execQueryWithParams("INSERT INTO `products` (`id`, `name`, `stock`, `price`, `description`) VALUES (NULL, ?, ?, ?, ?);",$params);
    }

    public function lastInsertedId(){
        return $this->db->lastInsertedId();
    }
}