<?php

class Sasuke extends Role implements RoleCalculation {

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Sasuke
     *
     * Il n'a pas d'amis, juste un ennemis.
     * Doit gagner la partie.
     * Le tout en focusant uniquement une personne en particulier. Les autres doivent être ignorés autant que possible.
     */
    public function calculPoints(EndStatDTO $endStatDTO, int $gameSessionId) {
        $points = 0;

        // TODO: Implement calculPoints() method.

        return $points;
    }
}

new Sasuke();