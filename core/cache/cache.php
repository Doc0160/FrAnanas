<?php

/**
 * Cache Class
 */
class Cache {
    private $cache;
    private $type;

    /*
     * @param string $type php
     */
    public function __construct(string $type = 'php') {
        $this->type = $type;
        switch($this->type) {
            case 'php':
            default:
                $this->cache = [];
                break;
        }
    }

    public function __get(string $name) {
        switch($this->type) {
            case 'php':
            default:
                if(isset($this->cache[$name]))
                    return $this->cache[$name];
                return null;
                break;
        }
    }

    public function __set(string $name, $value):void {
        switch($this->type) {
            case 'php':
            default:
                $this->cache[$name] = $value;
                break;
        }
    }

    public function __unset(string $name):void {
        switch($this->type) {
            case 'php':
            default:
                unset($this->cache[$name]);
                break;
        }
    }
    
    public function __isset(string $name):bool {
        switch($this->type) {
            case 'php':
            default:
                return isset($this->cache[$name]);
                break;
        }
    }

    public function clear() {
        switch($this->type) {
            case 'php':
            default:
                $this->cache = [];
                break;
        }
    }
}
