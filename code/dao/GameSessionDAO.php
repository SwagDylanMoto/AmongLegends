<?php

class GameSessionDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "game_session";
    }

    public function create($partyDTO) {
    }

    public function update($partyDTO) {
        
    }
}

new GameSessionDAO();