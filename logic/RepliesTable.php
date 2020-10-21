<?php

class RepliesTable extends Database {
    public function __construct($pdo, $tableName) {
        parent::__construct($pdo, $tableName);
    }

    // Method specific to replies table
    public function getAllByPostId($postId) {
        $sql = "SELECT * FROM $this->tableName WHERE status = 'I' AND post_id=:post_id";

        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute($postId)) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }
}
