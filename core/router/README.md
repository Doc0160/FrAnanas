# Router

The router class has the basic functionnality of adding callbacks to
user/develloper defined routes.

```php

function __construct(string $uri = '')
function add(string $url, callable $action)
function get(string $url, callable $action)
function post(string $url, callable $action)
function addWithMethod(string $method, string $url, callable $action)
function setNotFound(callable $action)
function dispatch()
function redirect(string $page)
```

Example:
```php
<?php
// Create a new router if you don't want the default one
// $router = new Router();

// Set 404 error
$router->setNotFound(function($url) {
    echo '404 : '.$url.' does not exist';
});

// add a general route
$router->add('/', function() {
    echo "i'm index";
});

// add a route with variable parts in it
$router->add('/m/:id/:name', function($id, $name) {
    echo $id.'<br>'.$name;
});


$router();

?>
```

You can also add routes with a defined method:
```php
// only called with a get request
$router->get('/', function() {
    echo 'get';
});

// only called with a post request
$router->post('/', function() {
    echo 'post';
});

// using a more exotic request method (delete)
$router->addWithMethod('DELETE', '/', function() {
    echo 'delete';
});
```


[FrAnanas](/README.md)

