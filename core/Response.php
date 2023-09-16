<?php
namespace app\core;

class Response{
 
    public function setPageStatusCode(int $code){
        http_response_code($code);
    }


    public static function redirectPage(String $url){
        header('Location:'.$url);
    }

}

?>