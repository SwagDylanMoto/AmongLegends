<?php

abstract class Controller extends Singleton {

    function __construct() {
        parent::__construct("Controller");
    }

    abstract public function process();
}