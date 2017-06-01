<?php

require('../core/core.php');

Database::setConfig('mysql:host=localhost;'.
                    'port=3306;'.
                    'dbname=ananas;'.
                    'charset=utf8',
                    'root', '');
$database = Database::getInstance();

$cookie = new Cookie();

$router->setNotFound(function($url) {
    global $view;
    
    $view->display('404.php', ['url' => $url]);
});

$input = new Input();

$router->add('/', function() {
    echo 'index.php !!! <a href="/test">test</a><br><pre>';
});

$router->add('/test/:thing',
             (new Router())->add('/test/0', function() {
                 echo "rr";
             })->add('/test/:id', function($id) {
                 echo $id;
             })
);

$router();


