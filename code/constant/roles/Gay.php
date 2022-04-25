<?php

class Gay extends Role implements RoleCalculation {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Gay aka Romeo
     *
     * Il est aveugler par l'amour (gay).
     * Doit gagner la partie.
     * Le tout en prenant aucun kill à son amour et en mourant pour lui à chaque fois qu'il meurt (voir avant si possible).
     */
    public function calculPoints(EndStatDTO $endStatDTO, int $gameSessionId) {
        $points = 0;

        // TODO: Implement calculPoints() method.

        return $points;
    }

    public function getRoleAddInfos()
    {
        $currentSession = SingletonRegistry::$registry['SessionManager']->currentSessionDTO;
        $partySessions = SingletonRegistry::$registry['SessionService']->getPartySessions($currentSession->partyId);

        $nicknames = [];

        foreach ($partySessions as $partySession) {
            if ($partySession->identifier !== $currentSession->identifier) {
                $nicknames[] = $partySession->nickname;
            }
        }

        return $nicknames[rand(0, count($nicknames)-1)];
    }
}

new Gay();