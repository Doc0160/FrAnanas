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

    public function execute(string $name, array $data = []) {
        $data = array_merge($data, $this->context);
        {
            require($this->path.$name);
        }
    }
}

?>
