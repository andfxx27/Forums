<!-- 404 Not found page -->
<?php

// Config directory
require_once "config/config.php";
require_once "config/session.php";

// Helper directory
require_once "helper/TablenameConstants.php";

// Logic directory
require_once "logic/Database.php";
require_once "logic/UsersTable.php";

// Check whether user has logged in
$usersDb = new UsersTable($pdo, TABLE_USER);
$user;

if (isset($_SESSION["success_login"])) {
    $user = $usersDb->getOneByEmail($_SESSION["success_login"]);
}

?>

<!-- Display header accordingly -->
<?php if (isset($_SESSION["success_login"])) : ?>
    <?php require_once("templates/header_auth_account.php"); ?>
<?php else : ?>
    <?php require_once("templates/header_guest.php"); ?>
<?php endif; ?>

<main class="container">
    <h1>404 Not Found!</h1>
</main>

<?php require_once("templates/footer.php"); ?>