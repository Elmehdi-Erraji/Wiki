<?php

namespace app\config;

require_once __DIR__ ."/../../vendor/autoload.php";

use Dotenv\Dotenv;
use PDO;
use PDOException;
$dontenv = Dotenv::createImmutable(__DIR__ ."/../..");
$dontenv->load();
class db_conn{
    private static $connection;

    private function __construct(){

        $dbHost = $_ENV['DB_HOST'];
        $dbUser =$_ENV['DB_USER'];
        $dbName =$_ENV['DB_NAME'];
        $dbPassword =$_ENV['DB_PASSWORD'];

       
        try {
            self::$connection = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die("Connection faild". $e->getMessage());
            }

        }


   public static function getConnection(){
    if(!self::$connection){
        new self();
    }
    return self::$connection;
}

}


$connection = db_conn::getConnection();

if(!$connection){
    echo "db is not connected";
}