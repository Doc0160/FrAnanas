<?php

require('core/autoload/autoload.php');

$autoloader = new Autoload();
spl_autoload_register([$autoloader, 'load']);

$autoloader->register('cookie', function(){
    return require('core/session/Cookie.php');
});

$session = new Session();

Database::setConfig('mysql:host=localhost;'.
                    'port=3306;'.
                    'dbname=ananas;'.
                    'charset=utf8',
                    'root', '');
$database = Database::getInstance();

$cookie = new Cookie();

$view = new View('/views/');

$router = new Router();
$router->setNotFound(function($url) use ($view){
    //$view->display('404.php');
    $view->display(function($_DATA) {
        var_dump($_DATA);
    }, ['error' => '404', 'url' => $url]);
});

$controller = new Controller('/controllers/');

$router->add('/', function() {
    echo 'index.php !!!';
});

function test() {
    echo 'test';
}	 
// add a 'GET' method route
$router->get('/test', 'test');

$router->dispatch();
