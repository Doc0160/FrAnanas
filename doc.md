# ArrayClass
```
/**
 * Class ArrayClass
 * 
 * Easy array manipulation class
 */
```
- __construct(array $array): 
```
/**
     * Constructor
     *
     * @param array &$array
     */
```
- json(): string
```

```
- csv($delimiter, $enclosure): string
```

```
- keys(): 
```
/**
     * Return all the keys of an array.
     * Due to limitations the additional parameters of array_keys are not supported.
     * @return Array|ArrayClass
     */
```
- values(): 
```
/**
     * Return all the values of an array
     * @return Array|ArrayClass
     */
```
- sum(): 
```
/**
     * Calculate the sum of values in an array
     * @return number
     */
```
- has($needle, $strict): 
```
/**
     * Checks if a value exists in an array
     * @param mixed $needle The searched value
     * @param bool $strict If true will also compare the types
     * @return bool
     */
```
- begin(): 
```
/**
     * Set the internal pointer of an array to its first element
     * @return mixed The first array value
     */
```
- current(): 
```
/**
     * Return the current element in an array
     * @return mixed
     */
```
- next(): 
```
/**
     * Advance the internal array pointer of an array
     * @return mixed The next array value
     */
```
- end(): 
```
/**
     * Set the internal pointer of an array to its last element
     * @return mixed The last array value
     */
```
- each(): 
```
/**
     * Return the current key and value pair from an array and advance the array cursor
     * @return Array|ArrayClass
     */
```
- search($needle, $strict): 
```
/**
     * Searches the array for a given value and returns the corresponding key if successful
     * @param mixed $needle The searched value
     * @param bool $strict If true will also compare the types
     * @return mixed
     */
```
- key_exists($key): 
```
/**
     * Checks if the given key or index exists in the array
     * @param mixed $key Value to check
     * @return bool
     */
```
- clear(): 
```
/**
     * Remove all elements from the array
     * @return Array|ArrayClass
     */
```
- raw(): 
```
/**
     * Return the internal raw Array for this ArrayClass object
     * @return Array
     */
```
- shift(): 
```
/**
     * Shift an element off the beginning of array
     * @return mixed
     */
```
- unshift($value1): 
```
/**
     * Prepend one or more elements to the beginning of an array
     * @param mixed $value1 First value to prepend
     * @return int
     */
```
- pop(): 
```
/**
     * Pop the element off the end of array
     * @return mixed
     */
```
- push($value1): 
```
/**
     * Push one or more elements onto the end of array
     * @param mixed $value1 The first value to append
     * @return int
     */
```
- implode($glue): 
```
/**
     * Join array elements with a string
     * @param string $glue Defaults to an empty string
     * @return string|StringClass
     */
```
- filter($callback): 
```
/**
     * Filters elements of an array using a callback function
     * @param Callable $callback If this returns true for a value, the value is in the result array.
     * @return Array|ArrayClass
     */
```
- count($mode): 
```
/**
     * Count all elements in an array
     * @param int $mode If set to COUNT_RECURSIVE, will recursively count the array.
     * @return int
     */
```
- offsetExists($offset): 
```
/**
     * @ignore
     */
```
- offsetGet($offset): 
```
/**
     * @ignore
     */
```
- offsetSet($offset, $value): 
```
/**
     * @ignore
     */
```
- offsetUnset($offset): 
```
/**
     * @ignore
     */
```

# Autoload
```
/**
 * Class Autoloader
 */
```
- __construct(string $path): 
```
/**
     * Constructor
     * @param string $path
     */
```
- register(string $name, $loader): 
```
/**
     * Register new thing to be loaded
     * @param string $name
     * @param $loader
     */
```
- load(string $name): bool
```
/**
     * To be called be load a class/file/function sets
     * @param string $name
     */
```

# AutoloadException
```
/**
 * Autoload Exception
 */
```
- __clone(): 
```

```
- __construct($message, $code, $previous): 
```

```
- __wakeup(): 
```

```
- getMessage(): 
```

```
- getCode(): 
```

```
- getFile(): 
```

```
- getLine(): 
```

```
- getTrace(): 
```

```
- getPrevious(): 
```

```
- getTraceAsString(): 
```

```
- __toString(): 
```

```

# Controller
```
/**
 * Controller Class
 */
```
- __construct(string $path, array $context): 
```
/**
     * Constructor
     * @param string $path Path to search for controllers
     * @param array $context
     */
```
- __debugInfo(): 
```
/** @ignore */
```
- execute($controller, array $_DATA): 
```
/**
     * Execute a controller file
     * $_DATA in the controller file to refer to what's been passed to it
     * 
     * @param string $controller Filename
     * @param array $_DATA Data to pass to the controller
     */
```

# ControllerException
```
/**
 * Controller Exception
 */
```
- __clone(): 
```

```
- __construct($message, $code, $previous): 
```

```
- __wakeup(): 
```

```
- getMessage(): 
```

```
- getCode(): 
```

```
- getFile(): 
```

```
- getLine(): 
```

```
- getTrace(): 
```

```
- getPrevious(): 
```

```
- getTraceAsString(): 
```

```
- __toString(): 
```

```

# Cookie
```

```
- __construct(int $duration): 
```

```
- __get(string $name): 
```

```
- __set(string $name, string $value): 
```

```
- __unset(string $name): 
```

```
- __isset(string $name): bool
```

```
- __debugInfo(): 
```

```
- setWithDuration(string $name, string $value, int $duration): 
```

```

# final Database
```
/**
 * @deprecated
 */
```
- __construct(): 
```
/** @ignore */
```
- getInstance(): PDO
```

```
- setConfig(string $dsn, string $username, string $password, array $options): 
```

```
- configDone(): bool
```
/** @ignore */
```

# DB
```
/**
 * DB Class
 * 
 * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
 */
```
- __construct(): 
```
/** @ignore */
```
- setConfig(string $dsn, string $username, string $password, array $options): void
```
/**
     * Set config
     */
```
- getPDO(): PDO
```
/**
     * Get raw PDO instance
     */
```
- quote(string $q): string
```

```
- query(string $query): 
```
/**
     * Set SQL Query
     */
```
- select(string $what): 
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- from(string $what): 
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- where(string $what): 
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- limit(string $what): 
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- orderby(string $what): 
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- insert(string $what, array $values): 
```

```
- req(): string
```
/**
     * Get SQL Query
     */
```
- fetchAll(): 
```

```
- fetch(): 
```

```

# Enum
```
/**
 * Base Enum class
 *
 * Create an enum by implementing this class and adding class constants.
 *
 * ```php
 * class Action extends Enum
 * {
 *     const VIEW = 'view';
 *     const EDIT = 'edit';
 * }
 *
 * $action = Action::VIEW();
 * $action = new Action(Action::VIEW);
 * ```
 */
```
- __construct($value): 
```
/**
     * Creates a new value of some type
     *
     * @param mixed $value
     *
     * @throws UnexpectedValueException if incompatible type is given.
     */
```
- getValue(): 
```
/**
     * @return mixed
     */
```
- getKey(): 
```
/**
     * Returns the enum key (i.e. the constant name).
     *
     * @return mixed
     */
```
- __toString(): 
```
/**
     * @return string
     */
```
- equals(Enum $enum): 
```
/**
     * Compares one Enum with another.
     *
     * This method is final
     *
     * @return bool True if Enums are equal, false if not equal
     */
```
- keys(): 
```
/**
     * Returns the names (keys) of all constants in the Enum class
     *
     * @return array
     */
```
- values(): 
```
/**
     * Returns instances of the Enum class of all Enum constants
     *
     * @return static[] Constant name in key, Enum instance in value
     */
```
- toArray(): 
```
/**
     * Returns all possible values as an array
     *
     * @return array Constant name in key, constant value in value
     */
```
- isValid($value): 
```
/**
     * Check if is valid enum value
     *
     * @param $value
     *
     * @return bool
     */
```
- isValidKey($key): 
```
/**
     * Check if is valid enum key
     *
     * @param $key
     *
     * @return bool
     */
```
- search($value): 
```
/**
     * Return key for value
     *
     * @param $value
     *
     * @return mixed
     */
```
- __callStatic($name, $arguments): 
```
/**
     * Returns a value when called statically like so: MyEnum::SOME_VALUE() given SOME_VALUE is a class constant
     *
     * @param string $name
     * @param array  $arguments
     *
     * @return static
     * @throws BadMethodCallException
     */
```

# Profiler
```
/**
 * Profiler Class
 *
 * For all your profiling needs
 *
 * Add a bar on top with profiling data
 *
 * Not meant to be used in production
 */
```
- __construct(): 
```
/**
     * Constructor
     *
     * This constructor use:
     * - assert_options
     * - register_shutdown_function
     * - spl_autoload_register
     *
     */
```
- autoload(string $class): bool
```
/**
     * Callback for autoload system
     *
     * Never call this function directly
     * 
     * @param $class
     */
```
- assert(string $file, $line, $code, $desc): void
```
/**
     * Callback for assert system
     * 
     * Never call this function directly
     * 
     * Just use ```assert(true==false, 'I want to know if right is wrong');```
     *
     * @param string $file
     * @param $line
     * @param $code
     * @param $desc
     *
     * @see http://php.net/manual/en/function.assert.php
     */
```
- setAssertFatal(bool $fatal): void
```
/**
     * Force assert fail to be fatal
     *
     * @param bool $fatal if true, assert fail becomes fatal
     */
```
- display(): void
```
/**
     * Display the HTML
     */
```
- gatherAll(): void
```
/**
     * Gather Data
     */
```
- gatherInputGet(): void
```
/**
     * Gather GET
     */
```
- gatherInputPost(): void
```
/**
     * Gather POST
     */
```
- gatherInputSession(): void
```
/**
     * Gather SESSION
     */
```
- gatherInputCookie(): void
```
/**
     * Gather COOKIE
     */
```
- gatherFiles(): void
```
/**
     * Gather Included Files
     */
```
- getMicrotime($at_start): 
```
/**
     * Get microtime.
     * 
     * @param boolean $at_start set to true if this microtime is get at the very beginning of the app. this can allow newer php version to use $_SERVER['REQUEST_TIME_FLOAT'];
     * @return float microtime in float.
     */
```
- getReadableTime($time): 
```
/**
     * Get readable time.
     * 
     * @param integer $time
     * @return string
     */
```
- getReadableFileSize($size, $retstring): 
```
/**
     * Get readable file size.
     * 
     * @param int $size
     * @param string $retstring
     * @return string
     */
```
- return_bytes($size_str): int
```
/**
     * Return Bytes from format "128Mo"
     *
     * @param $size_str
     * @return Max RAM Size
     */
```

# Router
```
/**
 *  Router class
 */
```
- __construct(string $uri): 
```
/**
     * Constructor
     * 
     * @param string $uri
     */
```
- __set(string $url, callable $action): 
```
/** @ignore */
```
- __debugInfo(): 
```
/** @ignore */
```
- __invoke(): 
```
/** @ignore */
```
- add(string $url, callable $action): 
```
/**
     * add route
     * @param string $url
     * @param callable $action
     */
```
- get(string $url, callable $action): 
```
/**
     * Add get route
     * @param string $url
     * @param callable $action
     */
```
- post(string $url, callable $action): 
```
/**
     * Add post route
     * @param string $url
     * @param callable $action
     */
```
- patch(string $url, callable $action): 
```
/**
     * Add patch route
     * @param string $url
     * @param callable $action
     */
```
- delete(string $url, callable $action): 
```
/**
     * Add delete route
     * @param string $url
     * @param callable $action
     */
```
- addWithMethod(string $method, string $url, callable $action): 
```
/**
     * add a route with a method
     *
     * $url:
     * - /test
     * - /test/* matches /test, /test/truc, /test/b/aaaa/ggg, ...
     * - /test/:id matches /test/a, /test/1, /test/test, /test/me
     *
     * @param string $method
     * @param string $url
     * @param callable $action
     */
```
- setNotFound(callable $action): 
```
/**
     * Add callback for 404 cases
     * @param callable $action
     */
```
- dispatch(): 
```
/**
     * Dispatch routes
     */
```
- redirect(string $page, bool $perm): void
```
/**
     * Redirect
     * 
     * @param string $page Route to redirect to
     * @param bool $perm If the redirection is permanent (alias SEO friendly)
     */
```
- cache($duration): 
```
/**
     * Cache
     * 
     * @param $duration Duration in seconds or false to never cache
     */
```

# RouterException
```
/**
 * Router Exception
 */
```
- __clone(): 
```

```
- __construct($message, $code, $previous): 
```

```
- __wakeup(): 
```

```
- getMessage(): 
```

```
- getCode(): 
```

```
- getFile(): 
```

```
- getLine(): 
```

```
- getTrace(): 
```

```
- getPrevious(): 
```

```
- getTraceAsString(): 
```

```
- __toString(): 
```

```

# Session
```
/**
 * Session Class
 *
 * Aceesible as an array
 */
```
- __construct(string $name, int $timeout): 
```

```
- __get(string $name): 
```

```
- __set(string $name, $value): void
```

```
- __unset(string $name): void
```

```
- __isset(string $name): bool
```

```
- __debugInfo(): 
```
/** @ignore */
```
- offsetExists($offset): bool
```

```
- offsetGet($offset): 
```

```
- offsetSet($offset, $value): void
```

```
- offsetUnset($offset): void
```

```
- count(): int
```

```
- start(): void
```

```
- destroy(): void
```

```
- restart(): void
```
/**
     * Destroy then start the session
     */
```
- get_csrf_token(): string
```
/**
     * Get Session CSRF token
     * 
     * return string
     */
```
- is_csrf_protected($token): bool
```
/**
     * Check if CSRF token exist is wright
     *
     * @param $token token to compare to
     */
```

# View
```
/**
 * View Class
 */
```
- __construct(string $path, array $context): 
```
/**
     * Constructor
     *
     * @param string $path Path to the view files
     * @param array $context
     */
```
- sanitize(array $data): 
```
/**
     * Sanatize array before passing it to the view
     *
     * @param array &$data
     */
```
- display($view, array $_DATA): 
```
/**
     * Display a view
     *
     * @param $view
     * @param array $_DATA
     */
```

# ViewException
```
/**
   View Exception
 */
```
- __clone(): 
```

```
- __construct($message, $code, $previous): 
```

```
- __wakeup(): 
```

```
- getMessage(): 
```

```
- getCode(): 
```

```
- getFile(): 
```

```
- getLine(): 
```

```
- getTrace(): 
```

```
- getPrevious(): 
```

```
- getTraceAsString(): 
```

```
- __toString(): 
```

```

