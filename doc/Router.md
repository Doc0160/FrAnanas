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

