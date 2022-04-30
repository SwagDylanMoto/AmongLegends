<?php

class LogoutController extends Controller {

    private SessionManager $sessionManager;
    private SessionService $sessionService;

    function __construct() {
        parent::__construct();

        $this->sessionManager = SingletonRegistry::$registry["SessionManager"];
        $this->sessionService = SingletonRegistry::$registry['SessionService'];
    }

    public function process() {
        if ($this->sessionManager->currentSessionDTO) {
            $this->sessionService->leaveParty();
        } else {
            $this->sessionManager->deleteSession();
        }
        header("Location: " . Config::$baseUrl . "/login");
    }
}

new LogoutController();