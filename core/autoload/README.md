# Autoload

[spl_autoload_register](http://php.net/manual/en/function.spl-autoload-register.php)

Autoload will automagically import librairies from the core when needed.

```php

// Create autoloader
$autoloader = new Autoload();
// Register it
spl_autoload_register([$autoloader, 'load']);

// Register something in the FrAnanas autoload system
$autoloader->register('cookie', function(){
    return require('core/session/Cookie.php');
});


```



[FrAnanas](/README.md)