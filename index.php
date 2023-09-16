<?php


require_once __DIR__.'/vendor/autoload.php';

use app\controllers\AuthController;
use app\controllers\SiteController;
use Dotenv\Dotenv;
use app\core\App;
$dotenv=Dotenv::createImmutable(__DIR__);
$dotenv->load();

/*
** MODEL FILE NAMES MUST BE THE SAME 
AS VIEW FILES NAME IN CASE YOU WILL HAVE ANY.
*/

$pages=array(
   'layout'=>[
    'main'=>'mainlayout.php',
   ],
   'view'=>[
    '/'=>'home.php',
    'home'=>'home.php',
    'about'=>'about.php',
    'login'=>'login.php',
    'register'=>'signup.php',
    'profile'=>'profile.php',
    'admin'=>'admin.php',
    'exception'=>'_errorPage.php',
   ]
);


$databaseconfig=[
   'user'=>\app\models\SignUp::class,
  'database'=>[ 'dsn'=>$_ENV['DB_DSN'],
  'user'=>$_ENV['DB_USER'],
  'password'=>$_ENV['DB_PASSWORD']]

];


$app = new App(__DIR__,$pages,$databaseconfig);


$app->router->addGetCallback('/',[SiteController::class,'homePage']);
$app->router->addGetCallback('home',[SiteController::class,'homePage']);
$app->router->addGetCallback('about',[SiteController::class,'aboutPage']);
$app->router->addGetCallback('register',[AuthController::class,'signUp']);
$app->router->addPostCallback('register',[AuthController::class,'signUp']);
$app->router->addGetCallback('login',[AuthController::class,'login']);
$app->router->addPostCallback('login',[AuthController::class,'login']);
$app->router->addGetCallback('logout',[AuthController::class,'logout']);
$app->router->addGetCallback('admin',[AuthController::class,'admin']);
$app->router->addGetCallback('profile/{id:\d+}',[AuthController::class,'profile']);

$app->startApp();

?>