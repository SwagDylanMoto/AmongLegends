<?php

class PartyService extends IdentifierService {

    function __construct(){
        parent::__construct();

        $this->DAO = SingletonRegistry::$registry["PartyDAO"];
    }

    public function getPartyActiveByCode($code) {
        $party = $this->DAO->getByCode($code);
        if ($party and $party->active) {
            return $party;
        }
        return null;
    }

    public function createParty() {
        $party = new PartyDTO();

        $i = 6900;
        $code = (string)$i;
        while($this->getPartyActiveByCode($code) == true) {
            $i++;
            $code = (string)$i;
        }
        
        $party->code = $code;
        $party->active = true;

        $this->DAO->create($party);

        return $party;
    }
}

new PartyService();