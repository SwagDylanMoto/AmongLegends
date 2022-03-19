<?php

class PartyDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "party";
    }

    public function create($partyDTO) {
        try {
            $sql = $this->db->prepare(
                'INSERT INTO :tableName (ACTIVE , CODE , DYING_DATE) 
                VALUES (:active , :code , :dyingDate)'
            );
            $sql->execute([
                'tableName' => $this->tableName,
                'active' => $partyDTO->active,
                'code' => $partyDTO->code,
                'dyingDate' => $partyDTO->dyingDate
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($partyDTO) {
        try {
            $sql = $this->db->prepare(
                'UPDATE :tableName SET
                ACTIVE = :active , 
                CODE = :code , 
                DYING_DATE = :dyingDate 
                WHERE ID = :id'
            );
            $sql->execute([
                'tableName' => $this->tableName,
                'active' => $partyDTO->active,
                'code' => $partyDTO->code,
                'dyingDate' => $partyDTO->dyingDate,
                'id' => $partyDTO->identifier
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    protected function fetch($data) {
        $partyDTO = new PartyDTO();

        $partyDTO->identifier = $data['ID'];
        $partyDTO->active = $data['ACTIVE'];
        $partyDTO->code = $data['CODE'];
        $partyDTO->dyingDate = $data['DYING_DATE'];

        return $partyDTO;
    }
}

new PartyDAO();