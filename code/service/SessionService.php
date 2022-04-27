<?php

class SessionService extends IdentifierService {

    private SessionManager $sessionManager;
    private PartyService $partyService;

    function __construct(){
        parent::__construct();

        $this->DAO = SingletonRegistry::$registry["SessionDAO"];
    }

    function init() {
        $this->sessionManager = SingletonRegistry::$registry['SessionManager'];
        $this->partyService = SingletonRegistry::$registry['PartyService'];
    }

    public function getPartySessions($partyId) {
        return $this->DAO->getByPartyId($partyId);
    }

    public function joinParty($nickname, $partyDTO) {
        $sessionDTO = new SessionDTO();

        $partySessions = $this->getPartySessions($partyDTO->identifier);

        //On ne rejoint pas de party :
        // - Qui est full (5 sessions max)
        // - Qui est en game (activeGameId existant)
        if ($partyDTO->activeGameId !== null || count($partySessions) >= 5) {
            return null;
        }

        $admin = true;
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

        $sessionDTO = $this->DAO->create($sessionDTO);

        $this->sessionManager->createSession($sessionDTO);

        return $sessionDTO;
    }

    public function leaveParty() {
        if ($this->sessionManager->currentSessionDTO) {
            $partyId = $this->sessionManager->currentSessionDTO->partiId;

            $this->delete($this->sessionManager->currentSessionDTO);
            $this->sessionManager->deleteSession();

            $partySessions = $this->getPartySessions($partyId);
            if($partySessions) {
                $admin = false;
                foreach ($partySessions as $partySession) {
                    if ($partySession->admin) {
                        $admin = true;
                        break;
                    }
                }
                if (!$admin) {
                    $partySessions[0]->admin = true;
                    $this->update($partySession[0]);
                }
            } else {
                $party = $this->partyService->get($partyId);
                if ($party) {
                    $this->partyService->delete($party);
                }
            }
        }
    }

    public function getByToken($token) {
        return $this->DAO->getByToken($token);
    }

    private function getNewToken($code = "megasperm") {
        $hashtext = rand() . $code;
        $hash = hash('sha256', $hashtext);

        if ($this->DAO->getByToken($hash)) {
            return $this->getNewToken($code);
        } else {
            return $hash;
        }
    }
}

new SessionService();