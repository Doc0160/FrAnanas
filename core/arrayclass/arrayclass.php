<?php

class ArrayClass {
    public  $array;
    
    public function __construct(array &$array) {
        $this->array = &$array;
    }

    /**
     * Count all elements in an array
     * @param int $mode If set to COUNT_RECURSIVE, will recursively count the array.
     * @return int
     */
    function count($mode = COUNT_NORMAL) {
        return count($this->arrayrray, $mode);
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
     * Searches the array for a given value and returns the corresponding key if successful
     * @param mixed $needle The searched value
     * @param bool $strict If true will also compare the types
     * @return mixed
     */
    function search($needle, $strict = FALSE) {
        return array_search($needle, $this->array, $strict);
    }
}
