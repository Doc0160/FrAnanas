<?php
/**
 * View Class File
 */

/**
 * View Class
 */
class View{

    /** @ignore */
    private $context;
    /** @ignore */
    private $path;

    /**
     * Constructor
     *
     * @param string $path Path to the view files
     * @param array $context
     */
    public function __construct(string $path, array $context = []) {
        $this->path = $path;
        $this->sanitize($context);
        $this->context = $context;
    }

    /**
     * Sanatize array before passing it to the view
     *
     * @param array &$data
     */
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

    /**
     * Display a view
     *
     * @param $view
     * @param array $_DATA
     */
    public function display($view, array $_DATA = []) {
        $this->sanitize($_DATA);
        $_DATA = array_merge($this->context, $_DATA);
        
        if(is_string($view)) {
            if(file_exists($this->path.$view)) {
                set_error_handler(function($errno, $errstr, $errfile, $errline) {
                    echo '<pre class="phperror phpview">';
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

                ob_start();
                $f = function($view) use ($_DATA) {
                    extract($_DATA, EXTR_SKIP);
                    require($view);
                };
                $f($this->path.$view);
                $out = ob_get_clean();
                
                restore_error_handler();
                echo $out;
                return;
            }
            throw new ViewException("View does not exist: ".$this->path.$view);
        }
        throw new ViewException('You can only use functions and filename');
    }
}

/**
   View Exception
 */
class ViewException extends Exception { }
