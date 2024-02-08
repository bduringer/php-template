<?php
namespace app\framework\database;
use PDO;
use PDOException;
class Connection{

    private static $connection = null;
    public static function getConnection(){
        if(empty(self::$connection)){
            try {
                self::$connection = new PDO("mysql:host={$_ENV['DATABASE_HOST']};dbname={$_ENV['DATABASE_NAME']}","{$_ENV['DATABASE_USER']}","{$_ENV['DATABASE_PASSWORD']}",[
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                ]);
            } catch (PDOException $e) {
                echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            }
            
        };

        return self::$connection;
    }
}