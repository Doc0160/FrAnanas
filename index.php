<?php

require('../core/autoload/autoload.php');

$autoloader = new Autoload();
spl_autoload_register([$autoloader, 'load']);

$autoloader->register('cookie', function(){
    return require('/core/session/Cookie.php');
});

header('Content-Type: text/html; charset=utf-8');

$session = new Session();

$database = Database::getInstance();

$cookie = new Cookie();

$view = new View('/views/');

$router = new Router('/');
$router->setNotFound(function($url) use ($view){
    $view->display('404.php');
});

$controller = new Controller(BASEPATH.'/controllers/', [
    'view' => $view,
    'session' => $session,
    'router' => $router,
]);
