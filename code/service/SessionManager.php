<?php

class SessionManager extends Singleton {

    private $sessionService;

    function __construct()
    {
        parent::__construct();
    }

    function init() {
        $this->sessionService = SingletonRegistry::$registry['SessionService'];
    }

    public $currentSessionDTO = null;

    public function createSession($sessionDTO) {
        $_SESSION['token'] = $sessionDTO->token;
        $_SESSION['nickname'] = $sessionDTO->nickname;
        $this->currentSessionDTO = $sessionDTO;
    }

    public function initSession() {
        session_start();
        if ($_SESSION['token']) {
            $this->currentSessionDTO = $this->sessionService->getByToken($_SESSION['token']);
            return $this->currentSessionDTO;
        }
    }

    public function deleteSession() {
        $_SESSION['token'] = null;
        $_SESSION['nickname'] = null;
        session_destroy();
    }
}

new SessionManager();