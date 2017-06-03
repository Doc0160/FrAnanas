<?php
/**
 * Controler systeme file
 */

/**
 * Controller Class
 */
class Controller {
    /**
     * @ignore
     */
    private $path;
    /**
     * @ignore
     */
    private $context;

    /**
     * Constructor
     * @param string $path Path to search for controllers
     * @param array $context
     */
    public function __construct(string $path, array $context = []) {
        $this->path = $path;
        $this->context = $context;
    }

    /**
     * @ignore
     */
    public function __debugInfo() {
        return [];
    }
    
    /**
     * Execute a controller file
     * $_DATA in the controller file to refer to what's benn passed to it
     * @param string $name Filename
     * @param array $_DATA Data to pass to the controller
     */
    public function execute(string $name, array $_DATA = []) {
        $_DATA = array_merge($this->context, $_DATA);
        foreach($_DATA as $_key => $_value) {
            $$_key = $_value;
        }
        if(file_exists($this->path.$name)) {
            require($this->path.$name);
        }
        throw new Exception('You can only use functions and filename');
        /*$f = function($name) use ($_DATA) {
           foreach($_DATA as $_key => $_value) {
           $$_key = $_value;
           }
           require($name);
           };
           $f($this->path.$view);*/
    }
}



