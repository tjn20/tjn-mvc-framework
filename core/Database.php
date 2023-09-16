<?php

namespace app\core;

use app\migrations\m01_initialize;

class Database{

    public \PDO $pdo;

    public function __construct( array $databaseConfigs)
    {
        try {

            $this->pdo = new \PDO(
                $databaseConfigs['dsn'] ?? '',
                $databaseConfigs['user'] ?? '',
                $databaseConfigs['password'] ?? ''
            );
        
            // Set PDO error mode to exception for better error handling
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        
          
        } catch (\PDOException $e) {
            // Handle any connection errors here
            echo "Database connection failed: " . $e->getMessage();
        }
    }

    public function ImplementMigrations(){
        $this->createMigrationTable();
        $getMigrations=$this->getImplementMigrations();

        $migrations=[];

        $migrationsFiles=scandir(App::$ROOT_PATH.'/migrations');
        

        $newMigrations=array_diff($migrationsFiles,$getMigrations);

        $filteredMigrations = array_diff($newMigrations, ['.', '..']);

        foreach($filteredMigrations as $migration){
            require_once App::$ROOT_PATH.'/migrations/'.$migration;
            $migrationClass="app\migrations\\".pathinfo($migration,PATHINFO_FILENAME);
        if(class_exists($migrationClass)){
            $mig= new $migrationClass();
          

            // To check if the migration is applying
                       echo "Migration being Applied: ".$migration;
                       $mig->up();
                        // To check if the migration is applied
                        echo "Migration Applied: ".$migration;
                        $migrations[]=$migration;
                   
           
                   if(!empty($migrations))
                   $this->saveCreatedMigrations($migrations);
                   else
                   // To check if the migrations are already applied
                   echo "Migrations are Applied";   
        }
        else
        echo "Class $migration does not exist.";


      
    }
}

    public function createMigrationTable(){
        $this->pdo->exec(
            "CREATE TABLE IF NOT EXISTS mvc_migrations(
                migration_id INT AUTO_INCREMENT PRIMARY KEY,
                migration VARCHAR(200),
                creation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB"
        );
    }

    public function getImplementMigrations(){
        $sqlStatement=$this->pdo->prepare("SELECT migration FROM mvc_migrations");
        $sqlStatement->execute();

        return $sqlStatement->fetchAll(\PDO::FETCH_COLUMN);


    }

    public function saveCreatedMigrations(array $migrations){
        
        $sqlImports = implode(',', array_map(fn($migration) => "('$migration')", $migrations));
        $sqlStatement=$this->pdo->prepare("INSERT INTO mvc_migrations(migration) VALUES (
            {$sqlImports}
        )");

        $sqlStatement->execute();

    }

    public function prepareSqlStatement($sql){
        return $this->pdo->prepare($sql);
    }


   



}
?>