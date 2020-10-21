<?php

require_once "helper/Validator.php";

/**
 * Class name: PostValidator
 * Purpose: validate post input
 * Created at: [DD-MM-YYYY] [16-10-2020]
 */

class PostValidator extends Validator {
    private $requiredFields = ["postTitle", "postContent"];
    private $userId;

    public function __construct($postData, $userId) {
        $this->postData = $postData;
        $this->userId = $userId;
    }

    public function validateForm() {
        // Check if all fields are filled
        foreach ($this->requiredFields as $field) {
            if (!array_key_exists($field, $this->postData)) {
                trigger_error("$field is not present in the posted data");
                return;
            }
        }

        $this->validatePostTitle();
        $this->validatePostContent();

        $this->finalResult["errors"] = $this->errors;
        $this->finalResult["sanitizedData"] = $this->sanitizedData;

        // Also add user id here indicating the author which post the forum thread
        $this->finalResult["sanitizedData"]["user_id"] = $this->userId;

        return $this->finalResult;
    }

    private function validatePostTitle() {
        $postTitle = trim($this->postData["postTitle"]);

        if (empty($postTitle)) {
            $this->addError("postTitle", "Post title cannot be empty!");
        } else {
            if (!preg_match("/^[\W\S_]{1,}$/", $postTitle)) {
                $this->addError("postTitle", "Post title must be at least 1 character and alphanumeric!");
            }
        }

        if (!array_key_exists("postTitle", $this->errors)) {
            $this->addSanitizedData("post_title", $postTitle);
        }
    }

    private function validatePostContent() {
        $postContent = trim($this->postData["postContent"]);

        if (empty($postContent)) {
            $this->addError("postContent", "Post content cannot be empty!");
        } else {
            if (!preg_match("/^[\W\S_]{1,}$/", $postContent)) {
                $this->addError("postContent", "Post content must be at least 1 character and alphanumeric!");
            }
        }

        if (!array_key_exists("postContent", $this->errors)) {
            $this->addSanitizedData("post_content", $postContent);
        }
    }
}
