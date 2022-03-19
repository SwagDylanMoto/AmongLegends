<?php
include('../code/dao/AbstractIdentifierDAO.php');

class PartyDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "PARTY";
    }

    public function create($partyDTO) {
    }

    public function update($partyDTO) {
        
    }
}

new PartyDAO();