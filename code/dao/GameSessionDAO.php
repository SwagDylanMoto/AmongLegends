<?php

class GameSessionDAO extends IdentifierDAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "game_session";
    }

    public function create($gameSessionDTO) {
        try {
            $sql = $this->db->prepare(
                'INSERT INTO '.$this->tableName.' (GAME_ID , POINTS , ROLE , SESSION_ID , VOTED) 
                VALUES (:gameId , :points , :role , :sessionId , :voted)'
            );
            $sql->execute([
                'gameId' => $gameSessionDTO->gameId,
                'points' => $gameSessionDTO->points,
                'role' => $gameSessionDTO->role,
                'sessionId' => $gameSessionDTO->sessionId,
                'voted' => $gameSessionDTO->voted
            ]);
            $gameSessionDTO->identifier = $this->db->lastInsertId();
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($gameSessionDTO) {
        try {
            $sql = $this->db->prepare(
                'UPDATE '.$this->tableName.' SET
                GAME_ID = :gameId , 
                POINTS = :points , 
                ROLE = :role , 
                SESSION_ID = :sessionId , 
                VOTED = :voted 
                WHERE ID = :id'
            );
            $sql->execute([
                'gameId' => $gameSessionDTO->gameId,
                'points' => $gameSessionDTO->points,
                'role' => $gameSessionDTO->role,
                'sessionId' => $gameSessionDTO->sessionId,
                'voted' => $gameSessionDTO->voted,
                'id' => $gameSessionDTO->identifier
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function getBySessionAndGame($sessionId, $gameId) {
        try {
            $sql = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE SESSION_ID = :sessionId AND GAME_ID = :gameId');
            $sql->execute([
                'sessionId' => $sessionId,
                'gameId' => $gameId
            ]);
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            if (!$data) {
                return null;
            } elseif($data["ID"]) {
                return $this->fetch($data);
            } else {
                return $this->fetch($data[0]);
            }
            return $this->fetch($data);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    protected function fetch($data) {
        $gameSessionDTO = new GameSessionDTO();

        $gameSessionDTO->identifier = $data['ID'];
        $gameSessionDTO->gameId = $data['GAME_ID'];
        $gameSessionDTO->points = $data['POINTS'];
        $gameSessionDTO->role = $data['ROLE'];
        $gameSessionDTO->sessionId = $data['SESSION_ID'];
        $gameSessionDTO->voted = $data['VOTED'];

        return $gameSessionDTO;
    }
}

new GameSessionDAO();