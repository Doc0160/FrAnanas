# Router

````php
<?php
// Create a new router
$router = new Router();

// Set 404 error
$router->setNotFound(function($url) {
    echo '404 : '.$url.' does not exist';
});

// add a general route
$router->add('/', function() {
    echo "i'm index";
});

function test() {
    echo 'test';
}	 
// add a 'GET' method route
$router->get('/test', 'test');

$router->dispatch();

?>
```





[FrAnanas](/README.md)