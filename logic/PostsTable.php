<?php

// Provide method specific to query posts table
class PostsTable extends Database {
    public function __construct($pdo, $tableName) {
        parent::__construct($pdo, $tableName);
    }

    // Method specific to posts table
    // Get all records from posts table ordered by posting date descendingly
    public function getAllOrderByDateDesc() {
        $sql = "SELECT * FROM $this->tableName WHERE status = 'I' ORDER BY post_created_at";

        // ->query return result set as PDOStatement object
        // ->fetchAll parse the result set as array
        $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }
}
