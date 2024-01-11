<?php

namespace App\controller;

use App\config\db_conn;

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
            $stmt = $this->database->prepare("SELECT title, content FROM wiki WHERE title LIKE ?");
            $stmt->execute(["%$query%"]);
            $results = $stmt->fetchAll();

            $data = [];
            foreach ($results as $row) {
                $data[] = [
                    'title' => $row['title'], // Use array notation for fetching data
                    'content' => $row['content']
                ];
            }

            header('Content-Type: application/json');
            echo json_encode($data);
            exit();
        }
    }
}