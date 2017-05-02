<?php

require_once('vendor/autoload.php');

try {
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();   
} catch(Exception $e){
    //
}

$dbName = getenv('DB_NAME');
$dbHost = getenv('DB_HOST');
$dbUser = getenv('DB_USER');
$dbPass = getenv('DB_PASS');

$db = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);

?>
