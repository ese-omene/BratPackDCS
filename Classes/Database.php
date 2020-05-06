<?php

class Database {
    private static $user = 'eseomene_wp53';
    private static $password = 'pSH9]3-Iu2';

    private static $dsn = 'mysql:host=localhost;dbname=eseomene_wp53' ;
    private static $dbcon;

    private function __construct()
    {

    }

    public static function getDb()
    {
        if (!isset(self::$dbcon)){
            try{
                self::$dbcon = new PDO(self::$dsn, self::$user, self::$password);
            } catch (PDOException $e) {
                $msg = $e->getMessage();
                include ("errorMessage.php");
                exit();
            }
        }
        return self::$dbcon;
    }

}