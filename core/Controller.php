<?php
namespace app\core;

class Controller{
    public string $layout;
    public string $action='';
    private array $middlewares=[];

 
    public function render($view,$params=[]){
        return App::$app->view->renderView($view,$params); 
     } 


     public function registerMiddlewares(\app\core\middlewares\BaseMiddleware $middleware){
        $this->middlewares[]=$middleware;
        
        }
        
        public function getMiddlewares():array{
            return $this->middlewares;
        }

}


?>