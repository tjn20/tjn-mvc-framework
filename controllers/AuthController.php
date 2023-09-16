<?php
namespace app\controllers;

use app\core\App;
use app\core\DatabaseModel;
use app\core\exceptions\UserNotFoundException;
use app\core\Request;
use app\core\Response;
use app\models\SignUp;
use app\models\login;

class AuthController extends \app\core\Controller{
  public function __construct()
  {
      $this->registerMiddlewares(new \app\core\middlewares\AuthMiddleware(['admin']));
  }
    public function signUp(Request $request){
        $userRegister= new SignUp();
      if($request->getMethodType()==='POST'){
      $userRegister->loadPageData($request->getPageBody());
      if($userRegister->validateForm() && $userRegister->saveUser($userRegister)){
        Response::redirectPage('home');
      } 

return $this->render('register',[
    'model'=>$userRegister
    ]);
      }

        return $this->render('register',[
            'model'=>$userRegister
        ]);

    }
    public function login(Request $request){
        $userRegister= new login();
      if($request->getMethodType()==='POST'){
      $userRegister->loadPageData($request->getPageBody());
      if($userRegister->validateForm() && $userRegister->login()){
        Response::redirectPage('home');
        return;
      } 
     

return $this->render('login',[
    'model'=>$userRegister
    ]);
      }

        return $this->render('login',[
            'model'=>$userRegister
        ]);

    }

    public function logout(){
        App::$app->logout();
        Response::redirectPage('home');   
     }

     public function profile(Request $request)
     {
        $userId=$request->getRouteParams()['id'];
        $getSession=App::$app->session->get('user');
        $getUser=DatabaseModel::findUser([
            'table'=>'temp_users',
            'id'=>$userId
        ],$this::class);
if(!$getUser){
  throw new UserNotFoundException();
}
if($getUser->id===$getSession)
$message="your account";
else
$message=$getUser->firstname." ".$getUser->lastname;

        return $this->render('profile',[
            'id'=>$message
        ]);
    }

    public function admin(Request $request){
      return $this->render('admin');
    }


}

?>