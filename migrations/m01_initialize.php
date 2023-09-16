<?php

namespace app\migrations;

class m01_initialize{


    public function up(){
        $db=\app\core\App::$app->database;
        $SQL= "Create Table temp_users(
            id INT AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(255) NOT NULL,
            firstname VARCHAR(255) NOT NULL,
            lastname VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP default CURRENT_TIMESTAMP
        ) ENGINE=INNODB;";
        $db->pdo->exec($SQL); 
    }

    public function down(){

        $db=\app\core\App::$app->database;
        $SQL="DROP TABLE temp_users";
        $db->pdo->exec($SQL); 

    }
}
?>