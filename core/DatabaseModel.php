<?php

namespace app\core;

abstract class DatabaseModel{

   abstract public function attributes(): array;
 
    public static function findUser($list,$result=''){
        if($result==='')
        $result=static::class;

            $attributes=array_keys($list);
            $attributes=array_diff($attributes,['table']);
            $params=implode(' AND ',array_map(fn($attr)=>"$attr =  :$attr ",$attributes));
            $sql= APP::$app->database->pdo->prepare("SELECT * FROM {$list['table']} WHERE $params");
            foreach($list as $key=>$value){
                if($key==='table')
                continue;
                $sql->bindValue(":$key",$value);
            }
            $sql->execute();
            
                return $sql->fetchObject($result);
        
    }

    public  function saveUser($user){
        $attributes=$user->attributes();
        $params=array_map(fn($attr)=>":$attr",$attributes);
        $sql= APP::$app->database->pdo->prepare("INSERT INTO {$user::$tableName} (".implode(',',$attributes).")
        VALUES (".implode(',',$params).")");
        foreach($attributes as $attribute){
            $sql->bindValue(":$attribute",$user->{$attribute});


        }
        $sql->execute();
        return true;
    }

}
?>