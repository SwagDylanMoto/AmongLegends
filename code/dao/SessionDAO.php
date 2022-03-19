<?php

class SessionDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "session";
    }

    public function create($partyDTO) {
    }

    public function update($partyDTO) {
        
    }
}

new SessionDAO();