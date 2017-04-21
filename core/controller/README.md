# Controller

```php
// Create controller loader object and set its working directory
$controller = new Controller('/controllers/');

// execute a controller file
$controller->execute('wow.php');

// execute a controller file
$controller->execute('wow.php', ['text' => 'wow that works']);

```

```php
// /controllers/wow.php
var_dump($_DATA);
echo $_DATA['text'];
```