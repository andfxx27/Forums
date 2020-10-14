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
    private $sanitizedData = [];

    // Store the combined result of $errors and $sanitizedData
    private $finalResult = [];

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

        $this->finalResult["errors"] = $this->errors;
        $this->finalResult["sanitizedData"] = $this->sanitizedData;

        return $this->finalResult;
    }

    private function validateUsername() {
        // At least firstName must be present
        $firstName = trim($this->postData["firstName"]);
        $lastName = trim($this->postData["lastName"]);
        $fullName = trim("$firstName $lastName");
        if (empty($fullName)) {
            $this->addError("firstName", "Firstname cannot be empty!");
        } else {
            if (!preg_match("/^[a-zA-Z0-9 ]{1,}$/", $fullName)) {
                $this->addError("firstName", "Name must be at least 1 character and alphanumeric!");
            }
        }

        // Check if there is any error
        if (!array_key_exists("firstName", $this->errors)) {
            $this->addSanitizedData("user_fullname", $fullName);
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

        if (!array_key_exists("email", $this->errors)) {
            $this->addSanitizedData("user_email", $email);
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

        if (!array_key_exists("password", $this->errors)) {
            // Hash the password accordingly, and store the hashed password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $this->addSanitizedData("user_password", $hashedPassword);
        }
    }

    private function addError($field, $errorMessage) {
        $this->errors[$field] = $errorMessage;
    }

    private function addSanitizedData($field, $value) {
        $this->sanitizedData[$field] = $value;
    }
}