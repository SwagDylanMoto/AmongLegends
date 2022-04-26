<?php

class SussyBaka extends Role implements RoleCalculation {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * SussyBaka aka Imposteur
     *
     * Doit perdre la partie.
     * Mais surtout sans se faire choper.
     */
    public function calculPoints(EndStatDTO $endStatDTO, int $gameSessionId) {
        $points = 0;

        // TODO: Implement calculPoints() method.

        return $points;
    }

    public function getRoleAddInfos($sessionId) {
        return null;
    }
}

new SussyBaka();