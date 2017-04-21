# Session

```php

// Create a session system
$session = new Session();

// Check if session has data in it
echo $session->has_data();

// Set a value
$session->username = 'mama';

// Check again
echo $session->has_data();

// Destroy the session
$session->destroy();


// session will automagically die after 1 hour away
// session's default cookie name will be frananas

```


```php

// You can specify the cookie's name
$session = new Session('mysession');

// You can also specify the 'automagically dying' duration (in seconds)
$session = new Session('mysession', 1800);

```