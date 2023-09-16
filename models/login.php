<?php

namespace app\models;

use app\core\Model;
use app\core\App;

class Login extends Model{

    public string $email='';
    public string $password='';
    public static $tableName="temp_users";
    public function rules(): array {
        return [
            'email'=>[self::REQUIRED_RULE,self::EMAIL_RULE,self::EMAIL_DOESNT_EXIST_RULE],
            'password'=>[self::REQUIRED_RULE,self::PASSWORD_DOESNT_EXIST_RULE]
        ];

    }

    public function attributes(): array{
        return ['email','password'];
        }

        public function getValue($attribute)
        {
            return $this->$attribute;
        }

        public function login(){

            return App::$app->login(self::findUser(['table'=>self::$tableName,'email'=>$this->email]));
        }

}
?>