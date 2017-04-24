<?php

class Controller {
    private $path;
    private $context;
    
    public function __construct(string $path, array $context = []) {
        $this->path = $path;
        $this->context = $context;
    }

    public function __debugInfo() {
        return $this;
    }

    public function execute(string $name, array $_DATA = []) {
        $_DATA = array_merge($_DATA, $this->context);
        require($this->path.$name);
    }
}



