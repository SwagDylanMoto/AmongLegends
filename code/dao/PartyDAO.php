<?php

class PartyDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "party";
    }

    public function create($partyDTO) {
        try {
            
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($partyDTO) {
        try {
            
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    protected function fetch($data) {
        
    }
}

new PartyDAO();