<?php

class EndStatService extends Singleton {

    private EndStatDAO $DAO;

    function __construct(){
        parent::__construct();

        $this->DAO = SingletonRegistry::$registry["EndStatDAO"];
    }

    public function get($identifier) {
        return $this->DAO->get($identifier);
    }

    public function create($DTO) {
        return $this->DAO->create($DTO);
    }

    public function delete($DTO) {
        return $this->DAO->delete($DTO);
    }
}

new EndStatService();