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
            $sql = $this->db->prepare('DELETE FROM '.$this->tableName.' WHERE ID = :id');
            $sql->execute([
                'id' => $identifierDTO->identifier
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function get($id) {
        try {
            $sql = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE ID = :id');
            $sql->execute([
                'id' => $id
            ]);
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            if (!$data["ID"]) {
                return null;
            }
            return $this->fetch($data);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    abstract protected function fetch($data);
}