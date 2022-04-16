<?php

class SessionService extends Singleton{

    private $sessionDAO;

    private $sessionManager;

    function __construct(){
        parent::__construct();

        $this->sessionDAO = SingletonRegistry::$registry["SessionDAO"];
    }

    function init() {
        $this->sessionManager = SingletonRegistry::$registry['SessionManager'];
    }

    public function getPartySessions($partyId) {
        return $this->sessionDAO->getByPartyId($partyId);
    }

    public function joinParty($nickname, $partyDTO) {
        $sessionDTO = new SessionDTO();

        $admin = true;
        $partySessions = $this->getPartySessions($partyDTO->identifier);
        foreach ($partySessions as $partySession) {
            if ($partySession->admin) {
                $admin = false;
                break;
            }
        }

        $sessionDTO->nickname = $nickname;
        $sessionDTO->partyId = $partyDTO->identifier;
        $sessionDTO->points = 0;
        $sessionDTO->admin = $admin;
        $sessionDTO->token = $this->getNewToken($nickname);

        $sessionDTO = $this->sessionDAO->create($sessionDTO);

        $this->sessionManager->createSession($sessionDTO);

        return $sessionDTO;
    }

    public function leaveParty() {
        if ($this->sessionManager->currentSessionDTO) {
            $this->sessionDAO->delete($this->sessionManager->currentSessionDTO->identifier);
            $this->sessionManager->deleteSession();
        }
    }

    public function getByToken($token) {
        return $this->sessionDAO->getByToken($token);
    }

    private function getNewToken($code = "megasperm") {
        $hashtext = rand() . $code;
        $hash = hash('sha256', $hashtext);

        if ($this->sessionDAO->getByToken($hash)) {
            return $this->getNewToken($code);
        } else {
            return $hash;
        }
    }
}

new SessionService();