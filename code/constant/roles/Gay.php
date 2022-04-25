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
}

new Gay();