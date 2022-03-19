<?php

class EndStatDAO extends DAO {

    function __construct()
    {
        parent::__construct();
    }

    public function create($partyDTO) {}

    public function update($partyDTO) {}

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