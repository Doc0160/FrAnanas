# Controller

The controller class permit the execution of a php file in a controlled manner:
it has access to what you pass to it and nothing else.

Example:
```php
// Create controller loader object and set its working directory
$controller = new Controller('/controllers/');

// execute a controller file
$controller->execute('wow.php');

// execute a controller file
$controller->execute('wow.php', ['text' => 'wow that works', 'controller' => $controller]);

```
Here is the corresponding php file:
```php

// /controllers/wow.php
var_dump($_DATA);

```





[FrAnanas](/README.md)