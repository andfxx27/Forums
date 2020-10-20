<?php

// Side note: private member is inherited from parent class, but not visible--
//--directly from the inheriting class
// Provide method specific to query users table
class UsersTable extends Database {
    public function __construct($pdo, $tableName) {
        // Call parent's constructor
        parent::__construct($pdo, $tableName);
    }

    // Method specific to users table
    public function getOneByEmail($email) {
        $sql = "SELECT * FROM $this->tableName WHERE user_email=:user_email";
        $stmt = $this->pdo->prepare($sql);

        // ->execute return boolean of whether the query is success or not
        if ($stmt->execute(["user_email" => $email])) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    // Verify user login
    public function verifyUserAccount($user, $password) {
        return password_verify($password, $user["user_password"]);
    }
}
