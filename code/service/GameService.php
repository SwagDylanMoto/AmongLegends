<?php

class GameService extends IdentifierService {

    private $rolesEnum;
    private $partyStatutEnum;

    function __construct(){
        parent::__construct();

        $this->DAO = SingletonRegistry::$registry["GameDAO"];

        $this->partyStatutEnum = SingletonRegistry::$registry["PartyStatut"]->partyStatutEnum;
        $this->rolesEnum = SingletonRegistry::$registry["Roles"]->rolesEnum;
    }

    function startNewGame($partyId) {
        $newGame = new GameDTO();

        $newGame->partyId = $partyId;
        $newGame->statut = $this->partyStatutEnum[1];//InGame
        $newGame->type = SingletonRegistry::$registry["GameType"]->gameTypeEnum[0];

        return $newGame = $this->create($newGame);
    }

}

new GameService();