<?php

class Role extends Singleton {

    public $name;

    public $addInfos;

    public function __construct() {
        $this->name = get_class($this);

        SingletonRegistry::$registry["Roles"]->rolesEnum[] = $this->name;

        parent::__construct('Role::'.$this->name);
    }
}