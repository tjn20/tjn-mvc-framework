<?php

namespace app\core;

class View{
    private array $pages =[];

    public function __construct($pages)
    {
        $this->pages=$pages;
    
    }

    public function renderView($view,$params=[]){
        $viewContent=$this->renderEachView($view,$params);
        $layoutContent=$this->renderLayoutContent();

        return str_replace('{{pageContent}}',$viewContent,$layoutContent);
    }

    public function renderEachView($view,$params){
        $exceptionsArray=array_keys($params);
        $exceptionFound=in_array('exception',$exceptionsArray);
        foreach($params as $key=>$value){
            $$key= $value; // this approach means to assign the key value to variable value
           
        }
        if($exceptionFound){
            $view=$this->getPage('exception');
        }
        else{
            $view=$this->getPage($view);
        }
        ob_start();
        include_once App::$ROOT_PATH."/views/$view";
      return ob_get_clean();
    }
    public function renderLayoutContent(){
$layout=App::$app->layout;
ob_start();
include_once App::$ROOT_PATH."/views/layouts/{$layout}";
return ob_get_clean();
    }
 
    
     public function getPage($view){
        return $this->pages['view'][$view];    
     }

     
    
}
?>