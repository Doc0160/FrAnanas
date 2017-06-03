<?php

/**
 * Class ArrayClass
 * 
 * Easy array manipulation class
 */
class ArrayClass implements ArrayAccess, Countable {
    public $array;
    
    public function __construct(array &$array) {
        $this->array = &$array;
    }

    /**
     * Return all the keys of an array.
     * Due to limitations the additional parameters of array_keys are not supported.
     * @return Array|ArrayClass
     */
    function keys() {
        return array_keys($this->array);
    }
    
    /**
     * Return all the values of an array
     * @return Array|ArrayClass
     */
    function values() {
        return array_values($this->array);
    }

    /**
     * Calculate the sum of values in an array
     * @return number
     */
    function sum() {
        return array_sum($this->array);
    }

    /**
     * Checks if a value exists in an array
     * @param mixed $needle The searched value
     * @param bool $strict If true will also compare the types
     * @return bool
     */
    function has($needle, $strict = FALSE) {
        return in_array($needle, $this->array, $strict);
    }

    /**
     * Set the internal pointer of an array to its first element
     * @return mixed The first array value
     */
    function begin() {
        return reset($this->array);
    }
    
    /**
     * Return the current element in an array
     * @return mixed
     */
    function current() {
        return current($this->array);
    }
    
    /**
     * Advance the internal array pointer of an array
     * @return mixed The next array value
     */
    function next() {
        return next($this->array);
    }
    
    /**
     * Set the internal pointer of an array to its last element
     * @return mixed The last array value
     */
    function end() {
        return end($this->array);
    }
    
    /**
     * Return the current key and value pair from an array and advance the array cursor
     * @return Array|ArrayClass
     */
    function each() {
        return each($this->array);
    }

    /**
     * Searches the array for a given value and returns the corresponding key if successful
     * @param mixed $needle The searched value
     * @param bool $strict If true will also compare the types
     * @return mixed
     */
    function search($needle, $strict = FALSE) {
        return array_search($needle, $this->array, $strict);
    }

    /**
     * Checks if the given key or index exists in the array
     * @param mixed $key Value to check
     * @return bool
     */
    function key_exists($key) {
        return array_key_exists($key, $this->array);
    }

    /**
     * Remove all elements from the array
     * @return Array|ArrayClass
     */
    function clear() {
        return $this->array = [];
    }

    /**
     * Return the internal raw Array for this ArrayClass object
     * @return Array
     */
    function raw() {
        return $this->array;
    }

    /**
     * Shift an element off the beginning of array
     * @return mixed
     */
    function shift() {
        return array_shift($this->array);
    }
    
    /**
     * Prepend one or more elements to the beginning of an array
     * @param mixed $value1 First value to prepend
     * @return int
     */
    function unshift($value1) {
        $args = func_get_args();
        for ($i = count($args) - 1; $i >= 0; $i--) {
            array_unshift($this->array, $args[$i]);
        };
        return count($this->array);
    }

    /**
     * Pop the element off the end of array
     * @return mixed
     */
    function pop() {
        return array_pop($this->array);
    }
    
    /**
     * Push one or more elements onto the end of array
     * @param mixed $value1 The first value to append
     * @return int
     */
    function push($value1) {
        $args = func_get_args();
        for ($i = 0; $i < count($args); $i++) {
            array_push($this->array, $args[$i]);
        }
        return count($this->array);
    }
    
    /**
     * Join array elements with a string
     * @param string $glue Defaults to an empty string
     * @return string|StringClass
     */
    function implode($glue = "") {
        return implode($this->a, $glue);
    }

    /**
     * Filters elements of an array using a callback function
     * @param Callable $callback If this returns true for a value, the value is in the result array.
     * @return Array|ArrayClass
     */
    function filter($callback = NULL) {
        return array_filter($this->array, $callback);
    }

    // Countable
    /**
     * Count all elements in an array
     * @param int $mode If set to COUNT_RECURSIVE, will recursively count the array.
     * @return int
     */
    function count($mode = COUNT_NORMAL) {
        return count($this->array, $mode);
    }
    
    // ArrayAccess
    function offsetExists($offset) {
        return isset($this->array[$offset]);
    }
    function offsetGet($offset) {
        return $this->array[$offset];
    }
    function offsetSet($offset, $value) {
        $this->array[$offset] = $value;
    }
    function offsetUnset($offset) {
        unset($this->array[$offset]);
    }
}

