# View

```php
// Create view loader object and set its working directory
$view = new View('/views/');

// display a view file
$view->display('wah.php');

// display a view file
$view->display('wah.php' ['text' => "wah, I'm the trash man"]);

```

```php

// /views/wah.php
var_dump($_DATA);

```