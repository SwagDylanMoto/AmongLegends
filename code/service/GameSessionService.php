<?php

class GameSessionService extends IdentifierService {

    public function __construct(){
        parent::__construct();

        $this->DAO = SingletonRegistry::$registry["GameSessionDAO"];
    }

    public function getBySessionAndGame($sessionId, $gameId) {
        return $this->DAO->getBySessionAndGame($sessionId, $gameId);
    }

    public function getAllByGame($gameId) {
        return $this->DAO->getAllByGame($gameId);
    }

    public function generateGameSessions($sessionList, $roleList, $gameId) {
        if (count($sessionList) !== count($roleList)) {
            throw new Exception();
        }

        $returner = [];

        foreach ($sessionList as $session) {
            $newGameSession = new GameSessionDTO();

            $roleI = rand(0, count($roleList) -1);

            $newGameSession->sessionId = $session->identifier;
            $newGameSession->gameId = $gameId;
            $newGameSession->nickname = $session->nickname;
            $newGameSession->role = $roleList[$roleI];
            $newGameSession->roleAddInfos = SingletonRegistry::$registry['Role::'.$roleList[$roleI]]->getRoleAddInfos($session->identifier);
            $newGameSession->points = 0;
            $newGameSession->voted = false;

            $tempRoleList = [];
            foreach ($roleList as $role) {
                if ($role !== $roleList[$roleI]) {
                    $tempRoleList[] = $role;
                }
            }
            $roleList = $tempRoleList;
            $tempRoleList = null;

            $newGameSession = $this->create($newGameSession);

            $returner[] = $newGameSession;
        }

        return $returner;
    }
}

new GameSessionService();