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
    
                // Assuming setId method exists in the Tag class
                $Category->setId($row['id']);
    
                $Categories[] = $Category;
            }
        }
    
        return $Categories ;
    }
}