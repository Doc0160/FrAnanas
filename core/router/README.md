# Router

````php
<?php
// Create a new router
$router = new Router();

// Set 404 error
$router->setNotFound(function($url) {
    echo '404 : '.$url.' does not exist';
});

$router->add('/', function() {
    echo "i'm index";
});

$router->dispatch();

?>
```





[FrAnanas](/README.md)