<?php
namespace app\controllers;

class SiteController extends \app\core\Controller{
public function homePage(){
    $params=[
        'name'=>"TJN"
    ];
    return $this->render('home',$params);
}
public function aboutPage(){
    $params=[
        'name'=>"TJN"
    ];
    return $this->render('about',$params);
}
}
?>