<?php

//TODO: handle files

class Input {

    private $input;

    public function __construct() {
        $this->input = array_merge($_POST, $_FILES, $_GET);
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

    public function get() {
        return $_GET;
    }

    public function post() {
        return $_POST;
    }

    public function files() {
        return $_FILES;
    }

    public function raw() {
        return file_get_contents("php://input");
    }
    
}

