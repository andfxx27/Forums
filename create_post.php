<?php 

// Config directory
require_once "config/config.php";
require_once "config/session.php";

// Helper directory
require_once "helper/TablenameConstants.php";
require_once "helper/UserAuthenticator.php";
require_once "helper/UserValidator.php";

// Logic directory
require_once "logic/Database.php";
require_once "logic/UsersTable.php";

// Check whether user has logged in
if (isset($_SESSION["success_login"])) {
    $db = new UsersTable($pdo, TABLE_USER);

    $user = $db->getUserByEmail($_SESSION["success_login"]);
}

if (!isAuthenticated()) {
    header("location: index.php");
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
                <textarea name="postContent" id="postContent" class="validate not-resizable" autocomplete="off">

                </textarea>
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