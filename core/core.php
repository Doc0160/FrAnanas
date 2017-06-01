<?php


require('autoload/autoload.php');

$autoloader = new Autoload();
spl_autoload_register([$autoloader, 'load']);

$view = new View('./views/');

$controller = new Controller('./controllers/');

$router = new Router('./routes');
