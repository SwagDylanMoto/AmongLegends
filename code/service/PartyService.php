<?php

class PartyService extends Singleton {

    private $partyDAO;

    function __construct(){
        parent::__construct();

        $this->partyDAO = SingletonRegistry::$registry["PartyDAO"];
    }

    public function getPartyActiveByCode($code) {
        $party = $this->partyDAO->getByCode($code);
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

        $this->partyDAO->create($party);

        return $party;
    }
}

new PartyService();