<?php

class EndStatDAO extends DAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "end_stat";
    }

    public function create($endStatDTO) {
        try {
            $sql = $this->db->prepare('INSERT INTO :tableName () VALUES ()');
            $sql->execute([
                'tableName' => $this->tableName,
                'gameId' => $endStatDTO->gameId
            ]);
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    public function update($endStatDTO) {}

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
}

new EndStatDAO();