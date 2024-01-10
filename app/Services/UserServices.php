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
        $username = $user->getUsername();
        $email = $user->getEmail();
        $password = $user->getPassword();
        $image = null;
        $status = $user->getStatus();
        $role_id = $user->getRoleId();

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users (username, email, password, image, status, role_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);

        if (!$stmt) {
            
            return false;
        }

        $success = $stmt->execute([$username, $email, $hashedPassword, $image, $status, $role_id]);

        if ($success) {
            return true; // User created successfully
        } else {
            return false; // User creation failed
        }
   }



   
   public function updateUser(User $user) {
    // var_dump($user);
    try {
        $connection = db_conn::getConnection();

        // Extract user attributes
        $userId = $user->getId();
        $username = $user->getUsername();
        $email = $user->getEmail();
        $roleId = $user->getRoleId();
        $status = $user->getStatus();

        // Update user information in the users table
        $query = "UPDATE users SET username=?, email=?, role_id=?, status=? WHERE id=?";
        $stmt = $connection->prepare($query);

        $stmt->execute([$username, $email, $roleId, $status, $userId]);

       if($stmt){
        return true;
       } else{
        return false;
       }
    } catch (PDOException $e) {
        // Handle exceptions, log errors, or return a default value if something goes wrong
        return false; // Default value if an error occurs

    }
}
    
   


    public function getUserByEmail($email) {
        try {
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->db->prepare($query);
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user) {
                return $user; // Return the user details as an associative array
            } else {
                return null; // User not found
            }
        } catch (PDOException $e) {
            // Handle the exception appropriately
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    public  function getAllUsers() {
        try {
            $query = "SELECT * FROM users";
            $stmt = $this->db->query($query);
            $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $users; // Return an array of users' details
        } catch (PDOException $e) {
            // Handle the exception appropriately
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
    
                // Optionally, you can set the 'id' using setId method if needed
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
        $image = $user->getImage() ?: null; // Set default value for image as null
        $status = $user->getStatus();
        $role_id = $user->getRoleId();
    
        $connection = db_conn::getConnection();
        $connection->beginTransaction(); // Begin a transaction
    
        try {
            $insertUserQuery = "INSERT INTO users (username, email, password, image, status, role_id) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtInsertUser = $connection->prepare($insertUserQuery);
    
            if (!$stmtInsertUser) {
                return false; // Failed to prepare statement
            }
    
            $successInsertUser = $stmtInsertUser->execute([$username, $email, $password, $image, $status, $role_id]);
    
            if ($successInsertUser) {
                $userId = $connection->lastInsertId();
                $connection->commit();
                return true; // User created successfully
            } else {
                $connection->rollBack();
                return false; // User creation failed
            }
        } catch (PDOException $e) {
            $connection->rollBack();
            // Handle or log the exception
            return false; // Return false indicating failure due to exception
        }
    }
    
    



    public function updateUserprofile(User $user) {
        $userId = $user->getId();
        $username = $user->getUsername();
        $email = $user->getEmail();
       
        // Handle image update logic similar to the addUser method
        $image = $user->getImage(); // Get the image path from the User object or set to null if not provided
        
        // Other attributes like role, status can be fetched similarly
        
        $connection = db_conn::getConnection();
        $connection->beginTransaction(); // Begin a transaction
    
        try {
            // Construct the UPDATE query for updating user information
            $updateUserQuery = "UPDATE users SET username=?, email=?, image=? WHERE id=?";
            $stmtUpdateUser = $connection->prepare($updateUserQuery);
    
            if (!$stmtUpdateUser) {
                return false; // Failed to prepare statement
            }
    
            // Bind parameters and execute the update query
            $successUpdateUser = $stmtUpdateUser->execute([$username, $email,  $image, $userId]);
    
            if ($successUpdateUser) {
                $connection->commit();
                return true; // User updated successfully
            } else {
                $connection->rollBack();
                return false; // User update failed
            }
        } catch (PDOException $e) {
            $connection->rollBack();
            // Handle or log the exception
            return false; // Return false indicating failure due to exception
        }
    }
    
    
    public function deleteUser($userId) {
        $connection = db_conn::getConnection();

       
        $deleteUserQuery = "DELETE FROM users WHERE id = :userId";
        $stmtUser = $connection->prepare($deleteUserQuery);
        $stmtUser->bindParam(':userId', $userId, PDO::PARAM_INT);
        $successUser = $stmtUser->execute();

        // Check if both delete operations were successful
        if ($successUser) {
            return true; // Deletion successful
        } else {
            return false; // User not found or deletion failed
        }
    }


    public function countUsers() {
        try {
            $query = "SELECT COUNT(*) as user_count FROM users";
            
            // Assuming $pdo is your PDO instance, adjust the connection details accordingly
            $stmt = $this->db->prepare($query);
            $stmt->execute();
    
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $data['user_count'];
        } catch (PDOException $e) {
            // Handle exceptions, log errors, or return a default value if something goes wrong
            return 0; // Default value if an error occurs
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
    
                // Optionally, you can set the 'id' using setId method if needed
                $user->setId($row['id']);
    
              
            }
        }
        
        return $user;
    } catch (PDOException $e) {
        // Handle exceptions, log errors, or return a default value if something goes wrong
        return null; // Default value if an error occurs
    }

}

    
}