<?php

namespace App\Controllers;
class Controller {

    protected function view($fileName, $data = []){
        $afterLoginPages = ["orders","customers","products","newOrders"];
        extract($data); 
        include "app/views/fixed/head.php";
        if(in_array($fileName,$afterLoginPages)){
            include "app/views/fixed/homeNavigation.php";
            if($_SESSION['User'][0]->roleId == '1')
                include "app/views/fixed/homeSideNavigationCustomer.php";
            else 
                include "app/views/fixed/homeSideNavigation.php";
        }
        include "app/views/pages/$fileName.php";
        include "app/views/fixed/footer.php";
        $open = fopen(ACTIVITY_FILE, "a");
        if($open){
            $date = date('d-m-Y H:i:s');
            fwrite($open, "{$_SERVER['PHP_SELF']}?page={$fileName}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\t\n");
            fclose($open);
        }
    }


}