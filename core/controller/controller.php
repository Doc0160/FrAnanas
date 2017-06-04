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
     * 
     * @param string $controller Filename
     * @param array $_DATA Data to pass to the controller
     */
    public function execute($controller, array $_DATA = []) {
        $_DATA = array_merge($this->context, $_DATA);
        
        if(is_string($controller)) {
            if(file_exists($this->path.$controller)) {
                set_error_handler(function(...$args) {
                    echo '<pre class="phperror phpcontroller">';
                    trigger_error($args[1]);
                    echo '</pre>';
                    return true;
                });
                
                $f = function($controller) use ($_DATA) {
                    extract($_DATA, EXTR_SKIP);
                    require($controller);
                };
                $f($this->path.$controller);

                restore_error_handler();
                return;
            }
            throw new ControlerException("Controller does not exist: ".$this->path.$controller);

        } else if(is_callable($controller)) {
            set_error_handler(function($errno, $errstr, $errfile, $errline) {
                echo '<pre class="phperror phpcontroller">';
                echo '['.$errno.'] '.$errstr;
                if(!empty($errfile)) {
                    echo PHP_EOL.'File: '. $errfile;
                }
                if(!empty($errline)) {
                    echo '; Line: ' .$errline;
                }
                echo '</pre>';
                return true;
            });
            
            $f = function($controller) use ($_DATA) {
                $controller($_DATA);
            };
            $f($controller);

            restore_error_handler();
            return;
        }
        throw new ControllerException('You can only use functions and filename');
    }
}

/**
 * Controller Exception
 */
class ControllerException extends Exception { }

