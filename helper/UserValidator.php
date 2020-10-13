<?php

/**
 * Class name: UserValidator
 * Purpose: Validate user input, both on registration and sign in
 * Created at: [DD-MM-YYYY] [08-10-2020]
 */

class UserValidator {
    private $postData;
    private $validationType;
    private $registerRequiredFields = ["firstName", "email", "password", "passwordConfirmation"];
    private $loginRequiredFields = ["email", "password"];
    private $errors = [];

    public function __construct($postData, $validationType) {
        $this->postData = $postData;
        $this->validationType = $validationType;
    }

    public function validateForm() {
        // Check if all fields are filled
        if ($this->validationType === "register") {
            foreach ($this->registerRequiredFields as $field) {
                if (!array_key_exists($field, $this->postData)) {
                    trigger_error("$field is not present in the posted data");
                    return;
                }
            }
        } elseif ($this->validationType === "login") {
            foreach ($this->loginRequiredFields as $field) {
                if (!array_key_exists($field, $this->postData)) {
                    trigger_error("$field is not present in the posted data");
                    return;
                }
            }
        } else {
            trigger_error("Unknown validation type.");
            return;
        }

        $this->validateUsername();
        $this->validateEmail();
        $this->validatePassword();

        return $this->errors;
    }

    private function validateUsername() {
        // At least firstName must be present
        $firstName = trim($this->postData["firstName"]);
        $lastName = trim($this->postData["lastName"]);
        $fullName = trim("$firstName $lastName");
        if (empty($fullName)) {
            $this->addError("firstName", "Firstname cannot be empty!");
        } else {
            if (!preg_match("/^[a-zA-Z0-9]{1,12}$/", $fullName)) {
                $this->addError("firstName", "Name must be between 1-12 character(s) and alphanumeric!");
            }
        }
    }

    private function validateEmail() {
        $email = trim($this->postData["email"]);
        if (empty($email)) {
            $this->addError("email", "Email cannot be empty!");
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->addError("email", "Email must be valid!");
            }
        }
    }

    private function validatePassword() {
        $password = trim($this->postData["password"]);
        $passwordConfirmation = trim($this->postData["passwordConfirmation"]);
        if (empty($password) || empty($passwordConfirmation)) {
            $this->addError("password", "Password and the confirmation cannot be empty!");
        } else if ($this->validationType === "register") {
            if ($password === $passwordConfirmation) {
                if (!preg_match("/^[a-zA-Z0-9]{8,16}$/", $password)) {
                    $this->addError("password", "Password must be between 8-16 character(s) and alphanumeric!");
                }
            } else {
                $this->addError("password", "Password and the confirmation doesn't match!");
            }
        }
    }

    private function addError($field, $errorMessage) {
        $this->errors[$field] = $errorMessage;
    }
}
