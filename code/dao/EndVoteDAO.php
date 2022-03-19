<?php

class EndVoteDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "end_vote";
    }

    public function create($partyDTO) {
    }

    public function update($partyDTO) {
        
    }
}

new EndVoteDAO();