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

