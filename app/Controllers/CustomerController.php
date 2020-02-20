<?php

    namespace App\Controllers;
    use App\Models\Customers;
    
    class CustomerController{
        private $db;
        
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function getAll(){
            $customerModel = new Customers($this->db);
            return $customerModel->getAll();
        }

        public function insertCustomer($params){
            $customerModel = new Customers($this->db);
            return $customerModel->insertCustomer($params);
        }

        public function deleteSelectedCustomers($params){
            $customerModel = new Customers($this->db);
            return $customerModel->deleteSelectedCustomers($params);
        }

        public function getOne($id){
            $customerModel = new Customers($this->db);
            return $customerModel->getOne([$id]);
        }

        public function updateCustomer($params){
            $customerModel = new Customers($this->db);
            return $customerModel->updateCustomer($params);
        }
    }