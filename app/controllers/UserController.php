<?php

namespace app\Controllers;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\config\db_conn;
use app\entities\User;
use app\services\UserServices;

use PDO;
use PDOException;
class UserController{

    public function register() {
        if (isset($_POST['signup'])) {
            $postData = $_POST ?? [];
            $username = $postData['username'] ?? '';
            $email = $postData['email'] ?? '';
            $password = $postData['password'] ?? '';
    
            $image = null; 
            $status = 0;  
            $role_id = 2; 
    
            $user = new User($username, $email, $password, $image, $status, $role_id);
    
            $userServices = new UserServices();
    
            try {
                $result = $userServices->createUser($user);
    
                if ($result) {
                  
                    header('Location: login');
                    exit();
                }
            } catch (PDOException $e) {
                session_start();
                $_SESSION['registration_error'] = 'An error occurred during registration. Please try again.';
                header('Location: register');
                exit();
            }
    
            header('Location: register');
            exit();
        }
    }
    

    public function getUsers() {
        $users = new UserServices();
        $all= $users->getAllUsers();
        return $all;
    }

    public function addUser(){
        if (isset($_POST['addUser'])) {

            $postData = $_POST ?? [];
            var_dump($postData);
            $username = $postData['username'] ?? '';
            $email = $postData['email'] ?? '';
            
            $role_id = $postData['user_role'] ?? '';
            $status = $postData['status'] ?? '';
            $password = $postData['password'] ?? '';
            
            $image = $_FILES['user_image'] ?? null;
          // Check if an image was uploaded
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $imagePath = $image['tmp_name']; // Temporary path of the uploaded image
            
            // Process image upload here (move the uploaded image to the desired directory)
            $uploadDirectory = '../../public/images/users/';
            $imageName = basename($image['name']);
            $uploadedImagePath = $uploadDirectory . $imageName;
            
            if (move_uploaded_file($imagePath, $uploadedImagePath)) {
                // Image uploaded successfully
                $image = $uploadedImagePath; // Update $image with the uploaded image path
            } else {
                // Handle image upload failure
                $image = null; // Set image path to null or handle the error accordingly
            }
        } else {
            // No image uploaded or an error occurred during upload
            $image = null;
        }

        // Create User object including the image parameter
        $user = new User($username, $email, $password, $image, $status, $role_id);
        
        $userServices = new UserServices();
        $result = $userServices->addUser($user);

        if ($result) {
            header('Location:user-list');
        } else {
            return false;
        }
    }
}

public function login() {
    $postData = $_POST ?? [];
    $email = $postData['email'] ?? '';
    $password = $postData['password'] ?? '';

   
    $userServices = new UserServices();

    // Get user details by email
    $user = $userServices->getUserByEmail($email);

    if ($user && password_verify($password, $user['password'])) {
        if ($user['status'] == 0) { 
           
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['image'] = $user['image'];

            // Redirect based on user's role
            $role = $user['role_id'];
            if ($role === 1) {
                header('Location: dashboard');
                exit();
            } else if ($role === 2 || $role === 3) {
                header('Location: profile');
                exit();

            } else {
                header('Location: users');
                exit(); 
               
            }
        } else {
           
            session_start();
            $_SESSION['login_error'] = 'Your account has been banned. Please contact the admin.';
            header('Location: login');
            exit();
        }
    } else {
        
        session_start();
        $_SESSION['login_error'] = 'Invalid credentials. Please try again.';
        header('Location: login');
        exit();
    }
}
    public function logout() {
       
            session_start();
            $_SESSION = [];
            session_destroy();
            header('Location: login'); 
            exit();
        
    }

    public function getAllUsers() {
        $users = UserServices::getAllUserss();
        return $users;
    }
    public function userDelete() {
        if(isset($_GET['user_id'])){
            $userId = $_GET['user_id'];
            $userService = new UserServices();

            $deleted = $userService->deleteUser($userId);

            if ($deleted) {
                header('Location: user-list');
            } else {
                echo "Failed to delete the user ";
            }
        }else {
            echo "User id is missing ";
        }

    }

    public function showData() {
        $model = new UserServices();
        $userCount = $model->countUsers();
        // Include the view file and pass the variables
        return [$userCount];
    }


        public function updateUser() {
            $postData = $_POST ?? [];
            $errors = [];
        
            if (isset($_POST['updateUser'])) {
                // Retrieve form data
                $userId = $postData['user_id'] ?? '';
                $username = $postData['username'] ?? '';
                $email = $postData['email'] ?? '';
               
                $role_id = $postData['user_role'] ?? '';
                $status = $postData['status'] ?? '';
            
                if (empty($username)) {
                    $errors['username'] = "Username is required";
                }else if (empty($email)) {
                    $errors["email"] = "Email is required";
                }

                // Create an instance of UserDAO
                $userService = new UserServices();
            
                // Get the user object by ID to check if it exists
                $existingUser = $userService->getUserById($userId);
            
                if ($existingUser) {
                    // Update the user object with the new data
                    $existingUser->setUsername($username);
                    $existingUser->setEmail($email);
                    $existingUser->setRoleId($role_id);
                    $existingUser->setStatus($status);
            
                    // Update the user in the database
                    $result = $userService->updateUser($existingUser);
            
                    if ($result) {
                        // User updated successfully
                        header('Location: user-list');
                        exit();
                    } else {
                        $errors['update'] = "Failed to update user.";
                    }
                } else {
                    $errors['update'] = "User not found.";
                }
              
        $_SESSION['updateUserErrors'] = $errors;
        header('Location: user-list'); // Redirect back to the form
        exit();
            }
        }


        public function updateProfile() {
           
            $postData = $_POST ?? [];
            
             
                $userId = $postData['user_id'] ?? '';
                $username = $postData['username'] ?? '';
                $email = $postData['email'] ?? '';
             
                
                // Handle image upload
                $image = $_FILES['image'];
                // $imagePath = null;
                if ($image && $image['error'] === UPLOAD_ERR_OK) {
                    $uploadDirectory = '../../public/images/users/';
                    $imageName = basename($image['name']);
                    $uploadedImagePath = $uploadDirectory . $imageName;
                    if (move_uploaded_file($image['tmp_name'], $uploadedImagePath)) {
                        $imagePath = $uploadedImagePath;
                    }
                }
                
                $userService = new UserServices();           
                $existingUser = $userService->getUserById($userId);
                
                if ($existingUser) {
                  
                    $existingUser->setUsername($username);
                    $existingUser->setEmail($email);
                    $existingUser->setImage($imagePath);
                    
                  
                    $result = $userService->updateUserprofile($existingUser);
        
                    if ($result) {
                        header('Location: profile');
                        exit();
                    } else {
                        echo "Failed to update user.";
                    }
                } else {
                    echo "User not found.";
                }
            
        }
        

     
    public function fetchUsers() {
        try {
            $dbConnection = db_conn::getConnection();
            
            // Prepare SQL query
            $query = "SELECT * FROM users";
    
            // Execute the query using PDO
            $statement = $dbConnection->query($query);
    
            // Fetch data as associative array
            $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    
            // Close the database connection properly
            $dbConnection = null;
    
            // Set response header to JSON
            header('Content-Type: application/json');
    
            // Output data as JSON
            echo json_encode($data);
            exit; // Ensure no further output after sending JSON response
        } catch (PDOException $e) {
            // Handle any database connection errors
            http_response_code(500); // Internal Server Error
            echo json_encode(array($data));
            exit; // Ensure no further output after sending JSON error response
        }
    }
 

}


