<?php

class SessionService extends Singleton{

    private $sessionDAO;

    function __construct(){
        parent::__construct();

        $this->sessionDAO = SingletonRegistry::$registry["SessionDAO"];
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

        return $this->sessionDAO->create($sessionDTO);
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