<?php

abstract class IdentifierService extends Singleton {

    protected IdentifierDAO $DAO;

    public function get($identifier) {
        return $this->DAO->get($identifier);
    }

    public function create($DTO) {
        return $this->DAO->create($DTO);
    }

    public function update($DTO) {
        return $this->DAO->update($DTO);
    }

    public function delete($DTO) {
        return $this->DAO->delete($DTO);
    }
}