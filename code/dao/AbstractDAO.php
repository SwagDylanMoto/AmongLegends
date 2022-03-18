<?php
include('../code/core/AbstractSingleton.php');

abstract class DAO extends Singleton {
    protected $db;

    public function __construct() {
        parent::__construct();

        try {
            $this->db = new PDO('mysql:host=localhost;dbname=' . Config::$dbName, 'root', '');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}