<?php

namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';


use app\entities\Category;

use app\services\CategoryServices;
use app\services\TagServices;

class CategoryController{


    public function addCategory(){

        $postData = $_POST ;

        if (isset($_POST["addCategory"])){

            $catName = $postData['CategoryName'];

            $cat = new Category($catName);

            $catService = new CategoryServices();

            $result = $catService->addCategory( $cat);

            if($result){
                header('location: cat-tag');
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
                header('location: cat-tag');
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



    public function updateCategory(){
        $postData = $_POST ;
        
        $catId = $postData['categoryId'];
        $catName = $postData['CategoryName'];

        $catService = new CategoryServices();

        $result = $catService->updateCategory($catId,$catName);

        if($result){
            header('location: cat-tag');
        }else {
            echo 'Update faild';
        }

    }


    public function showData() {
        $count = new CategoryServices();
        $catCount = $count->countCategories();
        // Include the view file and pass the variables
        return [$catCount];
    }



   

}