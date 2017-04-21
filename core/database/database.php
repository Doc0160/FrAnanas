<?php

final class database {
    private static $PDOInstance = null;
    private static $dsn         = null;
    private static $username    = null;
    private static $password    = null;
    private static $options     = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    private function __construct(){
    }

    public static function getInstance(): PDO {
        if(is_null(self::$PDOInstance)){
            if(self::configDone()){
                self::$PDOInstance = new PDO(self::$dsn, self::$username, self::$password, self::$options);
            }else{
                throw new Exception(__CLASS__." : no config !");
            }
        }
        return self::$PDOInstance;
    }

    public static function setConfig(string $dsn,
                                     string $username, string $password,
                                     array $options = array()){
        self::$dsn      = $dsn;
        self::$username = $username;
        self::$password = $password;
        self::$options += $options;
    }

    private static function configDone(): bool {
        return self::$dsn !== null &&
               self::$username !== null &&
               self::$password !== null;
    }
}

database::setConfig('mysql:host='.DATABASE_HOST.';'.
                    'port='.DATABASE_PORT.';'.
                    'dbname='.DATABASE_DATABASE.';'.
                    'charset=utf8',
                    DATABASE_USERNAME, DATABASE_PASSWORD);

?>
