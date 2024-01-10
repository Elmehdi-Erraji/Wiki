<?php

namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';


use app\entities\Category;

use app\services\CategoryServices;
use app\services\TagServices;



class HomeController {

    public function index(){

        $categoryServices = new CategoryServices();
        $mostUsedCategories = $categoryServices->getMostUsedCategories();

        $tagServices = new TagServices();
        $mostUsedtags = $tagServices->getMostUsedTags();

        include('../../views/home.php');
        
    }
} 