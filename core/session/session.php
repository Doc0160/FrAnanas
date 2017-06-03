<?php

/**
 * Session Class
 */
class Session {
    /** @ignore */
    private $timeout;
    /** @ignore */
    private $name;

    public function __construct(string $name='frananas', int $timeout = 3600) {
        $this->timeout = $timeout;
        $this->name = $name;
        $this->start();
    }
    
    public function &__get(string $name) {
        if(isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            $null = null;
            return $null;
        }
    }

    public function __set(string $name, $value):void {
        $_SESSION[$name] = $value;
    }

    public function __unset(string $name):void {
        unset($_SESSION[$name]);
    }
    
    public function __isset(string $name):bool {
        return isset($_SESSION[$name]);
    }
    
    /** @ignore */
    public function __debugInfo() {
        return $_SESSION;
    }

    /*public function has_data(): bool {
       return isset($_SESSION) && !empty($_SESSION);
       }*/

    public function start():void {
        if(!session_id()) {
            // NOTE(doc): javascript shouldn't be able to see the session cookie
            ini_set("session.cookie_httponly", "1");
            // NOTE(doc): url's should never contain session id's
            ini_set("session.use_trans_sid", "0");
            ini_set("session.use_only_cookies", "1");
            if (!empty($_SERVER["HTTPS"])) {
                // NOTE(doc): a good idea to set this in php.ini
                ini_set("session.cookie_secure", "1");
            };
            session_name($this->name);
            session_start();
            // rotate session id on first request in session
            if (!isset($_SESSION["__SESSION_VALIDATED"])) {
                session_regenerate_id(true);
                $_SESSION["__SESSION_VALIDATED"] = true;
            }
            // generate an anti-CSRF token
            if (!isset($_SESSION["__ANTI_CSRF_TOKEN"])) {
                $_SESSION["__ANTI_CSRF_TOKEN"] = md5(uniqid());
            }
            //if($this->has_data()) {
            if (isset($_SESSION['__LAST_ACTIVITY']) &&
                (time() - (int)$_SESSION['__LAST_ACTIVITY'] > $this->timeout)) {
                $this->restart();
            } else {
                $_SESSION['__LAST_ACTIVITY'] = time();
            }
            //}
        } else {
            if (ini_get("session.auto_start")) {
                throw new Exception("disable session.auto_start in php.ini");
            }
        }
    }

    public function destroy():void {
        if(session_id()){
            session_unset();
            session_destroy();
        }
    }

    public function restart():void {
        $this->destroy();
        $this->start();
    }
    
    public function get_csrf_token():string {
        if (!session_id()) $this->start();
        return $_SESSION["__ANTI_CSRF_TOKEN"];
    }

    public function is_csrf_protected($token = ""):bool {
        if (empty($token) && isset($_REQUEST["csrftoken"])) {
            $token = $_REQUEST["csrftoken"];
        }
        return $token === $this->get_csrf_token();
    }
    
}
