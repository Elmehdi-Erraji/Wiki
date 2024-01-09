<?php

namespace app\controllers;

require_once __DIR__ . '/../../vendor/autoload.php';


use app\entities\Wiki;

use app\services\WikiServices;


class WikiController
{

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
            $status = 0;
            $uploadDirectory = '../../public/images/wikies/';
            $uploadedImagePath = $uploadDirectory . $image;

            $uploadResult = move_uploaded_file($imageTemp, $uploadedImagePath);

            if ($uploadResult) {
                $wiki = new Wiki($title, $content, $uploadedImagePath, $status, $category, $userId);
                $wikiService = new WikiServices();
                $wikiService->addWikiWithTags($wiki, $tags);
                header("Location: wiki-list");
                exit();
            } else {
                echo "failed to add a wiki";
            }
        }
    }

    public function updateWiki()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['updateWiki'])) {
            $wikiId = $_POST['wiki_id'];
            $title = $_POST['title'];
            $category = $_POST['category'];
            $tags = $_POST['tags'] ?? [];
            $content = $_POST['content'];
            $userId = $_POST['user_id'];
            $status = 1; // Assuming you have a status field in the form
    
            // Handle image upload
            $image = $_FILES['article_image']['name'];
            $imageTemp = $_FILES['article_image']['tmp_name'];
            $uploadDirectory = '../../public/images/wikies/';
            $uploadedImagePath = $uploadDirectory . $image;
            $uploadResult = move_uploaded_file($imageTemp, $uploadedImagePath);
    
            // Retrieve the existing wiki details from your service or repository
            $wikiService = new WikiServices();
            $existingWiki = $wikiService->getWikiById($wikiId);
    
            // Check if the wiki exists
            if (!$existingWiki) {
                echo "Wiki not found!";
                exit();
            }
    
            // Update the existing wiki object with the new values
            $existingWiki->setTitle($title);
            $existingWiki->setCategoryId($category);
            $existingWiki->setContent($content);
            $existingWiki->setUserId($userId);
            $existingWiki->setStatus($status); // Assuming status is updateable
    
            // Update the image only if a new one is uploaded
            if ($uploadResult) {
                $existingWiki->setImage($uploadedImagePath);
            }
    
            // Perform the update operation
            $wikiService->updateWikiWithTags($existingWiki, $tags);
    
            header("Location: wiki-list");
            exit();
        }
    }
    

    public function getAllWikies()
    {
        $wikies = WikiServices::getAllWikies();
        return $wikies;
    }

    public function wikiDelete()
    {

        $wiki_id = $_GET["wiki_id"];

        $wikiService = new WikiServices();

        $result = $wikiService->deleteWiki($wiki_id);

        if ($result) {
            header("location: wiki-list");
            exit();
        } else {
            echo "faild to delete this wiki";
        }
    }
}
