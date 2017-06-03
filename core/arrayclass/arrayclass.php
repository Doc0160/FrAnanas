<?php

class ArrayClass {
    public  $array;
    
    public function __construct(array $array) {
        $this->array = &$array;
    }

    /**
     * Count all elements in an array
     * @param int $mode If set to COUNT_RECURSIVE, will recursively count the array.
     * @return int
     */
    function count($mode = COUNT_NORMAL) {
        return count($this->a, $mode);
    }
}
