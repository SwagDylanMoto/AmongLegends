<?php

abstract class Singleton {

    function __construct() {
        SingletonRegistry::$registry[get_class($this)] = $this; 
    }

    public function init() {}
}