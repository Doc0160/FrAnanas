<?php

class Cookie {

    private $duration;

    public function __construct(int $duration = 3600) {
        $this->duration = $duration;
    }
    
    public function __get(string $name) {
        return (isset($_COOKIE[$name])) ? $_COOKIE[$name] : null;
    }

    public function __set(string $name, string $value) {
        $this->setWithDuration($name, $value, $this->duration);
    }

    public function __unset(string $name) {
        $this->setWithDuration($name, '', -1);
        unset($_COOKIE[$name]);
    }
    
    public function __isset(string $name): bool {
        return isset($_COOKIE[$name]);
    }
    
    public function __debugInfo() {
        return $_COOKIE;
    }

    public function setWithDuration(string $name, string $value, int $duration) {
        setrawcookie($name, rawurlencode($value), time()+$duration);
    }

}
