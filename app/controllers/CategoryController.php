<?php

namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';


use app\entities\Category;

use app\services\CategoryServices;




class CategoryController{


    public function addCategory(){

        $postData = $_POST ;

        if (isset($_POST["addCategory"])){

            $catName = $postData['CategoryName'];

            $cat = new Category($catName);

            $catService = new CategoryServices();

            $result = $catService->addCategory( $cat);

            if($result){
                header('location: wiki-list');
            }else {
                return false ;
            }

        }


    }

    public function deleteCat(){
        if(isset($_GET['cat_id'])){
            $catId = $_GET['cat_id'];

            $catService = new CategoryServices();
            $result = $catService->deleteCat($catId);

            if($result){
                header('location: wiki-list');
                exit();
            }else{
                echo 'Failde to delete tag';
            }

        }else {
            echo 'Tag id is missing';
        }
    }


    public function getAllCategories() {
        $Categories = CategoryServices::getAllCategories();
        return $Categories;
    }
}