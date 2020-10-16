<?php

// Check whether a user is authenticated -> to prevent them from brute-forcing file access
function isAuthenticated() {
    if (!isset($_SESSION["success_login"])) {
        return false;
    }

    return true;
}