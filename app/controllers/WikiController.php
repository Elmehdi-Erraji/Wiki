<?php

namespace app\controllers;
require_once __DIR__ . '/../../vendor/autoload.php';


use app\entities\Wiki;

use app\services\WikiServices;


class WikiController {

    public function addWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addWiki'])) {
            $title = $_POST['title'];
            $category = $_POST['category'];
            $tags = $_POST['tags'] ?? [];
            $image = $_FILES['article_image']['name'];
            $imageTemp = $_FILES['article_image']['tmp_name'];
            $content = $_POST['content'];
            $userId = $_POST['user_id'];
            $status = 1;
            $uploadDirectory = '../../public/images/wikies/';
            $uploadedImagePath = $uploadDirectory . $image;
    
            $uploadResult = move_uploaded_file($imageTemp, $uploadedImagePath);
    
            if ($uploadResult) {
                $wiki = new Wiki($title, $content, $uploadedImagePath, $status, $category,$userId);
                $wikiService = new WikiServices();
                $wikiService->addWikiWithTags($wiki, $tags);
                header("Location: wiki-list");
                exit();
            } else {
                echo"failed to add a wiki";
            }
        }
    }
    

    public function getAllWikies(){
        $wikies = WikiServices::getAllWikies();
        return $wikies;
    }

    public function wikiDelete(){

        $wiki_id = $_GET["wiki_id"];

        $wikiService = new WikiServices();

        $result = $wikiService->deleteWiki($wiki_id);

        if ($result) {
            header ("location: wiki-list");
            exit();
        }else {
            echo "faild to delete this wiki";
        }
    }

}