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


// session will automagically die after 1 hour
// session's default cookie name will be frananas

```