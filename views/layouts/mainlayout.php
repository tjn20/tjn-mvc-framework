<?php

$appObject= \app\core\App::$app;


$params=$appObject->router->request->getUrlPath();
if(is_array($params))
$params=implode('/',$appObject->router->request->getUrlPath());
$homePage=false;
if($params==='/')
$homePage=true;
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MVC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Menu</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo !$homePage?str_replace($params,'home',$_SERVER['REQUEST_URI']):'home'; ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo !$homePage?str_replace($params,'contact',$_SERVER['REQUEST_URI']):'contact'; ?>">Contact</a>
        </li>
       <?php 
       if($appObject->session->get('user')):?>
       <li class="nav-item">
        <a href="<?php echo !$homePage?str_replace($params,'logout',$_SERVER['REQUEST_URI']):'logout'; ?>" class="nav-link">Logout</a>
       </li>
       <li class="nav-item">
       <a href="<?php echo "profile/{$appObject->session->get('user')}"; ?>" class="nav-link">my Profile </a>
       </li>
       <li class="nav-item">
        <a href="<?php echo !$homePage?str_replace($params,'admin',$_SERVER['REQUEST_URI']):'admin'; ?>" class="nav-link">admin Page</a>
       </li>
       <?php else: ?>
       <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo !$homePage?str_replace($params,'login',$_SERVER['REQUEST_URI']):'login'; ?>">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="<?php echo !$homePage?str_replace($params,'register',$_SERVER['REQUEST_URI']):'register'; ?>">Register</a>
        </li>
        <?php endif;?>
      </ul>
    </div>
  </div>
</nav> 
   <div class="container">
   {{pageContent}}
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  </body>
</html>