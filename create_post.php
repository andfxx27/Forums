<?php

// Config directory
require_once "config/config.php";
require_once "config/session.php";

// Helper directory
require_once "helper/TablenameConstants.php";
require_once "helper/UserAuthenticator.php";
require_once "helper/PostValidator.php";

// Logic directory
require_once "logic/Database.php";
require_once "logic/PostsTable.php";
require_once "logic/UsersTable.php";

// Check whether user has logged in
if (isAuthenticated()) {
    $db = new UsersTable($pdo, TABLE_USER);
    $user = $db->getOneByEmail($_SESSION["success_login"]);
} else {
    // Redirect user to landing page if they haven't login yet
    header("location: index.php");
}

if (isset($_POST["post"])) {
    $postValidator = new PostValidator($_POST, $user["user_id"]);
    $finalResult = $postValidator->validateForm();
    $errors = $finalResult["errors"];

    if (!$errors) {
        $db = new PostsTable($pdo, TABLE_POST);

        if ($db->insertOne($finalResult["sanitizedData"])) {
            // Success insert to DB
            // Set session indicating success create post
            $_SESSION["success_create_post"] = true;

            // Redirect to home on success create post
            header("location: index.php");
        } else {
            // Set session indicating failed create post
            $_SESSION["success_create_post"] = false;
        }
    }

    unset($_POST["post"]);
}

?>

<?php require_once("templates/header_auth_account.php"); ?>

<main class="container">
    <h3>Create post</h3>
    <form action="<?= $_SERVER["PHP_SELF"]; ?>" autocomplete="off" method="post">
        <!-- Post title -->
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">title</i>
                <label for="postTitle">Post Title</label>
                <input type="text" name="postTitle" id="postTitle" class="validate" autocomplete="off" value="<?= htmlspecialchars($_POST["postTitle"] ?? ""); ?>">
                <span class="red-text"><?= $errors["postTitle"] ?? ""; ?></span>
            </div>
        </div>

        <!-- password -->
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">short_text</i>
                <label for="postContent">Post Content</label>
                <textarea name="postContent" id="postContent" class="materialize-textarea" data-length="300" autocomplete="off"><?= htmlspecialchars($_POST["postContent"] ?? ""); ?></textarea>
                <span class="red-text"><?= $errors["postContent"] ?? ""; ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col s3 l2">
                <button class="btn waves-effect waves-light light-blue darken-2" type="submit" name="post" value="post">
                    Post
                    <i class="material-icons right">send</i>
                </button>
            </div>
        </div>
    </form>
</main>

<?php require_once("templates/footer.php"); ?>

<!-- Check all session -->
<?php if (isset($_SESSION["success_create_post"])) : ?>
    <?php if (!$_SESSION["success_create_post"]) : ?>

        <!-- Display flash error message -->
        <script>
            displayToast(
                "Error on creating new post. Please try again later!",
                "error"
            );
        </script>

        <!-- Unset the session after usage -->
        <?php unset($_SESSION["success_create_post"]); ?>
    <?php endif; ?>
<?php endif; ?>