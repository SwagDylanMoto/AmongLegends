<?php

class Roles extends Singleton {

    public function __construct()
    {
        parent::__construct();
    }

    public $rolesEnum = [];
}

new Roles();

