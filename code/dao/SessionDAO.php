<?php

class SessionDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "session";
    }

    public function create($sessionDTO) {
        try {
            $sql = $this->db->prepare(
                'INSERT INTO :tableName (NICKNAME , PARTY_ID , POINTS , TOKEN , ADMIN) 
                VALUES (:nickname , :partyId , :points , :token , :admin)'
            );
            $sql->execute([
                'tableName' => $this->tableName,
                'nickname' => $sessionDTO->nickname,
                'partyId' => $sessionDTO->partyId,
                'points' => $sessionDTO->points,
                'token' => $sessionDTO->token,
                'admin' => $sessionDTO->admin
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($sessionDTO) {
        try {
            $sql = $this->db->prepare(
                'UPDATE :tableName SET
                NICKNAME = :nickname , 
                PARTY_ID = :partyId , 
                POINTS = :points , 
                TOKEN = :token , 
                ADMIN = :admin 
                WHERE ID = :id'
            );
            $sql->execute([
                'tableName' => $this->tableName,
                'nickname' => $sessionDTO->nickname,
                'partyId' => $sessionDTO->partyId,
                'points' => $sessionDTO->points,
                'token' => $sessionDTO->token,
                'admin' => $sessionDTO->admin,
                'id' => $sessionDTO->identifier
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    protected function fetch($data) {
        $sessionDTO = new SessionDTO();

        $sessionDTO->identifier = $data['ID'];
        $sessionDTO->nickname = $data['NICKNAME'];
        $sessionDTO->partyId = $data['PARTY_ID'];
        $sessionDTO->points = $data['POINTS'];
        $sessionDTO->token = $data['TOKEN'];
        $sessionDTO->admin = $data['ADMIN'];

        return $sessionDTO;
    }
}

new SessionDAO();