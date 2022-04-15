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
                'INSERT INTO '.$this->tableName.' (NICKNAME , PARTY_ID , POINTS , TOKEN , ADMIN) 
                VALUES (:nickname , :partyId , :points , :token , :admin)'
            );
            $sql->execute([
                'nickname' => $sessionDTO->nickname,
                'partyId' => $sessionDTO->partyId,
                'points' => $sessionDTO->points,
                'token' => $sessionDTO->token,
                'admin' => $sessionDTO->admin
            ]);
            $sessionDTO->identifier = $this->db->lastInsertId();
            return $sessionDTO;
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($sessionDTO) {
        try {
            $sql = $this->db->prepare(
                'UPDATE '.$this->tableName.' SET
                NICKNAME = :nickname , 
                PARTY_ID = :partyId , 
                POINTS = :points , 
                TOKEN = :token , 
                ADMIN = :admin 
                WHERE ID = :id'
            );
            $sql->execute([
                'nickname' => $sessionDTO->nickname,
                'partyId' => $sessionDTO->partyId,
                'points' => $sessionDTO->points,
                'token' => $sessionDTO->token,
                'admin' => $sessionDTO->admin,
                'id' => $sessionDTO->identifier
            ]);
            return $sessionDTO;
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function getByPartyId($partyId) {
        try {
            $sql = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE PARTY_ID = :partyId');
            $sql->execute([
                'partyId' => $partyId
            ]);
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            $returner = [];

            foreach ($data as $session) {
                $returner[] = $this->fetch($session);
            }

            return $returner;
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function getByToken($token) {
        try {
            $sql = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE TOKEN = :token');
            $sql->execute([
                'token' => $token
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