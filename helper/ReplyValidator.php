<?php

require_once "helper/Validator.php";

/**
 * Class name: ReplyValidator
 * Purpose: validate reply input
 * Created at: [DD-MM-YYYY] [21-10-2020]
 */

class ReplyValidator extends Validator {
    private $requiredFields = ["replyContent"];
    private $userId;
    private $postId;

    public function __construct($postData, $userId, $postId) {
        $this->postData = $postData;
        $this->userId = $userId;
        $this->postId = $postId;
    }

    public function validateForm() {
        // Check if all fields are filled
        foreach ($this->requiredFields as $field) {
            if (!array_key_exists($field, $this->postData)) {
                trigger_error("$field is not present in the posted data");
                return;
            }
        }

        $this->validateReplyContent();

        $this->finalResult["errors"] = $this->errors;
        $this->finalResult["sanitizedData"] = $this->sanitizedData;

        $this->finalResult["sanitizedData"]["user_id"] = $this->userId;
        $this->finalResult["sanitizedData"]["post_id"] = $this->postId;

        return $this->finalResult;
    }

    private function validateReplyContent() {
        $replyContent = trim($this->postData["replyContent"]);
        
        if (empty($replyContent)) {
            $this->addError("replyContent", "Reply content cannot be empty!");
        } else {
            if (!preg_match("/^[\W\S_]{1,}$/", $replyContent)) {
                $this->addError("replyContent", "Reply content must be at least 1 character and alphanumeric!");
            }
        }

        if (!array_key_exists("replyContent", $this->errors)) {
            $this->addSanitizedData("reply_content", $replyContent);
        }
    }
}
