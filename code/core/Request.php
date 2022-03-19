<?php

class Request extends Singleton {

    public $page;

    public $path;

    public $token;

    public $nickname;

    function __construct()
    {
        parent::__construct();
        $this->token = $_COOKIE['token'];
        $this->nickname = $_COOKIE["nickname"];
    }
}