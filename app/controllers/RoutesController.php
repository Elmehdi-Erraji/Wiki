<?php

namespace app\controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

class RoutesController {
    public function index() {
        include __DIR__ ."../../../views/home.php";
    }

    public function login() {
        include __DIR__ ."../../../views/auth/login.php";
    }
    public function register() {
        include __DIR__ ."../../../views/auth/register.php";
    }
    public function details() {
        include __DIR__ ."../../../views/details.php";
    }

    public function dashboard(){
        include __DIR__ .'../../../views/admin/dashboard.php';
    }
    public function profile(){
       
        include __DIR__ .'../../../views/admin/profile.php';
    }
    public function userAdd(){
        include __DIR__ .'../../../views/admin/user-add.php';
    }

    public function userList(){
        include __DIR__ .'../../../views/admin/user-list.php';
    }
    public function Update(){
       
        include __DIR__ .'../../../views/admin/user-update.php';
    }
    public function cat_tag(){
       
        include __DIR__ .'../../../views/admin/cat-tag-list.php';
    }
    public function tagAdd(){
       
        include __DIR__ .'../../../views/admin/tag-Add.php';
    }
    public function categoryAdd(){
       
        include __DIR__ .'../../../views/admin/category-add.php';
    }
    public function wikiAdd(){
       
        include __DIR__ .'../../../views/admin/wiki-add.php';
    }
    public function wikiList(){
       
        include __DIR__ .'../../../views/admin/wiki-list.php';
    }
   
}