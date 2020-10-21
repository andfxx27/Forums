<?php

// Provide generic method to query DB
class Database {

    // Row status (soft modification)
    // I - INSERTED
    // D - DELETED
    // U - UPDATED

    protected $pdo;
    protected $tableName;
    private $tableIdColumn;

    public function __construct($pdo, $tableName) {
        $this->pdo = $pdo;
        $this->tableName = $tableName;

        switch ($this->tableName) {
            case TABLE_USER:
                $this->tableIdColumn = "user_id";
                break;
            
            case TABLE_POST:
                $this->tableIdColumn = "post_id";
                break;
        }
    }

    // Get all records from certain table
    public function getAll() {
        $sql = "SELECT * FROM $this->tableName WHERE status = 'I'";

        // ->query return result set as PDOStatement object
        // ->fetchAll parse the result set as array
        $rows = $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    // Get one record from certain table
    public function getOneById($id) {
        $sql = "SELECT * FROM $this->tableName WHERE $this->tableIdColumn=:$this->tableIdColumn";
        $stmt = $this->pdo->prepare($sql);

        if ($stmt->execute($id)) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // Insert one record to certain table
    public function insertOne($data) {
        // Construct the $column & $values part from $data
        // $column part visualized will be like: "column_name_1, column_name_2, ..."
        $column = "";

        // $values part visualized will be like: ":column_name_1, :column_name_2, ..."
        $values = "";

        $index = 0;
        foreach ($data as $columnName => $value) {
            
            $column .= $columnName;
            $values .= ":$columnName";

            if ($index < count($data) - 1) {
                $column .= ", ";
                $values .= ", ";
            }

            ++$index;
        }

        // This query match the key (columnName) from $data to each of its corresponding value
        $sql = "INSERT INTO $this->tableName ($column) VALUES ($values)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
}
