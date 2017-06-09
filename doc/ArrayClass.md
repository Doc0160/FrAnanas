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

