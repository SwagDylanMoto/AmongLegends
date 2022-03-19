<?php

abstract class DAO extends Singleton {
    protected $db;

    protected $tableName;

    public function __construct() {
        parent::__construct();

        try {
            $this->db = new PDO('mysql:host=localhost;dbname=' . Config::$dbName, 'root', '');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    abstract public function create($dto);

    abstract public function update($dto);

    abstract public function delete($dto);
}