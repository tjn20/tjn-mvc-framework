<?php
namespace app\core;


abstract class Model extends DatabaseModel{
   private array $errors;
   public static Model $model;
   public const REQUIRED_RULE='required';
   public const EMAIL_RULE='email';
   public const MIN_RULE='min';
   public const MAX_RULE='max';
   public const PASSWORD_RULE='password';
   public const MATCH_RULE='match';
   public const UNIQUE_RULE='unique';
   public const EMAIL_DOESNT_EXIST_RULE="email_doesn't_exist";
   public const PASSWORD_DOESNT_EXIST_RULE="password_doesn't_exist";

   public function __construct()
   {
   self::$model=$this;
   }
   abstract public function rules(): array; // it must return an array


   public function loadPageData($data){
    foreach($data as $key=>$value){
        if(property_exists($this,$key)) // firstname,lastname
        $this->{$key}=$value;
    }
    
   }
   public function validateForm(){
    foreach($this->rules() as $ruleName => $rules){
        $value=$this->{$ruleName}; // firstname,lastname
        foreach($rules as $rule){
            $validationName=$rule;
            if(!is_string($validationName))
            $validationName=$rule[0];
            if($validationName===self::REQUIRED_RULE && !$value)
            $this->addErrorForRule($ruleName,self::REQUIRED_RULE);
            if($validationName===self::EMAIL_RULE && !filter_var($value,FILTER_VALIDATE_EMAIL))
            $this->addErrorForRule($ruleName,self::EMAIL_RULE);
            if($validationName===self::MIN_RULE && strlen($value)<$rule['min'])
            $this->addErrorForRule($ruleName,self::MIN_RULE,$rule);
            if($validationName===self::MAX_RULE && strlen($value)>$rule['max'])
            $this->addErrorForRule($ruleName,self::MAX_RULE,$rule);
            if($validationName===self::MATCH_RULE && $value!==$this->{$rule['match']}){
                $this->addErrorForRule($ruleName,self::MATCH_RULE,$rule);
            }
            if($validationName===self::UNIQUE_RULE || $validationName===self::EMAIL_DOESNT_EXIST_RULE){
                $data=[
                    'table'=>static::$tableName,
                    'email'=>$value,
                    
                ];

                $object=self::findUser($data);
              
                if($object){
                    if($validationName==self::UNIQUE_RULE)
                    $this->addErrorForRule($ruleName,self::UNIQUE_RULE);
                
                }
                else if($validationName==self::EMAIL_DOESNT_EXIST_RULE)
                $this->addErrorForRule($ruleName,self::EMAIL_DOESNT_EXIST_RULE);

                
            }

            if($validationName===self::PASSWORD_DOESNT_EXIST_RULE){
                $data=[
                    'table'=>static::$tableName,
                    'email'=>$this->email,
                    
                ];
                $object=self::findUser($data);
                if($object)
                (password_verify($value,$object->password))?'':$this->addErrorForRule($ruleName,self::PASSWORD_DOESNT_EXIST_RULE);

            }
           
        }
    }
    return empty($this->errors);

   }

   public function addErrorForRule(string $ruleName,string $errorType,$params=[]){

    $message=$this->errorMessages()[$errorType]??'';
    foreach($params as $key=>$value){
        $message=str_replace("{{$key}}",$value,$message);
    }
    $this->errors[$ruleName][]=$message;
    
   }

   public function addError(string $ruleName,string $errorType){
    $this->errors[$ruleName][]=$errorType;
   }
   
   public function errorMessages(){
    return [
        self::REQUIRED_RULE=>'Please fill this field',
        self::EMAIL_RULE=>'Please enter a valid email address',
        self::MIN_RULE=>'Min length of  password must be {min}',
        self::MAX_RULE=>'Max length of  password must be {max}',
        self::MATCH_RULE=>'This field must be the same as {match}',
        self::UNIQUE_RULE=>'This email already exists',
        self::EMAIL_DOESNT_EXIST_RULE=>"This email doesn't exist",
        self::PASSWORD_DOESNT_EXIST_RULE=>'incorrect password'
    ];
}

public function hasError($ruleName){
    return $this->errors[$ruleName] ?? false;
}

public function getFirstError($ruleName){
    return $this->errors[$ruleName][0]??false;
}
public function getAllErrors(){
    return $this->errors;
}

public function getValue($attribute){
    return static::getValue($attribute);
}

public function saveUser($user){
return parent::saveUser($user);
}
}
?>