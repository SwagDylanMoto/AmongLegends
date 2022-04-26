<?php

class GameSessionService extends IdentifierService {

    public function __construct(){
        parent::__construct();

        $this->DAO = SingletonRegistry::$registry["GameSessionDAO"];
    }

    public function getBySessionAndGame($sessionId, $gameId) {
        return $this->DAO->getBySessionAndGame($sessionId, $gameId);
    }

    public function generateGameSessions($sessionIdList, $roleList, $gameId) {
        if (count($sessionIdList) !== count($roleList)) {
            throw new Exception();
        }

        $returner = [];

        foreach ($sessionIdList as $sessionId) {
            $newGameSession = new GameSessionDTO();

            print_r($roleList);

            $roleI = rand(0, count($roleList) -1);

            $newGameSession->sessionId = $sessionId;
            $newGameSession->gameId = $gameId;
            $newGameSession->role = $roleList[$roleI];
            $newGameSession->roleAddInfos = SingletonRegistry::$registry['Role::'.$roleList[$roleI]]->getRoleAddInfos($sessionId);
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