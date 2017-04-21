<?php

class View{

    private $context;
    private $path;
    
    public function __construct(string $path, array $context = []) {
        $this->path = $path;
        $this->sanitize($context);
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
    
    public function display($view, array $_DATA = []) {
        
        $this->sanitize($_DATA);
        $_DATA = array_merge($_DATA, $this->context);
        if(is_string($view)) {
            if(file_exists($this->path.$view)) {
                $f = function($path) use ($_DATA) {
                    require($path);
                };
                $f($this-path.$view);
                return;
            }
            throw new Exception("View does not exist: ".$this->path.$view);
            
        }else if (is_callable($view)) {
            $f = function($fn) use ($_DATA) {
                $fn($_DATA);
            };
            $f($view);
            return;
        }
        throw new Exception('You can only use functions and filename');
    }
}
