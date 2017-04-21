<?php

class Autoload{

    private $path;
    
    public function __construct(string $path = '') {
        $this->path = $path;
    }

    private $autoloadable = [];

    public function register($name, $loader = false){
        if(is_callable($loader) || $loader == false){
            $this->autoloadable[$name] = $loader;
            return;
        }
        throw new Exception('Loader must be callable '.$name);
    }

    public function load($name){
        $name = strtolower($name);
        $filepath = $this->path.'core/'.$name.'/'.$name.'.php';
        
        if(!empty($this->autoloadable[$name])){
            return $this->autoloadable[$name]($name);
        }
        
        if(file_exists($filepath)){
            return require($filepath);
        }
        
        throw new Exception($name.' is not loaded or registred for autoloading');
    }
}
