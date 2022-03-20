<?php

class LoginController extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function process() {
        $this->front();
    }

    private function front() {
        $base = SingletonRegistry::$registry["Request"]->base;
        include($base.'code/front/header.php');
        include($base.'code/front/page/login.php');
        include($base.'code/front/footer.php');
    }
}

new LoginController();