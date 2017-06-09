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

