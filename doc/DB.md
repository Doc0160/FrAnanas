# DB
```
/**
 * DB Class
 * 
 * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
 */
```
- __construct()
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
- query(string $query)
```
/**
     * Set SQL Query
     */
```
- select(string $what)
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- from(string $what)
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- where(string $what)
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- limit(string $what)
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- orderby(string $what)
```
/**
     * $users = $db->select('*')->from('users')->where('id>1')->limit(100)->orderby('username')->fetchAll();
     */
```
- insert(string $what, array $values)
```

```
- req(): string
```
/**
     * Get SQL Query
     */
```
- fetchAll()
```

```
- fetch()
```

```

