<?php


namespace app\services;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\entities\Tag;


use app\config\db_conn;
use PDO;
use PDOException;

class TagServices{

    private $db;
    public function __construct()
    {
        $this->db = db_conn::getConnection();
    }

    public function addTag(Tag $tag){
        $tagName = $tag->getTagName();

        $query = "INSERT INTO tag (tagName) VALUES (:tagName)";
        $stmt= $this->db->prepare($query);
        $stmt->bindParam(":tagName", $tagName);

        $result = $stmt->execute();
        
        if($result){
            return true;
        }else{
            return false;
        }

    }

    public function deleteTag($tag){

        $tagId = $tag;

        $query = "DELETE FROM tag WHERE id = :tagId";
        $stmt=$this->db->prepare($query);
        $stmt->bindParam(":tagId", $tagId);

        $result = $stmt->execute();
        if($result){
            return true;
        }else{
            return false;
        }
    }



    public static function getAllTags() {
        $connection = db_conn::getConnection();
        $tags = [];
    
        $query = "SELECT * FROM tag";
    
        $statement = $connection->query($query);
    
        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $tag = new Tag(
                    $row['tagName']
                );
    
                $tag->setId($row['id']);
    
                $tags[] = $tag;
            }
        }
        return $tags;
    }


    public  function getMostUsedTags($limit = 10) {
        $query = 'SELECT TagName FROM tag ORDER BY id DESC LIMIT :limit';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}