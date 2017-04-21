<?php

class Session {
    private $timeout;
    public function __construct(int $timeout = 3600) {
        $this->timeout = $timeout;
        $this->start();
    }
    
    public function __get(string $name) {
        return (isset($_SESSION[$name])) ? $_SESSION[$name] : null;
    }

    public function __set(string $name, $value) {
        $_SESSION[$name] = $value;
    }

    public function __unset(string $name) {
        unset($_SESSION[$name]);
    }
    
    public function __isset(string $name): bool {
        return isset($_SESSION[$name]);
    }

    public function __debugInfo() {
        return $_SESSION;
    }

    public function has_data(): bool {
        return isset($_SESSION) && !empty($_SESSION);
    }

    public function start() {
        if(!isset($_SESSION)){
            session_name("ananas");
            session_start();
            if($this->has_data()) {
                if (isset($_SESSION['LAST_ACTIVITY']) &&
                    (time() - (int)$_SESSION['LAST_ACTIVITY'] > $this->timeout)) {
                    session_unset();
                } else {
                    $_SESSION['LAST_ACTIVITY'] = time();
                }
            }
        }
    }

    public function destroy() {
        if(isset($_SESSION)){
            session_unset();
            session_destroy();
        }
    }
}
