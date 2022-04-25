<?php

class Ratio extends Role implements RoleCalculation {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Ratio aka Serpentin
     *
     * Il est là pour le gaming.
     * Doit gagner la partie.
     * Mais surtout doit avoir le plus de morts, de kills et de dégats.
     */
    public function calculPoints(EndStatDTO $endStatDTO, int $gameSessionId) {
        $points = 0;

        // TODO: Implement calculPoints() method.

        return $points;
    }
}

new Ratio();