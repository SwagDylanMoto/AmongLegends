<?php

class Router extends Singleton {

    function __construct()
    {
        parent::__construct();
    }

    function process() {
        $request = SingletonRegistry::$registry['Request'];
    }
}