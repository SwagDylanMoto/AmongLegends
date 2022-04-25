<?php

class Krik extends Role implements RoleCalculation {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Krik aka Escroc
     *
     * Il doit se faire voter SussyBaka.
     * Mais le tout surtout sans perdre !
     */
    public function calculPoints(EndStatDTO $endStatDTO, int $gameSessionId) {
        $points = 0;

        // TODO: Implement calculPoints() method.

        return $points;
    }

    public function getRoleAddInfos() {
        return null;
    }
}

new Krik();