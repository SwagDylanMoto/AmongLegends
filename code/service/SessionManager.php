<?php

class SessionManager extends Singleton {

    function __construct()
    {
        parent::__construct();
    }

    public $currentSessionDTO = null;

    public function createSession($sessionDTO) {
        $_SESSION['session'] = $sessionDTO->token;
        $_SESSION['nickname'] = $sessionDTO->nickname;
        $this->currentSessionDTO = $sessionDTO;
    }
}