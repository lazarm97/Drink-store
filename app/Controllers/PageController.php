<?php

namespace App\Controllers;
use App\Models\Orders;
use App\Models\Customers;
use App\Models\Products;

class PageController extends Controller {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function orders(){
        $ordersModel = new Orders($this->db);
        if($_SESSION['User'][0]->roleId == "2"){
            $orders = $ordersModel->getAll();
            $this->view("orders",
            [
                "orders" => $orders,
                "title" => "My all orders"
            ]);
        }else{
            $orders = $ordersModel->getAllOrdersForSelectedCustomer($_SESSION['User'][0]->customerId);
            $this->view("orders",
            [
                "orders" => $orders,
                "title" => "My all orders"
            ]);
        }
    }
    public function login(){
        $this->view("login");
    }
    public function customers(){
        $customersModel = new Customers($this->db);
        $customers = $customersModel->getAll();
        $this->view("customers",
        [
            "customers" => $customers,
            "title" => "All customers"
        ]);
    }
    public function products(){
        $productsModel = new Products($this->db);
        $products = $productsModel->getAll();
        $this->view("products",
        [
            "products" => $products,
            "title" => "All products"
        ]);
    }
    public function newOrders(){
        $productsModel = new Products($this->db);
        $products = $productsModel->getAll();
        $this->view("newOrders",
        [
            "products" => $products,
            "title" => "All products"
        ]);
    }
}