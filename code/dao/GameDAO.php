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
                'INSERT INTO :tableName (PARTY_ID , STATUT , TYPE) 
                VALUES (:partyId , :statut , :type)'
            );
            $sql->execute([
                'tableName' => $this->tableName,
                'partyId' => $gameDTO->partyId,
                'statut' => $gameDTO->statut,
                'type' => $gameDTO->type
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($gameDTO) {
        try {
            $sql = $this->db->prepare(
                'UPDATE :tableName SET
                PARTY_ID = :partyId , 
                STATUT = :statut , 
                TYPE = :type 
                WHERE ID = :id'
            );
            $sql->execute([
                'tableName' => $this->tableName,
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