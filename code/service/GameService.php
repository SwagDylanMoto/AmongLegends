<?php

class GameService extends IdentifierService {

    function __construct(){
        parent::__construct();

        $this->DAO = SingletonRegistry::$registry["GameDAO"];
    }

}

new GameService();