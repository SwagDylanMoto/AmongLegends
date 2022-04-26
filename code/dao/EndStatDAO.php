<?php

class EndStatDAO extends DAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "end_stat";
    }

    public function create($endStatDTO) {
        try {
            $sql = $this->db->prepare('INSERT INTO '.$this->tableName.' (GAME_ID) VALUES (:gameId)');
            $sql->execute([
                'gameId' => $endStatDTO->gameId
            ]);
            return $endStatDTO;
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($endStatDTO) {
        //normalement inutile
    }

    public function delete($endStatDTO) {
        try {
            $sql = $this->db->prepare('DELETE FROM '.$this->tableName.' WHERE GAME_ID = :gameId');
            $sql->execute([
                'gameId' => $endStatDTO->gameId
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function get($gameId) {
        try {
            $sql = $this->db->prepare('SELECT * FROM '.$this->tableName.' WHERE GAME_ID = :gameId');
            $sql->execute([
                'gameId' => $gameId
            ]);
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $endStatDTO = new EndStatDTO();
            $endStatDTO->gameId = $data['GAME_ID'];

            return $endStatDTO;
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }
}

new EndStatDAO();