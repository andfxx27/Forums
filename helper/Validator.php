<?php 

/**
 * Class name: Validator
 * Purpose: base class for any other Validator class
 * Created at: [DD-MM-YYYY] [16-10-2020]
 */

 abstract class Validator {
    // Common class properties
    protected $errors = []; 
    protected $postData;
    protected $sanitizedData = [];

    // Store the combined result of $errors and $sanitizedData
    protected $finalResult = [];

    // Abstract method
    abstract public function validateForm();
    
    protected function addError($field, $errorMessage) {
        $this->errors[$field] = $errorMessage;
    }

    protected function addSanitizedData($field, $value) {
        $this->sanitizedData[$field] = $value;
    }
 }