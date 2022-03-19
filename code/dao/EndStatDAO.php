<?php

class EndStatDAO extends DAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "end_stat";
    }

    public function create($endStatDTO) {
        try {
            $sql = $this->db->prepare('INSERT INTO :tableName (GAME_ID) VALUES (:gameId)');
            $sql->execute([
                'tableName' => $this->tableName,
                'gameId' => $endStatDTO->gameId
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($endStatDTO) {
        //normalement inutile
    }

    public function delete($endStatDTO) {
        try {
            $sql = $this->db->prepare('DELETE FROM :tableName WHERE GAME_ID = :gameId');
            $sql->execute([
                'tableName' => $this->tableName,
                'gameId' => $endStatDTO->gameId
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function get($gameId) {
        try {
            $sql = $this->db->prepare('SELECT * FROM :tableName WHERE GAME_ID = :gameId');
            $sql->execute([
                'tableName' => $this->tableName,
                'gameId' => $gameId
            ]);
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            $endStatDTO = new EndStatDTO();
            $endStatDTO->gameId = $data['GAME_ID'];

            return $endStatDTO;
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }
}

new EndStatDAO();