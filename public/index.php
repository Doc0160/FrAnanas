<?php

define('PROFILER', true);

require('../core/core.php');

/*
   Database::setConfig('mysql:host=localhost;'.
   'port=3306;'.
   'dbname=ananas;'.
   'charset=utf8',
   'root', '');
   $database = Database::getInstance();

   $db = new DB();
   $db->setConfig('mysql:host=localhost;'.
   'port=3306;'.
   'dbname=ananas;'.
   'charset=utf8',
   'root', '');
 */

/*
class Action extends Enum
{
    const VIEW = 'view';
    const EDIT = 'edit';
}
$action = Action::VIEW();
$action = new Action(Action::VIEW);
*/

$router->setNotFound(function($url) {
    global $view;    
    $view->display('404.php', ['url' => $url]);
});

$router->add('/', function() {
    echo 'index.php !!! <a href="/test/">test</a><br>';
    global $db;
    echo '<pre>';
    $db->select()->from('user')->limit(5)->orderby("id");
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
                 global $controller;
                 $controller->execute(function($d) {
                     
                     var_dump($d['id']);
                     
                     assert(is_numeric($d['id']), 'ID is not numerical');
                     
                 }, ['id' => $id]);
             }));

$router();


