<?php
require_once __DIR__.'/vendor/autoload.php';
use Dotenv\Dotenv;
use app\core\App;
$dotenv=Dotenv::createImmutable(__DIR__);
$dotenv->load();


$databaseconfig=[
    'user'=>\app\models\SignUp::class,
   'database'=>[ 'dsn'=>$_ENV['DB_DSN'],
   'user'=>$_ENV['DB_USER'],
   'password'=>$_ENV['DB_PASSWORD']]
 
 ];

$app= new APP(__DIR__,[],$config);

$app->database->ImplementMigrations();
?>