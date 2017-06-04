<?php
/**
 * Router Class File
 */

/**
 *  Router class
 */
class Router {

    /** @ignore */
    private $routes = [];
    /** @ignore */
    private $notFound;
    /** @ignore */
    private $uri;

    /**
     * Constructor
     * 
     * @param string $uri
     */
    public function __construct(string $uri = ''){
        $this->uri = $uri;
        $this->notFound = function($url){
            echo "404 - $url was not found!";
        };
    }

    // TODO
    /*
       public function __isset(string $isurl) {
       foreach($this->routes as $type => $routes) {
       foreach($routes as $k => $url) {
       if($url == $isurl) {
       return true;
       }
       }
       }
       return false;
       }
     */

    /** @ignore */
    public function __set(string $url, callable $action){
        $this->addWithMethod("_", $url, $action);
    }

    /** @ignore */
    public function __debugInfo() {
        return [
            'routes' => $this->routes,
        ];
    }
    
    /** @ignore */
    public function __invoke()
    {
        $this->dispatch();
    }
    
    /**
     * add route
     * @param string $url
     * @param callable $action
     */
    public function add(string $url, callable $action){
        return $this->addWithMethod("_", $url, $action);
    }
    
    /**
     * add get route
     * @param string $url
     * @param callable $action
     */
    public function get(string $url, callable $action){
        return $this->addWithMethod("GET", $url, $action);
    }

    /**
     * add post route
     * @param string $url
     * @param callable $action
     */
    public function post(string $url, callable $action){
        return $this->addWithMethod("POST", $url, $action);
    }
    
    /**
     * add a route with a method
     *
     * $url:
     * - /test
     * - /test/* matches /test, /test/truc, /test/b/aaaa/ggg, ...
     * - /test/:id matches /test/a, /test/1, /test/test, /test/me
     *
     * @param string $method
     * @param string $url
     * @param callable $action
     */
    public function addWithMethod(string $method, string $url, callable $action){
        $method = strtoupper($method);
        $url = preg_replace('#:([\w]+)#', '([^/]+)', $url);
        $url = preg_replace('#\*#', '(.*)', $url);
        
        if(isset($this->routes[$method][$this->uri.$url]) ||
           isset($this->routes['_'][$this->uri.$url])) {
            throw new RouterException("Path already exist: ".$url);
        }
        $this->routes[$method][$this->uri.$url] = $action;
        
        return $this;
    }
    /**
     * Add callback for 404 cases
     * @param callable $action
     */
    public function setNotFound(callable $action){
        $this->notFound = $action;
        return $this;
    }

    /**
     * Dispatch routes
     */
    public function dispatch(){
        set_error_handler(function($errno, $errstr, $errfile, $errline) {
            echo '<pre class="phperror phprouter">';
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
        
        $_url = $_SERVER['REQUEST_URI'];
        $_method = $_SERVER['REQUEST_METHOD'];
        
        if(isset($this->routes[$_method])) {
            foreach($this->routes[$_method] as $url => $action){
                if(preg_match("#^".$url."$#i", $_url, $matches)){
                    array_shift($matches);
                    $ret = $action(...$matches);
                    restore_error_handler();
                    return $ret;
                }
            }
            unset($url, $action);
        }

        if(isset($this->routes['_'])) {
            foreach($this->routes['_'] as $url => $action) {
                if(preg_match("#^".$url."$#i", $_url, $matches)){
                    array_shift($matches);
                    $ret = $action(...$matches);
                    restore_error_handler();
                    return $ret;
                }
            }
            unset($url, $action);
        }
        
        call_user_func_array($this->notFound,[$_url]);
        restore_error_handler();
    }

    /**
     * Redirect
     * 
     * @param string $page Route to redirect to
     */
    public function redirect(string $page):void {
        header('Location: '.$this->uri.$page);
    }

}

/**
 * Router Exception
 */
class RouterException extends Exception { }
