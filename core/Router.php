<?php
namespace app\core;

use app\core\exceptions\PageNotFoundException;
class Router{
    public Request $request;
    public Response $response;
    private array $routes=[];
    public function __construct($request,$response)
    {
        $this->response=$response;
        $this->request=$request;
    }


    public function  addPostCallback($path,$callback){
        $this->routes['POST'][$path]=$callback;
    }

    public function  addGetCallback($path,$callback){
        $this->routes['GET'][$path]=$callback;
    }

    public function route(){
       $url=$this->request->getUrlPath();
       $url=$this->checkUrl($url);
       $method=$this->request->getMethodType();
        $callback=$this->routes[$method][$url]??false;
      if(!$callback){
        $callback=$this->getCurrentCallBacks($url,$method);
        if($callback===false)
        throw new PageNotFoundException();
      }

if(is_string($callback)){
    return App::$app->view->renderView($callback);
          }
if(is_array($callback)){
$controller= new $callback[0]();
App::$app->controller=$controller;
$controller->action=$callback[1];
$callback[0]=$controller;
foreach($controller->getMiddlewares() as $middleware){
    $middleware->execute();
   }
}
return call_user_func($callback,$this->request,$this->response);
    }

    private function getCurrentCallBacks($url,$method)
    {
      $url=trim($url,'/');  
      $routes=$this->routes[$method]??[];
     
      foreach($routes as $route=>$callback)
      {
        $route=trim($route,'/');
       
        $newRouteNames=[];
        if(!$route){
          continue;
        }
        if(preg_match_all('/\{(\w+)(:[^}]+)?}/',$route,$matches)){
            $newRouteNames=$matches[1];
           
        }
        $routeRegex="@^".preg_replace_callback('/\{\w+(:([^}]+))?}/',function($m){
           
            return isset($m[2])? "({$m[2]})" : '(\d+)';
        },$route)."$@";
             

        if(preg_match_all($routeRegex,$url,$valueMatches)){
            $newValues=[];
            for($i=1;$i<count($valueMatches);$i++){
                $newValues[]=$valueMatches[$i][0];
               } 
               $this->request->setRouteParams(array_combine($newRouteNames,$newValues));
            return $callback;
        }
    }
    return false;

    }
    private function checkUrl($url){
        if(is_array($url))           
                return '/'.implode('/',$url);
            else
            return $url;        
    }

}

?>