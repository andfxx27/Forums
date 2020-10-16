<?php

// Provide method specific to query posts table
class PostsTable extends Database {
    public function __construct($pdo, $tableName) {
        parent::__construct($pdo, $tableName);
    }

    // Method specific to posts table
}
