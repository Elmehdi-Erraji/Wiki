<?php

namespace app\controllers;

require_once __DIR__ . '/../../vendor/autoload.php';


use app\entities\Category;

use app\services\CategoryServices;
use app\services\TagServices;
use app\services\UserServices;
use app\services\WikiServices;

use app\Controllers\TagController;
use app\Controllers\CategoryController;



require_once __DIR__ . '/../../vendor/autoload.php';

class RoutesController
{
    public function index()
    {
        include __DIR__ . "../../../views/home.php";
    }

    public function wiki()
    {
        include __DIR__ . "../../../views/wiki.php";
    }

    public function login()
    {
        include __DIR__ . "../../../views/auth/login.php";
    }
    public function register()
    {
        include __DIR__ . "../../../views/auth/register.php";
    }
    public function details()
    {
        include __DIR__ . "../../../views/details.php";
    }

    public function dashboard()
    {
        $cat = new CategoryController();
        list($catCount) = $cat->showData();

        $wiki = new WikiController();
        list($wikiCount) = $wiki->showData();

        $data = new UserController();
        list($userCount) = $data->showData();

        $errors = $_SESSION['updateUserErrors'] ?? [];
        unset($_SESSION['updateUserErrors']);

        include __DIR__ . '../../../views/admin/dashboard.php';
    }
    public function profile()
    {

        include __DIR__ . '../../../views/admin/profile.php';
    }
    public function userAdd()
    {
        include __DIR__ . '../../../views/admin/user-add.php';
    }

    public function userList()
    {
        $userController = new UserController();
        $users = $userController->getAllUsers();

        include __DIR__ . '../../../views/admin/user-list.php';
    }


    public function Update()
    {
        if (isset($_GET['user_id'])) {
            $userId = $_GET['user_id'];

            // Fetch user details by ID using UserDAO method
            $userService = new UserServices();

            // Fetch user details by ID using UserServices instance method
            $userinfo = $userService->getUserById($userId);
            if (!$userinfo) {
                echo "User not found!";
                exit();
            }
        } else {
            echo "Invalid user ID!";
            exit();
        }
        include __DIR__ . '../../../views/admin/user-update.php';
    }


    public function cat_tag()
    {
        $tagController = new TagController();
        $tags = $tagController->getAllTags();

        $categoryController = new CategoryController();
        $categoris = $categoryController->getAllCategories();

        include __DIR__ . '../../../views/admin/cat-tag-list.php';
    }






    public function wikiAdd()
    {
        $tagController = new TagController();
        $tags = $tagController->getAllTags();

        $categoryController = new CategoryController();
        $categoris = $categoryController->getAllCategories();

        include __DIR__ . '../../../views/admin/wiki-add.php';
    }
    public function wikiList()
    {
        $wikiController = new WikiController();
        $wikies = $wikiController->getAllWikies();

        include __DIR__ . '../../../views/admin/wiki-list.php';
    }

    public function UpdateWiki()
    {
        if (isset($_GET['wiki_id'])) {
            $wikiId = $_GET['wiki_id'];


            $wikiService = new WikiServices();
            $wikiDetails = $wikiService->getWikiById($wikiId);
            if (!$wikiDetails) {
                echo "wiki not found !";
                exit();
            }
            $categoryController = new CategoryController();
            $categories = $categoryController->getAllCategories();
            $tagController = new TagController();
            $tags = $tagController->getAllTags();
        }

        include __DIR__ . '../../../views/admin/wiki-update.php';
    }
}
