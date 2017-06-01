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

    /*public function __debugInfo() {
       return $this;
       }*/
    
    /**
     * Execute a controller file
     * $_DATA in the controller file to refer to what's benn passed to it
     * @param string $name Filename
     * @param array $_DATA Data to pass to the controller
     */
    public function execute(string $name, array $_DATA = []) {
        $_DATA = array_merge($this->context, $_DATA);
        require($this->path.$name);
    }
}



