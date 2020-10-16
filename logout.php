<?php

require_once "config/session.php";

// Destroy all session
session_destroy();

// Redirect to landing page
header("location: index.php");