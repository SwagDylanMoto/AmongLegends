<?php

class EndStatDAO extends DAO {

    function __construct()
    {
        parent::__construct();
        $this->tableName = "end_stat";
    }

    public function create($endStatDTO) {
        try {
            $sql = $this->db->prepare(
                'INSERT INTO '.$this->tableName.' (GAME_ID , WIN , MOST_DMG_GS_ID , MOST_DEATH_GS_ID , MOST_KILL_GS_ID) 
                VALUES (:gameId , :win , :mostDmg_GameSessionId , :mostDeath_GameSessionId , :mostKill_GameSessionId)');
            $sql->execute([
                'gameId' => $endStatDTO->gameId,
                'win' => $endStatDTO->win,
                'mostDmg_GameSessionId' => $endStatDTO->mostDmg_GameSessionId,
                'mostDeath_GameSessionId' => $endStatDTO->mostDeath_GameSessionId,
                'mostKill_GameSessionId' => $endStatDTO->mostKill_GameSessionId
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

            if (!$data) {
                return null;
            } elseif($data["GAME_ID"]) {
                return $this->fetch($data);
            } else {
                return $this->fetch($data[0]);
            }
        } catch(PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
        }
    }

    protected function fetch($data) {
        $endStatDTO = new EndStatDTO();

        $endStatDTO->gameId = $data['GAME_ID'];
        $endStatDTO->win = $data['WIN'];
        $endStatDTO->mostKill_GameSessionId = $data['MOST_KILL_GS_ID'];
        $endStatDTO->mostDeath_GameSessionId = $data['MOST_DEATH_GS_ID'];
        $endStatDTO->mostDmg_GameSessionId = $data['MOST_DMG_GS_ID'];

        return $endStatDTO;
    }
}

new EndStatDAO();