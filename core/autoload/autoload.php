<?php
/**
 * Autoload System File
 */

/**
 * Class Autoloader
 */
class Autoload{

    /**
     * @ignore
     */
    private $path;
    /**
     * @ignore
     */
    private $autoloadable = [];
    
    /**
     * Constructor
     * @param string $path
     */
    public function __construct(string $path = '') {
        $this->path = $path;
    }

    /**
     * Register new thing to be loaded
     * @param string $name
     * @param $loader
     */
    public function register(string $name, $loader = false){
        if(is_callable($loader) || $loader == false){
            $this->autoloadable[$name] = $loader;
            return;
        }
        throw new Exception('Loader must be callable '.$name);
    }
    
    /**
     * To be called be the autoload thingy
     * @param string $name
     */
    public function load(string $name) : bool {
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


