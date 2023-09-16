<?php
namespace app\core;

class Request{
    private array $routeParams=[];

    public function getUrlPath(){
  $path=$_GET['url']??'/';  
if($path!='/')
$path=explode('/',$path);


return $path==='/'?$path:((count($path)>1)?$path:$path[0]);

}

    public function getMethodType(){
        return $_SERVER['REQUEST_METHOD'];
    }


    public function getPageBody(){
        $pageBody=[];
        if($this->getMethodType()==='GET'){
            foreach($_GET as $key=>$value)
                $pageBody[$key]=filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if($this->getMethodType()==='POST'){
            foreach($_POST as $key=>$value)
            $pageBody[$key]=filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $pageBody;
    }

    public function setRouteParams($params){
        $this->routeParams=$params;
    }
    public function getRouteParams(){
       return $this->routeParams;
    }
}

?>