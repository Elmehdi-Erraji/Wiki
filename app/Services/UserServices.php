<?php


namespace app\services;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\entities\User;



use app\config\db_conn;
use PDO;
use PDOException;

class UserServices {

    private $db;

    public function __construct()
    {
        $this->db = db_conn::getConnection(); // Get database connection from DbConn class
    }
    public function createUser(User $user){
        try {
            $username = $user->getUsername();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $image = null;
            $status = $user->getStatus();
            $role_id = $user->getRoleId();
    
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
            $query = "INSERT INTO users (username, email, password, image, status, role_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->db->prepare($query);
            $success = $stmt->execute([$username, $email, $hashedPassword, $image, $status, $role_id]);
    
            if ($success) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
           echo "Error: " . $e->getMessage();
            return null;
        }
    }



   
   public function updateUser(User $user) {
   
    try {
        $connection = db_conn::getConnection();

        $userId = $user->getId();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $roleId = $user->getRoleId();
        $status = $user->getStatus();

        
        $query = "UPDATE users SET username=?, email=?, role_id=?, status=? WHERE id=?";
        $stmt = $connection->prepare($query);

        $stmt->execute([$username, $email, $roleId, $status, $userId]);

       if($stmt){
        return true;
       } else{
        return false;
       }
    } catch (PDOException $e) {
     
        return false; 

    }
}
    

    public function getUserByEmail($email) {
        try {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user) {
                return $user;
            } else {
                return null; 
            }
        } catch (PDOException $e) {
          
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public  function getAllUsers() {
        try {
            $query = "SELECT * FROM users";
            $stmt = $this->db->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $users; 
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return null;
        }
    }


    public static function getAllUserss() {
        $connection = db_conn::getConnection();
        $users = [];
    
        $query = "SELECT * FROM users";
    
        $statement = $connection->query($query);
    
        if ($statement) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $user = new User(
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['image'],
                    $row['status'],
                    $row['role_id']
                );
    
             
                $user->setId($row['id']);
    
                $users[] = $user;
            }
        }
    
        return $users;
    }


    public function addUser(User $user) {
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = password_hash($user->getPassword(), PASSWORD_DEFAULT);
        $image = $user->getImage() ?: null;
        $status = $user->getStatus();
        $role_id = $user->getRoleId();
    
        $connection = db_conn::getConnection();

        $connection->beginTransaction(); // Begin a transaction
    
        try {
            $insertUserQuery = "INSERT INTO users (username, email, password, image, status, role_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtInsertUser = $connection->prepare($insertUserQuery);
    
            $successInsertUser = $stmtInsertUser->execute([$username, $email, $password, $image, $status, $role_id]);
    
            if ($successInsertUser) {
                $userId = $connection->lastInsertId();
                $connection->commit();
                return true; 
            } else {
                $connection->rollBack();
                return false; 
            }
        } catch (PDOException $e) {
            $connection->rollBack();
            return false; 
        }
    }
    
    
    public function updateUserprofile(User $user) {
        $userId = $user->getId();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $image = $user->getImage();
    
        $connection = db_conn::getConnection();
        $connection->beginTransaction(); // Begin a transaction
    
        try {
            $updateUserQuery = "UPDATE users SET username=?, email=?, image =? WHERE id=?";
            $stmtUpdateUser = $connection->prepare($updateUserQuery);
    
            $successUpdateUser = $stmtUpdateUser->execute([$username, $email, $image, $userId]);
    
            if ($successUpdateUser) {
                $connection->commit();
                return true;
            } else {
                $connection->rollBack();
                return false;
            }
        } catch (PDOException $e) {
            $connection->rollBack();
            return false;
        }
    }
    
    
    public function deleteUser($userId) {
        $connection = db_conn::getConnection();

       
        $deleteUserQuery = "DELETE FROM users WHERE id = :userId";
        $stmtUser = $connection->prepare($deleteUserQuery);
        $stmtUser->bindParam(':userId', $userId, PDO::PARAM_INT);
        $successUser = $stmtUser->execute();

    
        if ($successUser) {
            return true;
        } else {
            return false;
        }
    }


    public function countUsers() {
        try {
            $query = "SELECT COUNT(*) as user_count FROM users";
            
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $data['user_count'];
        } catch (PDOException $e) {
            return 0; 
        }
    }


    public  function getUserById($userId) {
    try {
        $connection = db_conn::getConnection();

        $query = "SELECT * FROM users where id = ?";
                  
        $stmt = $connection->prepare($query);
        $stmt->execute([$userId]);
        
        $user = null;
        if ($stmt) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $user = new User(
                    $row['username'],
                    $row['email'],
                    $row['password'],
                    $row['image'],
                    $row['status'],
                    $row['role_id']
                );
                $user->setId($row['id']);
    
              
            }
        }
        
        return $user;
    } catch (PDOException $e) {
        return null; 
    }

}

 
}