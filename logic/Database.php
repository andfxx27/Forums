<?php

// Provide generic method to query DB
class Database {

    private $pdo;
    private $tableName;

    public function __construct($pdo, $tableName) {
        $this->pdo = $pdo;
        $this->tableName = $tableName;
    }

    // Get all records from certain table
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName";

        // ->query return result set as PDOStatement object
        // ->fetchAll parse the result set as array
        $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        var_dump($rows);
    }

    // Insert one record to certain table
    public function insertOne($data) {
        
    }
}
