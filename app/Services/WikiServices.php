<?php

namespace app\services;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\config\db_conn;
use app\entities\Wiki;

use PDO;
use PDOException;

class WikiServices {
    private $db;

    public function __construct()
    {
        $this->db = db_conn::getConnection(); // Get database connection from DbConn class
    }

    public function addWikiWithTags(Wiki $wiki, array $tagIds) {
        try {
            // Begin transaction
            $this->db->beginTransaction();

            // Insert Wiki entry
            $sql = "INSERT INTO wiki (title, content, image,status,category_id, user_id) VALUES (?, ?, ?, ?, ?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$wiki->getTitle(), $wiki->getContent(), $wiki->getImage(),$wiki->getStatus(), $wiki->getCategoryId(), $wiki->getUserId()]);
            $wikiId = $this->db->lastInsertId();

            // Associate tags with the Wiki entry
            $tagInsertSql = "INSERT INTO wiki_tag (wiki_id, tag_id) VALUES (?, ?)";
            $tagInsertStmt = $this->db->prepare($tagInsertSql);
            foreach ($tagIds as $tagId) {
                $tagInsertStmt->execute([$wikiId, $tagId]);
            }

            // Commit the transaction
            $this->db->commit();
        } catch (PDOException $e) {
            // Roll back the transaction upon failure
            $this->db->rollBack();
            // Handle exception or log error
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateWikiWithTags(Wiki $wiki, array $tagIds)
    {
        try {
            // Begin transaction
            $this->db->beginTransaction();
    
            // Update Wiki entry
            $sql = "UPDATE wiki SET title = ?, content = ?, image = ?, status = ?, category_id = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$wiki->getTitle(), $wiki->getContent(), $wiki->getImage(), $wiki->getStatus(), $wiki->getCategoryId(), $wiki->getId()]);
    
            // Delete existing associations between wiki and tags
            $deleteTagsSql = "DELETE FROM wiki_tag WHERE wiki_id = ?";
            $deleteTagsStmt = $this->db->prepare($deleteTagsSql);
            $deleteTagsStmt->execute([$wiki->getId()]);
    
            // Associate new tags with the Wiki entry
            $tagInsertSql = "INSERT INTO wiki_tag (wiki_id, tag_id) VALUES (?, ?)";
            $tagInsertStmt = $this->db->prepare($tagInsertSql);
            foreach ($tagIds as $tagId) {
                $tagInsertStmt->execute([$wiki->getId(), $tagId]);
            }
    
            // Commit the transaction
            $this->db->commit();
        } catch (PDOException $e) {
            // Roll back the transaction upon failure
            $this->db->rollBack();
            // Handle exception or log error
            echo "Error: " . $e->getMessage();
        }
    }
    


    public static function getAllWikies(){
        $db = db_conn::getConnection();
        $wikies = [];

        $query = "SELECT wiki.*, category.categoryName 
        FROM wiki 
        INNER JOIN category ON wiki.category_id = category.id";

        $stmt = $db->query($query);

        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $wiki = new Wiki(
                    $row["title"],
                    $row["content"],
                    $row["image"],
                    $row["status"],
                    $row["category_id"],
                    $row["created_at"],
                    
                );
                $wiki->setId( $row["id"] );
                $wiki->setUserId($row["user_id"]);
                $created_at = $row["created_at"] ? date("Y-m-d", strtotime($row["created_at"])) : null;
                $wiki->setCreatedAt($created_at);
                
                $categoryName = $row["categoryName"];
                $wiki->setCategoryName($categoryName);
                
                $wikies[] = $wiki;
            }
        }
        return $wikies;
    }

    public  function getMyWikies($id){
        $userId = $id;
        $db = db_conn::getConnection();
        $Mywikies = [];

        $query = "SELECT wiki.*, category.categoryName 
        FROM wiki 
        INNER JOIN category ON wiki.category_id = category.id where user_id = ?";

        $stmt = $db->prepare($query);
        $stmt->execute([$userId]);

        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                $wiki = new Wiki(
                    $row["title"],
                    $row["content"],
                    $row["image"],
                    $row["status"],
                    $row["category_id"],
                    $row["created_at"],
                    
                );
                $wiki->setId( $row["id"] );
                $wiki->setUserId($row["user_id"]);
                $created_at = $row["created_at"] ? date("Y-m-d", strtotime($row["created_at"])) : null;
                $wiki->setCreatedAt($created_at);
                
                $categoryName = $row["categoryName"];
                $wiki->setCategoryName($categoryName);
                
                $Mywikies[] = $wiki;
            }
        }
        return $Mywikies;
    }



    public function getWikiById($id){
        $db = db_conn::getConnection();
        $wiki = null;
    
        $query = "SELECT wiki.*, category.categoryName 
            FROM wiki 
            INNER JOIN category ON wiki.category_id = category.id WHERE wiki.id = ?";
    
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
    
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row){
            $wiki = new Wiki(
                $row["title"],
                $row["content"],
                $row["image"],
                $row["status"],
                $row["category_id"],
                $row["created_at"]
            );
            $wiki->setId($row["id"]);
            $wiki->setUserId($row["user_id"]);
            $created_at = $row["created_at"] ? date("Y-m-d", strtotime($row["created_at"])) : null;
            $wiki->setCreatedAt($created_at);
            
            $categoryName = $row["categoryName"];
            $wiki->setCategoryName($categoryName);
    
            // Fetch related tags for the wiki from wiki_tag table
            $tagsQuery = "SELECT tag.tagName
                          FROM wiki_tag
                          INNER JOIN tag ON wiki_tag.tag_id = tag.id
                          WHERE wiki_tag.wiki_id = ?";
            $tagsStmt = $db->prepare($tagsQuery);
            $tagsStmt->execute([$id]);
            $tags = $tagsStmt->fetchAll(PDO::FETCH_ASSOC);
    
            $tagNames = array_column($tags, 'tagName');
            $wiki->setTags($tagNames); // Assuming 'setTags' is a method in the Wiki class to set tag names
        }
        return $wiki;
    }

    public function deleteWiki($wiki_id){

          $id=$wiki_id;

       try {

        $this->db->beginTransaction();

        $tagDelete = "delete from wiki_tag where wiki_id = ?";
        $stmt = $this->db->prepare($tagDelete);
        $stmt->execute([ $id]);

        $wikiDelete = "delete from wiki where id = ?";
        $stmt = $this->db->prepare($wikiDelete);
        $stmt->execute([ $id]);

        $this->db->commit();
        return true;

       } catch(PDOException $e) {
        $this->db->rollBack();
        echo "Error :" . $e->getMessage();
       }
    }


    public function updateWikiStatus($wikiId, $newStatus) {
        try {
            // Begin transaction
            $this->db->beginTransaction();
    
            // Update Wiki status
            $sql = "UPDATE wiki SET status = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$newStatus, $wikiId]);
    
            // Commit the transaction
            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            // Roll back the transaction upon failure
            $this->db->rollBack();
            // Handle exception or log error
            echo "Error: " . $e->getMessage();
        }
    }



    public function countWikis() {
        try {
            $query = "SELECT COUNT(*) as wiki_count FROM wiki";
            
            // Assuming $pdo is your PDO instance, adjust the connection details accordingly
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $data['wiki_count'];
        } catch (PDOException $e) {
            // Handle exceptions, log errors, or return a default value if something goes wrong
            return 0; // Default value if an error occurs
        }
    }
}