<?php

    namespace App\Controllers;
    use App\Models\Orders;
    
    class OrderController{
        private $db;
        
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function updateDeliveredOrders($params){
            $orderModel = new Orders($this->db);
            return $orderModel->updateDeliveredOrders($params);
        }

        public function updateNoDeliveredOrders($params){
            $orderModel = new Orders($this->db);
            return $orderModel->updateNoDeliveredOrders($params);
        }

        public function getAllOrdersForSelectedCustomer($customerId){
            $orderModel = new Orders($this->db);
            return $orderModel->getAllOrdersForSelectedCustomer($customerId);
        }

        public function newOrder($params){
            $orderModel = new Orders($this->db);
            return $orderModel->insertOrder($params);
        }

        public function getAll(){
            $orderModel = new Orders($this->db);
            return $orderModel->getAll();
        }
    }
    