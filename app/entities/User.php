<?php 

namespace App\entities;

class User {
    private $id;
    private $username;
    private $email;
   
    private $password;
    private $image;
    private $status;
    private $role_id;

    public function __construct($username, $email, $password, $image, $status, $role_id) {
        $this->username = $username;
        $this->email = $email;
        
        $this->password = $password;
        $this->image = $image;
        $this->status = $status;
        $this->role_id = $role_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getImage() {
        return $this->image;
    }

    public function setStatus($status) {
        $this->status = $status;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setRoleId($role_id) {
        $this->role_id = $role_id;
    }

    public function getRoleId() {
        return $this->role_id;
    }
}
