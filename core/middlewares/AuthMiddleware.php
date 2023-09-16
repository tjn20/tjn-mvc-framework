<?php
namespace app\core\middlewares;

use app\core\App;
use app\core\exceptions\ForbiddenException;

class AuthMiddleware extends BaseMiddleware{
    public array $actions=[];
    public function __construct(array $actions=[])
    {
        $this->actions=$actions;
    }
public function execute()
{
    if(!App::$app->session->get('user')){
        if(empty($this->actions) || in_array(App::$app->controller->action,$this->actions)){
            throw new ForbiddenException();
        }
    }
}

}

?>