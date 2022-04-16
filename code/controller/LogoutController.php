<?php

class LogoutController extends Controller {

    private $sessionManager;
    private $sessionService;

    function __construct() {
        parent::__construct();

        $this->sessionManager = SingletonRegistry::$registry["SessionManager"];
        $this->sessionService = SingletonRegistry::$registry['SessionService'];
    }

    public function process() {
        if ($this->sessionManager->currrentSessionDTO) {
            $this->sessionService->leaveParty();
        } else {
            $this->sessionManager->deleteSession();
        }
        header("Location: " . Config::$baseUrl . "/login");
    }
}

new LogoutController();