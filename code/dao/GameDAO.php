<?php

class GameDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "game";
    }

    public function create($partyDTO) {
    }

    public function update($partyDTO) {
        
    }
}

new GameDAO();