<?php

class View{

    private $context;
    private $path;
    
    public function __construct(string $path, array $context = []) {
        $this->path = $path;
        $this->context = $context;
    }

    private function sanitize(array &$data) {
        foreach($data as $key => &$value) {
            if(is_null($value) ||
               is_callable($value)) {
                unset($value);
                
            } elseif(is_array($value)) {
                $this->sanitize($value);
                
            } elseif(is_object($value)) {
                $value = (array) $value;
                
            } elseif(is_string($value)) {
                $value = htmlentities($value);
                
            }
        }
    }

    public function display(string $viewName, array $data = []) {
        /*echo */
        $this->sanitize($data);
        $data = array_merge($data, $this->context);
        if(file_exists($this->path.$viewName)) {
            require($this->path.$viewName);
            return;
        }
        throw new Exception("View does not exist: ".$this->path.$viewName);

    }
}
