<?php

class EndVoteService extends IdentifierService {

    function __construct(){
        parent::__construct();

        $this->DAO = SingletonRegistry::$registry["EndVoteDAO"];
    }

    public function getAllByVotingGS($gsId) {
        return $this->getAllByVotingGS($gsId);
    }

    public function getAllByVotedGS($gsId) {
        return $this->getAllByVotedGS($gsId);
    }
}

new EndVoteService();