<?php

abstract class Singleton {

    protected string $className;

    function __construct() {
        $this->className = get_class($this);

        SingletonRegistry::$registry[$this->className] = $this; 
    }
}