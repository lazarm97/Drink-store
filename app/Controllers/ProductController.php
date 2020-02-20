<?php

    namespace App\Controllers;
    use App\Models\Products;
    require_once "../config/config.php";
    
    class ProductController{
        private $db;
        
        public function __construct($db)
        {
            $this->db = $db;
        }

        public function deleteSelectedProducts($params){
            $productModel = new Products($this->db);
            return $productModel->deleteProducts($params);
        }

        public function getAll(){
            $productModel = new Products($this->db);
            return $productModel->getAll();
        }

        public function updateProduct($params,$smallImage,$orgImage){
            if(!file_exists(ABSOLUTE_PATH.'/'.$smallImage)):
                $mala_tmp = str_replace("img/male_slike/","img/tmp/",$smallImage);
                $velika_tmp = str_replace("img/originalne_slike/","img/tmp/",$orgImage);
                $tmp_putanjaMala = ABSOLUTE_PATH.'/'.$mala_tmp;
                $tmp_putanjaOrg = ABSOLUTE_PATH.'/'.$velika_tmp;
                rename($tmp_putanjaMala,ABSOLUTE_PATH.'/'.$smallImage);
                rename($tmp_putanjaOrg,ABSOLUTE_PATH.'/'.$orgImage);
            endif;    
            $productModel = new Products($this->db);
            return $productModel->updateProduct($params);
        }

        public function getOne($id){
            $productModel = new Products($this->db);
            return $productModel->getOne([$id]);
        }

        public function insertProduct($params,$orgImage){
            $tmp_putanjaMala = ABSOLUTE_PATH.'/app/assets/img/tmp/mala_'.$orgImage;
            $tmp_putanjaOrg = ABSOLUTE_PATH.'/app/assets/img/tmp/org_'.$orgImage;
            $malaSlika = ABSOLUTE_PATH.'/app/assets/img/male_slike/mala_'.$orgImage;
            $novaPutanjaOrg = ABSOLUTE_PATH.'/app/assets/img/originalne_slike/org_'.$orgImage;
            rename($tmp_putanjaMala,$malaSlika);
            rename($tmp_putanjaOrg,$novaPutanjaOrg);
            $productModel = new Products($this->db);
            $rez = $productModel->insertProduct($params);
            if($rez){
                $prod_last_id = $productModel->lastInsertedId();
                $putanjaMala = 'app/assets/img/male_slike/mala_'.$orgImage;
                $putanjaOrg = 'app/assets/img/originalne_slike/org_'.$orgImage;
                array_push($params, $putanjaOrg,$putanjaMala,$prod_last_id);
                $rezUpdate = $productModel->updateProduct($params);
                if($rezUpdate == 1) return 1;
                else return 0;
            }
        }
    }
    