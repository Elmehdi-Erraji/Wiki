<?php

namespace app\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\config\db_conn;
use app\entities\Tag;
use app\services\TagServices;

use app\controllers\RoutesController;

use PDO;
use PDOException;


class TagController {

    public function addTag(){
        if(isset($_POST['addTag'])){
            $postData = $_POST ?? [];

            $tagName = $postData['tagName'];

            $tag = new Tag($tagName);

            $tagService = new TagServices();

            $result = $tagService->addTag($tag);

            if($result){
                header('location: cat-tag');
                exit();
            }else{
                return false;
            }

        }
    }

    public function deleteTag(){
        if(isset($_GET['tag_id'])){
            $tagId = $_GET['tag_id'];

            $tagService = new TagServices();
            $result = $tagService->deleteTag($tagId);

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

   
    public function getAllTags() {
        $tags = TagServices::getAllTags();
        return $tags;
    }
}