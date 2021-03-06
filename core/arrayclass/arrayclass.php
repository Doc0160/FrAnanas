<?php

/**
 * Class ArrayClass
 * 
 * Easy array manipulation class
 */
class ArrayClass implements ArrayAccess, Countable {
    /**
     * Array manipulated by ArrayClass
     * @var array $array
     */
    public $array;

    /**
     * Constructor
     *
     * @param array &$array
     */
    public function __construct(array &$array) {
        $this->array = &$array;
    }

    public function json():string {
        return json_encode($this->array);
    }

    public function csv($delimiter = ';', $enclosure = '"'):string {
        $str = '';
        $handle = fopen('php://temp', 'r+');
        foreach ($data as $line) {
            fputcsv($handle, $line, $delimiter, $enclosure);
        }
        unset($line, $delimiter, $enclosure);
        rewind($handle);
        while (!feof($handle)) {
            $str .= fread($handle, 8192);
        }
        fclose($handle);
        return $str;
    }

    /**
     * Return all the keys of an array.
     * Due to limitations the additional parameters of array_keys are not supported.
     * @return Array|ArrayClass
     */
    public function keys() {
        return array_keys($this->array);
    }
    
    /**
     * Return all the values of an array
     * @return Array|ArrayClass
     */
    public function values() {
        return array_values($this->array);
    }

    /**
     * Calculate the sum of values in an array
     * @return number
     */
    public function sum() {
        return array_sum($this->array);
    }

    /**
     * Checks if a value exists in an array
     * @param mixed $needle The searched value
     * @param bool $strict If true will also compare the types
     * @return bool
     */
    public function has($needle, $strict = FALSE) {
        return in_array($needle, $this->array, $strict);
    }

    /**
     * Set the internal pointer of an array to its first element
     * @return mixed The first array value
     */
    public function begin() {
        return reset($this->array);
    }
    
    /**
     * Return the current element in an array
     * @return mixed
     */
    public function current() {
        return current($this->array);
    }
    
    /**
     * Advance the internal array pointer of an array
     * @return mixed The next array value
     */
    public function next() {
        return next($this->array);
    }
    
    /**
     * Set the internal pointer of an array to its last element
     * @return mixed The last array value
     */
    public function end() {
        return end($this->array);
    }
    
    /**
     * Return the current key and value pair from an array and advance the array cursor
     * @return Array|ArrayClass
     */
    public function each() {
        return each($this->array);
    }

    /**
     * Searches the array for a given value and returns the corresponding key if successful
     * @param mixed $needle The searched value
     * @param bool $strict If true will also compare the types
     * @return mixed
     */
    public function search($needle, $strict = FALSE) {
        return array_search($needle, $this->array, $strict);
    }

    /**
     * Checks if the given key or index exists in the array
     * @param mixed $key Value to check
     * @return bool
     */
    public function key_exists($key) {
        return array_key_exists($key, $this->array);
    }

    /**
     * Remove all elements from the array
     * @return Array|ArrayClass
     */
    public function clear() {
        return $this->array = [];
    }

    /**
     * Return the internal raw Array for this ArrayClass object
     * @return Array
     */
    public function raw() {
        return $this->array;
    }

    /**
     * Shift an element off the beginning of array
     * @return mixed
     */
    public function shift() {
        return array_shift($this->array);
    }
    
    /**
     * Prepend one or more elements to the beginning of an array
     * @param mixed $value1 First value to prepend
     * @return int
     */
    public function unshift($value1) {
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
    public function pop() {
        return array_pop($this->array);
    }
    
    /**
     * Push one or more elements onto the end of array
     * @param mixed $value1 The first value to append
     * @return int
     */
    public function push($value1) {
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
    public function implode($glue = "") {
        return implode($this->a, $glue);
    }

    /**
     * Filters elements of an array using a callback function
     * @param Callable $callback If this returns true for a value, the value is in the result array.
     * @return Array|ArrayClass
     */
    public function filter($callback = NULL) {
        return array_filter($this->array, $callback);
    }

    // Countable
    /**
     * Count all elements in an array
     * @param int $mode If set to COUNT_RECURSIVE, will recursively count the array.
     * @return int
     */
    public function count($mode = COUNT_NORMAL) {
        return count($this->array, $mode);
    }
    
    // ArrayAccess
    /**
     * @ignore
     */
    public function offsetExists($offset) {
        return isset($this->array[$offset]);
    }
    
    /**
     * @ignore
     */
    public function offsetGet($offset) {
        return $this->array[$offset];
    }
    
    /**
     * @ignore
     */
    public function offsetSet($offset, $value) {
        $this->array[$offset] = $value;
    }
    
    /**
     * @ignore
     */
    public function offsetUnset($offset) {
        unset($this->array[$offset]);
    }
}

