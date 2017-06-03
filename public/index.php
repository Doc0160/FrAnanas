<?php

require('../core/core.php');

Database::setConfig('mysql:host=localhost;'.
                    'port=3306;'.
                    'dbname=ananas;'.
                    'charset=utf8',
                    'root', '');
$database = Database::getInstance();
$db->setConfig('mysql:host=localhost;'.
               'port=3306;'.
               'dbname=ananas;'.
               'charset=utf8',
               'root', '');

$cookie = new Cookie();
$input = new Input();

$router->setNotFound(function($url) {
    global $view;    
    $view->display('404.php', ['url' => $url]);
});

$array = new ArrayClass([22,33]);

$router->add('/', function() {
    echo 'index.php !!! <a href="/test">test</a><br><pre>';
    global $db;
    echo '<pre>';
    $db->select()->from('user')->limit(2)->orderby("id");
    var_dump($db->req());
    var_dump($db->fetchAll());
    echo '</pre>';
});

$router->add('/test/*',
             (new Router('/test'))->add('/', function() {
                 global $session;
                 echo '<pre>';
                 var_dump($session);
                 echo '</pre>';
                 
             })->add('/:id', function($id) {
                 echo $id;
                 
             }));

$router();


