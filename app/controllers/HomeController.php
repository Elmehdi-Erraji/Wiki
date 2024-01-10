<?php

namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';


use app\entities\Category;

use app\services\CategoryServices;
use app\services\TagServices;
use app\services\UserServices;
use app\services\WikiServices;



class HomeController {

    public function index(){

        $categoryServices = new CategoryServices();
        $mostUsedCategories = $categoryServices->getMostUsedCategories();

        $tagServices = new TagServices();
        $mostUsedtags = $tagServices->getMostUsedTags();

        $wikiServices = new WikiServices();
        $AllWikies = $wikiServices->fetchWikiData();

       

        include('../../views/home.php');
        
    }


    public function wiki(){

        $wiki_id = $_GET['wiki_id'];

        $wikiServices = new WikiServices();
        $AllWikies = $wikiServices->fetchWikiData();

        
        $categoryServices = new CategoryServices();
        $mostUsedCategories = $categoryServices->getMostUsedCategories();

        $tagServices = new TagServices();
        $mostUsedtags = $tagServices->getMostUsedTags();

        $wikiService = new WikiServices();
        $wikidata = $wikiService->getWikiById($wiki_id);

        if($wikidata){
            $userService = new UserServices();
            $Author = $userService->getUserById($wikidata->getUserId());
            
        }

        include('../../views/wiki.php');
    }
} 