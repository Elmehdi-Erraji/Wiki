<?php


namespace app\services;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\Models\Tag;


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

    public function deleteTag(Tag $tag){

        $tagId = $tag->getId();

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

}