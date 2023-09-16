<?php
namespace app\models;

class SignUp extends \app\core\Model{
    public string $firstname='';
    public string $lastname='';
    public string $email='';
    public string $password='';
    public string $confirmPassword='';
    public static $tableName="temp_users";
    public function rules():array{
       return [
        'firstname'=>[self::REQUIRED_RULE],
        'lastname'=>[self::REQUIRED_RULE],
        'email'=>[self::REQUIRED_RULE,self::EMAIL_RULE,self::UNIQUE_RULE],
        'password'=>[self::REQUIRED_RULE,[self::MIN_RULE,'min'=>8],[self::MAX_RULE,'max'=>20]],
        'confirmPassword'=>[self::REQUIRED_RULE,[self::MATCH_RULE,'match'=>'password']]
    ];

    
    }

    public function saveUser($user){
    $this->password=password_hash($this->password,PASSWORD_BCRYPT);
        return parent::saveUser($user);
    }

public function getValue($attribute)
{
    return $this->$attribute;
}
public function attributes(): array{
return ['firstname','lastname','email','password'];
}


   
}
?>
