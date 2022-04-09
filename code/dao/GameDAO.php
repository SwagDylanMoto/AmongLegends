<?php

class GameDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "game";
    }

    public function create($gameDTO) {
        try {
            $sql = $this->db->prepare(
                'INSERT INTO '.$this->tableName.' (PARTY_ID , STATUT , TYPE) 
                VALUES (:partyId , :statut , :type)'
            );
            $sql->execute([
                'partyId' => $gameDTO->partyId,
                'statut' => $gameDTO->statut,
                'type' => $gameDTO->type
            ]);
            $gameDTO->identifier = $this->db->lastInsertId();
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($gameDTO) {
        try {
            $sql = $this->db->prepare(
                'UPDATE '.$this->tableName.' SET
                PARTY_ID = :partyId , 
                STATUT = :statut , 
                TYPE = :type 
                WHERE ID = :id'
            );
            $sql->execute([
                'partyId' => $gameDTO->partyId,
                'statut' => $gameDTO->statut,
                'type' => $gameDTO->type,
                'id' => $gameDTO->identifier
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    protected function fetch($data) {
        $gameDTO = new GameDTO();
        
        $gameDTO->identifier = $data['ID'];
        $gameDTO->partyId = $data['PARTY_ID'];
        $gameDTO->statut = $data['STATUT'];
        $gameDTO->type = $data['TYPE'];

        return $gameDTO;
    }
}

new GameDAO();