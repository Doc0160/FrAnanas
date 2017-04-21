<?php

class Cookie {
    
    public function __get(string $name) {
        return (isset($_COOKIE[$name])) ? $_COOKIE[$name] : null;
    }

    public function __set(string $name, string $value) {
        setcookie($name, $value, time()+60*60);
    }

    public function __unset(string $name) {
        setcookie($name, '', time()-1);
    }
    
    public function __isset(string $name): bool {
        return isset($_COOKIE[$name]);
    }

    
    public function __debugInfo() {
        return $_COOKIE;
    }

}
