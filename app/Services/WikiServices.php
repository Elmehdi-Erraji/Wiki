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

}