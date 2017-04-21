<?php

require('../core/autoload/autoload.php');

$autoloader = new Autoload();
spl_autoload_register([$autoloader, 'load']);

$autoloader->register('cookie', function(){
    return require('/core/session/Cookie.php');
});

$session = new Session();

$database = Database::getInstance();

$cookie = new Cookie();

$view = new View('/views/');

$router = new Router('/');
$router->setNotFound(function($url) use ($view){
    $view->display('404.php');
});

$controller = new Controller('/controllers/');



$router->dispatch();
