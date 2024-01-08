<?php

namespace app\DAO;
require_once __DIR__ . '/../../vendor/autoload.php';

use app\entities\User;

interface UserDAO {
    public function createUser(User $user);
    public function getUserById($id);
    public function updateUser(User $user);
    public function deleteUser($id);
}