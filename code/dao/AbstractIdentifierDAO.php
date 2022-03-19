<?php

abstract class IdentifierDAO extends DAO {

    function __construct()
    {
        parent::__construct();
    }

    abstract public function create($partyDTO);

    abstract public function update($partyDTO);

    public function delete($identifierDTO) {
        try {
            $sql = $this->db->prepare('DELETE FROM :tableName WHERE ID = :id');
            $sql->execute([
                'tableName' => $this->tableName,
                'id' => $identifierDTO->identifier
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }
}