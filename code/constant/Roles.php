<?php

class Roles extends Singleton {

    public function __construct()
    {
        parent::__construct();
    }

    public $rolesEnum = [
        "Sussy baka",
        "RATIO",
        "Krik",
        "Gay",
        "Sasuke"
    ];
}

new Roles();

