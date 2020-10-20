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

// Display all recent forum posts
$postsDb = new PostsTable($pdo, TABLE_POST);
$posts = $postsDb->getAllOrderByDateDesc();

?>

<!-- Display header accordingly -->
<?php if (isset($_SESSION["success_login"])) : ?>
    <?php require_once("templates/header_auth_account.php"); ?>
<?php else : ?>
    <?php require_once("templates/header_guest.php"); ?>
<?php endif; ?>

<!-- Bunch of past forum post -->
<main class="row container">
    <!-- List represent several number of post -->
    <!-- On small & medium screen, takes up all 12-parts column -->
    <!-- On large screen, takes up 9-parts/12 of the entire row -->
    <div class="col s12 m12 l9 left">
        <h1>Posts</h1>
        <ul class="collection">

            <!-- Display each post with pagination - WIP -->
            <?php foreach ($posts as $post) : ?>

                <!-- Onclick title/ arrow, redirect to corresponding forum_post.php page -->
                <li class="collection-item avatar">
                    <i class="material-icons circle">folder</i>
                    <span class="title"><a href="forum_post.php?post_id=<?= htmlspecialchars($post["post_id"]); ?>"> <?= htmlspecialchars($post["post_title"]); ?> </a></span>
                    <p class="truncate"> <?= htmlspecialchars($post["post_content"]); ?> </p>
                    <p>Posted: <?= htmlspecialchars($post["post_created_at"]); ?> </p>
                    <a href="forum_post.php?post_id=<?= htmlspecialchars($post["post_id"]); ?>" class="secondary-content"><i class="material-icons">keyboard_arrow_right</i></a>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>

    <!-- List forum post from most likes to least likes count -->
    <!-- On large screen, takes up 3-parts/12 of the entire row -->
    <div class="col l3 right hide-on-med-and-down">
        <h2>Popular</h2>
        <div class="divider"></div>
        <div class="section">
            <h5>Section 1</h5>
            <p>Stuff</p>
        </div>
        <div class="divider"></div>
        <div class="section">
            <h5>Section 2</h5>
            <p>Stuff</p>
        </div>
        <div class="divider"></div>
        <div class="section">
            <h5>Section 3</h5>
            <p>Stuff</p>
        </div>
    </div>
</main>

<?php require_once("templates/footer.php"); ?>

<!-- Check all session -->
<?php if (isset($_SESSION["success_create_post"])) : ?>
    <?php if (!$_SESSION["success_create_post"]) : ?>

        <!-- Display flash error message -->
        <script>
            displayToast(
                "Success on creating new post!",
                "success"
            );
        </script>

        <!-- Unset the session after usage -->
        <?php unset($_SESSION["success_create_post"]); ?>
    <?php endif; ?>
<?php endif; ?>