<?php

/**
   Router class
*/
class Router {

    private $routes = [];
    private $notFound;
    private $uri;

    /**
       
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

    /**
       calls add
     */
    public function __set(string $url, callable $action){
        $this->addWithMethod("_", $url, $action);
    }

    public function __debugInfo() {
        return [
            'routes' => $this->routes,
        ];
    }

    public function __invoke()
    {
        $this->dispatch();
    }
    
    public function add(string $url, callable $action){
        return $this->addWithMethod("_", $url, $action);
    }

    public function get(string $url, callable $action){
        return $this->addWithMethod("GET", $url, $action);
    }

    public function post(string $url, callable $action){
        return $this->addWithMethod("POST", $url, $action);
    }
    
    public function addWithMethod(string $method, string $url, callable $action){
        $method = strtoupper($method);
        $url = preg_replace('#:([\w]+)#', '([^/]+)', $url);
        if(isset($this->routes[$method][$this->uri.$url]) ||
           isset($this->routes['_'][$this->uri.$url])) {
            throw new Exception("Path already exist: ".$url);
        }
        $this->routes[$method][$this->uri.$url] = $action;
        
        return $this;
    }

    public function setNotFound(callable $action){
        $this->notFound = $action;
        return $this;
    }
    
    public function dispatch(){
        $_url = $_SERVER['REQUEST_URI'];
        
        if(isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $url => $action){
                if(preg_match("#^".$url."$#i", $_url, $matches)){
                    array_shift($matches);
                    return $action(...$matches);
                }
            }
        }

        if(isset($this->routes['_'])) {
            foreach ($this->routes['_'] as $url => $action) {
                if(preg_match("#^".$url."$#i", $_url, $matches)){
                    array_shift($matches);
                    return $action(...$matches);
                }
            }
        }
        
        call_user_func_array($this->notFound,[$_SERVER['REQUEST_URI']]);
    }

    public function redirect(string $page) {
        header('Location: '.$this->uri.$page);
    }

}


