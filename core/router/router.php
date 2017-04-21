<?php

class Router{

    private $routes = [];
    private $notFound;
    private $uri;

    public function __construct(string $uri = '/'){
        $this->uri = $uri;
        $this->notFound = function($url){
            echo "404 - $url was not found!";
        };
        $this->routes['_'] = [];
    }

    public function __set(string $url, callable $action){
        $this->addWithMethod("_", $url, $action);
    }

    public function __debugInfo() {
        return [
            'routes' => $this->routes,
        ];
    }
    
    public function add(string $url, callable $action){
        $this->addWithMethod("_", $url, $action);
    }

    public function get(string $url, callable $action){
        $this->addWithMethod("GET", $url, $action);
    }

    public function post(string $url, callable $action){
        $this->addWithMethod("POST", $url, $action);
    }

    public function addWithMethod(string $method, string $url, callable $action){
        $url = preg_replace('#:([\w]+)#', '([^/]+)', $url);
        if(isset($this->routes[$method][$this->uri.$url])) {
            throw new Exception("Path already exist: ".$url);
        }
        $this->routes[$method][$this->uri.$url] = $action;
    }

    public function setNotFound(callable $action){
        $this->notFound = $action;
    }
    
    public function dispatch(){
        $_url = $_SERVER['REQUEST_URI'];
        
        if(isset($this->routes[$_SERVER['REQUEST_METHOD']])) {
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $url => $action) {
                if(preg_match("#^".$url."$#i", $_url, $matches)){
                    array_shift($matches);
                    return $action(...$matches);
                }
            }
        }

        foreach ($this->routes["_"] as $url => $action) {
            if(preg_match("#^".$url."$#i", $_url, $matches)){
                array_shift($matches);
                return $action(...$matches);
            }
        }
        
        call_user_func_array($this->notFound,[$_SERVER['REQUEST_URI']]);
    }

    public function redirect(string $page) {
        header('Location: '.$this->uri.$page);
    }

}
