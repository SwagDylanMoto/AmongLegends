<?php

class PartyStatut extends Singleton {

    public function __construct()
    {
        parent::__construct();
    }

    public $partyStatutEnum = [
        "Lobby",
        "InGame",
        "Voting",
        "EndGame"
    ];
}

new PartyStatut();