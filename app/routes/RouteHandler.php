<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use app\routes\Router;

$router = new Router();

$router->setRoutes([
    'GET'=>[
        ''=> ['RoutesController','index'],
        'login'=> ['RoutesController','login'],
        'register'=> ['RoutesController','register'],
        'error'=> ['RoutesController','index'],
        'details'=> ['RoutesController','details'],
        'dashboard'=>['RoutesController' , 'dashboard'],
        'user-add'=>['RoutesController' , 'userAdd'],
        'user-list'=>['RoutesController' , 'userList'],
        'profile'=>['RoutesController' , 'profile'],
        'Delete'=>['UserController' , 'userDelete'],
        'Update'=>['RoutesController' , 'Update'],
        'logout'=>['UserController' , 'logout'],
        'fetchUsers'=>['UserController' , 'fetchUsers'],
        'cat-tag'=>['RoutesController' , 'cat_tag'],
        'tag-add'=>['RoutesController' , 'tagAdd'],
        'category-add'=>['RoutesController' , 'categoryAdd'],
        'Delete-tag'=>['TagController' , 'deleteTag'],
        'Delete-cat'=>['CategoryController' , 'deleteCat'],
        'wiki-add'=>['RoutesController' , 'wikiAdd'],
        'wiki-list'=>['RoutesController' , 'wikiList'],
        'Delete-Wiki'=>['WikiController' , 'wikiDelete'],
        'Update-Wiki'=>['RoutesController' , 'UpdateWiki'],

    ],
    'POST'=>[
        'login'=> ['UserController','login'],
        'register'=> ['UserController','register'],
        'addUser'=>['UserController' , 'addUser'],
        'updateUser'=>['UserController' , 'updateUser'],
        'updateProfile'=>['UserController' , 'updateProfile'],
        'addTag'=>['TagController' , 'addTag'],
        'addCategory'=>['CategoryController' , 'addCategory'],
        'updateCategory'=>['CategoryController' , 'updateCategory'],
        'addWiki'=>['WikiController' , 'addWiki'],
        'updateWiki'=>['WikiController' , 'updateWiki'],
        'updateWikiStatus'=>['WikiController' , 'updateWikiStatus'],

    ]
]);
if (isset($_GET['url'])) {
    $uri = trim($_GET['url'], '/');
    $method = $_SERVER['REQUEST_METHOD'];

    try {
        $route = $router->getRoute($method, $uri);
        if ($route) {
            list($controllerName, $methodName) = $route;
            $controllerClass = 'app\\controllers\\' . ucfirst($controllerName);
            $object = new $controllerClass();

            if ($methodName) {
                if (method_exists($object, $methodName)) {
                    $object->$methodName();
                } else {
                    throw new Exception('Method not found in controller.');
                }
            } else {
                $object->index();
            }
        } else {
            throw new Exception('Route not found.');
        }
    } catch (Exception $e) {
        echo 'Caught exception: ', $e->getMessage(), "\n";
    }
} else {
    echo 'error';
}