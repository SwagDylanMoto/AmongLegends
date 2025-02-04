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

        if ($endStatDTO->win) {
            $points += 10;
        } else {
            $points -= 5;
        }

        $points += $this->getVotePoints($gameSessionId);

        return $points;
    }

    public function getRoleAddInfos($sessionId)
    {
        $currentSession = SingletonRegistry::$registry['SessionService']->get($sessionId);
        $partySessions = SingletonRegistry::$registry['SessionService']->getPartySessions($currentSession->partyId);

        $nicknames = [
            '##Toplaner',
            '##Jungler',
            '##Midlaner',
            '##Adc',
            '##Support',
            '##YourLaner'
        ];

        foreach ($partySessions as $partySession) {
            if ($partySession->identifier !== $currentSession->identifier) {
                $nicknames[] = $partySession->nickname;
            }
        }

        return $nicknames[rand(0, count($nicknames)-1)];
    }
}

new Gay();