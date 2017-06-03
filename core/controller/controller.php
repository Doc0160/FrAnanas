<?php
/**
 * Controler systeme file
 */

/**
 * Controller Class
 */
class Controller {
    /** @ignore */
    private $path;
    /** @ignore */
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

    /** @ignore */
    public function __debugInfo() {
        return $context;
    }
    
    /**
     * Execute a controller file
     * $_DATA in the controller file to refer to what's been passed to it
     * @param string $name Filename
     * @param array $_DATA Data to pass to the controller
     */
    public function execute($controller, array $_DATA = []) {
        $_DATA = array_merge($this->context, $_DATA);
        
        if(is_string($controller)) {
            if(file_exists($this->path.$controller)) {
                $f = function($controller) use ($_DATA) {
                    extract($_DATA, EXTR_SKIP);
                    require($controller);
                };
                $f($this->path.$controller);
                return;
            }
            throw new ControlerException("Controller does not exist: ".$this->path.$controller);
        } else if(is_callable($controller)) {
            $f = function($controller) use ($_DATA) {
                $controller($_DATA);
            };
            $f($controller);
            return;
        }
        throw new ControllerException('You can only use functions and filename');
    }
}

class ControllerException extends Exception { }

