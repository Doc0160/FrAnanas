<?php

class Input {

    private $input;

    public function __construct() {
        $this->input = array_merge($_POST, $_FILES);
    }

    public function __get(string $name) {
        return isset($this->input[$name]) ? $this->input[$name] : null;
    }

    public function __isset(string $name) {
        return $this->input[$name];
    }

    public function __debugInfo() {
        return $this->input;
    }
    
}

