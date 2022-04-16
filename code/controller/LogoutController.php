<?php

class LogoutController extends Controller {

    private $sessionManager;

    function __construct() {
        parent::__construct();

        $this->sessionManager = SingletonRegistry::$registry["SessionManager"];
    }

    public function process() {
        $this->sessionManager->deleteSession();
        header("Location: " . Config::$baseUrl . "/login");
    }
}

new LogoutController();