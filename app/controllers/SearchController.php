<?php

namespace App\controller;

use App\config\db_conn;
use PDO;
class SearchController
{
    private $database;

    public function __construct()
    {
        $this->database = db_conn::getConnection();
    }

    public function search()
    {
        if (isset($_GET['q'])) {
            $query = $_GET['q'];
            $stmt = $this->database->prepare("SELECT id, title, image, created_at, category_id FROM wiki WHERE title LIKE ?");
            $stmt->execute(["%$query%"]);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            header('Content-Type: application/json');
            echo json_encode($results);
            exit();
        }
    }
}