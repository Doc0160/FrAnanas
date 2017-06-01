<?php


require('autoload/autoload.php');

$autoloader = new Autoload();
spl_autoload_register([$autoloader, 'load']);
