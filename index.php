<?php

require('core/autoload/autoload.php');

$autoloader = new Autoload();
spl_autoload_register([$autoloader, 'load']);

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

$input = new Input();

$router->add('/', function() use($input) {
    echo 'index.php !!! <a href="/test">test</a><br><pre>';
    var_dump($input->test);
    var_dump($input);
});

// add a 'GET' method route
$router->get('/test', function() {
    echo 'test <a href="/">/</a>';
?>
    <form enctype="multipart/form-data" action="/" method="post">
        <input type="input" name="file">
        <input type="file" multiple name="test">
        <input type="submit">
    </form>
<?php
});

$router->add('/m/:id/:name', function($id, $name) {
    echo $id."<br>".$name;
});


$router->dispatch();

