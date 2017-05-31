# Autoload

Autoload will automagically import librairies from the core when needed.

Functions:
- function __construct(string $path = '')
- function register(string $name, $loader = false)
- function load(string $name)

Example:
```php

// Create autoloader
$autoloader = new Autoload();
// Register it
spl_autoload_register([$autoloader, 'load']);

// Register something in the FrAnanas autoload system
$autoloader->register('test', function(){
    return require('test.php');
});


```

[FrAnanas](/README.md)
[spl_autoload_register](http://php.net/manual/en/function.spl-autoload-register.php)
