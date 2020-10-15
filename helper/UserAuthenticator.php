<?php

function isAuthenticated() {
    if (!isset($_SESSION["success_login"])) {
        return false;
    }

    return true;
}