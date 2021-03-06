<?php
/**
 * @deprecated
 */
final class Database {
    
    /** @ignore */
    private static $PDOInstance = null;
    /** @ignore */
    private static $dsn         = null;
    /** @ignore */
    private static $username    = null;
    /** @ignore */
    private static $password    = null; 
    /** @ignore */
    private static $options     = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    /** @ignore */
    private function __construct(){
    }

    public static function getInstance(): PDO {
        if(is_null(self::$PDOInstance)){
            if(self::configDone()){
                self::$PDOInstance = new PDO(self::$dsn,
                                             self::$username,
                                             self::$password,
                                             self::$options);
            } else {
                throw new Exception(__CLASS__." : no config !");
            }
        }
        return self::$PDOInstance;
    }

    public static function setConfig(string $dsn,
                                     string $username, string $password,
                                     array $options = []){
        self::$dsn      = $dsn;
        self::$username = $username;
        self::$password = $password;
        self::$options += $options;
    }
    
    /** @ignore */
    private static function configDone(): bool {
        return self::$dsn !== null &&
               self::$username !== null &&
               self::$password !== null;
    }
}


