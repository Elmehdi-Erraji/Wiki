<?php

namespace app\services;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\config\db_conn;
use app\entities\Category;

use PDO;
use PDOException;
class CategoryServices {


    private $db;

    public function __construct() {
        $this->db = db_conn::getConnection();
    }

    public function addCategory(Category $category) {

        $categoryName = $category->getcategoryName();


        $query = "INSERT INTO category (categoryName) VALUES (:categoryName)";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":categoryName", $categoryName);

        $result= $stmt->execute();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteCat($cat){

        $catId = $cat;

        $query = "DELETE FROM category WHERE id = :catId";
        $stmt=$this->db->prepare($query);
        $stmt->bindParam(":catId", $catId);

        $result = $stmt->execute();
        if($result){
            return true;
        }else{
            return false;
        }
    }


    public static function getAllCategories() {
        $connection = db_conn::getConnection();
        $Categories = [];
    
        $query = "SELECT * FROM category";
    
        $statement = $connection->query($query);
    
        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $Category = new Category(
                    $row['categoryName']
                );
    
                $Category->setId($row['id']);
    
                $Categories[] = $Category;
            }
        }
    
        return $Categories ;
    }


    public function updateCategory($catId,$catName){

        $categoryId = $catId;
        $categoryName = $catName;

        $query = "UPDATE category SET categoryName=? WHERE id=?";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categoryName,$categoryId]);

        if($stmt) {
            return true;
        }else {
            return false;
        }

    }

    public function countCategories() {
        try {
            $query = "SELECT COUNT(*) as cat_count FROM category";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $data['cat_count'];
        } catch (PDOException $e) {
            return 0; 
        }
    }



    public  function getMostUsedCategories($limit = 5) {
        $query = 'SELECT categoryName FROM category ORDER BY id DESC LIMIT :limit';
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':limit',$limit,PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}