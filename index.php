<?php
	session_start();
	use App\Models\DB;
	use App\Controllers\PageController;

	require_once "app/config/config.php";
	require_once "app/config/autoload.php";
	$db = new DB(SERVER, DBNAME, USERNAME, PASSWORD);
	$pageController = new PageController($db);
	
	if(isset($_GET['page']) && isset($_SESSION['User'])){
		switch($_GET['page']){
			case "orders":
				$pageController->orders();
				break;
			case "customers":
				$pageController->customers();
				break;
			case "products":
				$pageController->products();
				break;
			case "login":
				$pageController->login();
				break;
			case "new-orders":
				$pageController->newOrders();
				break;
		}
	}else{
		$pageController->login();
	}


	
	
	
