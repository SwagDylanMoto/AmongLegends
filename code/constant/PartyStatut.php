<?php

class PartyStatut extends Singleton {

    public function __construct()
    {
        parent::__construct();
    }

    public $partyStatutEnum = [
        "Lobby",
        "InGame",
        "EndStat",
        "Voting",
        "EndGame"
    ];
}

new PartyStatut();