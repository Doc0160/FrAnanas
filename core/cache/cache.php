<?php

class Cache {
    private $cache;
    public function __construct() {
        $this->cache = [];
    }


    public function flush() {
        $this->cache = [];
    }
}
