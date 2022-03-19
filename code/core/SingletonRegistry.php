<?php

class SingletonRegistry {
    
    static public $registry = [];

    static public function init() {
        foreach(SingletonRegistry::$registry as $singleton) {
            $singleton->init();
        }
    }

}