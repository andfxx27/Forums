<!-- Display single forum post -->
<?php

// Config directory
require_once "config/config.php";
require_once "config/session.php";

// Helper directory
require_once "helper/TablenameConstants.php";
require_once "helper/UserValidator.php";

// Logic directory
require_once "logic/Database.php";
require_once "logic/PostsTable.php";
require_once "logic/UsersTable.php";

// Check whether user has logged in
$usersDb = new UsersTable($pdo, TABLE_USER);

if (isset($_SESSION["success_login"])) {
    $user = $usersDb->getOneByEmail($_SESSION["success_login"]);
}

// Query the post information including the author's basic information
$postsDb = new PostsTable($pdo, TABLE_POST);
$post = $postsDb->getOneById($_GET);

$postAuthor = $usersDb->getOneById(["user_id" => $post["user_id"]]);

?>

<!-- Display header accordingly -->
<?php if (isset($_SESSION["success_login"])) : ?>
    <?php require_once("templates/header_auth_account.php"); ?>
<?php else : ?>
    <?php require_once("templates/header_guest.php"); ?>
<?php endif; ?>

<!-- Still need heavy re-styling with own CSS -->
<main class="container">

    <!-- Main forum post -->
    <ul class="collection">
        <li class="collection-item avatar">
            <!-- Thread starter profile picture -->
            <img src="https://picsum.photos/id/237/200/300" alt="Author's profile picture" class="circle">

            <!-- Thread starter fullname -->
            <span><?= htmlspecialchars($postAuthor["user_fullname"]); ?></span>

            <!-- Thread posted date -->
            <span><?= htmlspecialchars($post["post_created_at"]); ?></span>

            <p class="title"> <?= htmlspecialchars($post["post_title"]); ?> </p>
            <p><?= htmlspecialchars($post["post_content"]); ?></p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
    </ul>

    <!-- For replies -->
    <ul class="collection">
        <li class="collection-item avatar">
            <i class="material-icons circle">person</i>
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
        <li class="collection-item avatar">
            <i class="material-icons circle">person</i>
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">heart</i></a>
        </li>
        <li class="collection-item avatar">
            <i class="material-icons circle green">person</i>
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
        <li class="collection-item avatar">
            <i class="material-icons circle red">person</i>
            <span class="title">Title</span>
            <p>First Line <br>
                Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
    </ul>
</main>

<?php require_once("templates/footer.php"); ?>