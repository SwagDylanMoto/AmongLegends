<?php

abstract class Singleton {

    function __construct($className = null) {
        if(!$className) {
            $className = get_class($this);
        }
        if(SingletonRegistry::$registry[$className]) {
            return SingletonRegistry::$registry[$className];
        }
        SingletonRegistry::$registry[$className] = $this; 
    }

    public function init() {}
}