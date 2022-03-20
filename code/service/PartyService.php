<?php

class PartyService extends Singleton {

    private $partyDAO;

    function __construct(){
        parent::__construct();

        $this->partyDAO = SingletonRegistry::$registry["PartyDAO"];
    }

    public function partyExistsAndActive($code) {
        $party = $this->partyDAO->getByCode($code);
        if ($party and $party->active) {
            return true;
        }
        return false;
    }

    public function createParty() {
        $party = new PartyDTO();

        $i = 1234;
        $code = (string)$i;
        while($this->partyExistsAndActive($code) == true) {
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