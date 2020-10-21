<!-- Display single forum post -->
<?php

// Config directory
require_once "config/config.php";
require_once "config/session.php";

// Helper directory
require_once "helper/TablenameConstants.php";
require_once "helper/ReplyValidator.php";

// Logic directory
require_once "logic/Database.php";
require_once "logic/PostsTable.php";
require_once "logic/RepliesTable.php";
require_once "logic/UsersTable.php";

// Check whether user has logged in
$usersDb = new UsersTable($pdo, TABLE_USER);
$user;

if (isset($_SESSION["success_login"])) {
    $user = $usersDb->getOneByEmail($_SESSION["success_login"]);
}

// Query the post information including the author's basic information
$postsDb = new PostsTable($pdo, TABLE_POST);
$post = $postsDb->getOneById($_GET);

// Redirect to 404 page in case user hard coded the 
if (!$post) {
    header("location: 404.php");
}

// Only allow reply when user is logged in
if (isset($_POST["reply"]) && isset($user)) {
    $replyValidator = new ReplyValidator($_POST, $user["user_id"], $post["post_id"]);
    $finalResult = $replyValidator->validateForm();
    $errors = $finalResult["errors"];

    if (!$errors) {
        $repliesDb = new RepliesTable($pdo, TABLE_REPLY);

        if ($repliesDb->insertOne($finalResult["sanitizedData"])) {
            // Success insert to DB
            $_SESSION["success_reply_post"] = true;
        } else {
            // Failed insert to DB
            $_SESSION["success_reply_post"] = false;
        }
    }

    unset($_POST["reply"]);
}

$postAuthor = $usersDb->getOneById(["user_id" => $post["user_id"]]);

$repliesDb = new RepliesTable($pdo, TABLE_REPLY);
$replies = $repliesDb->getAllByPostId(["post_id" => $post["post_id"]]);

?>

<!-- Display header accordingly -->
<?php if (isset($_SESSION["success_login"])) : ?>
    <?php require_once("templates/header_auth_account.php"); ?>
<?php else : ?>
    <?php require_once("templates/header_guest.php"); ?>
<?php endif; ?>

<!-- Still need heavy re-styling with own CSS -->
<main class="container row">

    <!-- Main forum post -->
    <ul class="collection s6">
        <li class="collection-item avatar">
            <!-- Thread starter profile picture -->
            <img src="https://picsum.photos/id/237/200/300" alt="Author's profile picture" class="circle">

            <!-- Thread starter fullname -->
            <span class="margin-right-xsm"><?= htmlspecialchars($postAuthor["user_fullname"]); ?></span>

            <!-- Thread posted date -->
            <span><?= htmlspecialchars($post["post_created_at"]); ?></span>

            <p class="title"> <?= htmlspecialchars($post["post_title"]); ?> </p>
            <p><?= htmlspecialchars($post["post_content"]); ?></p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
        </li>
        <li class="collection-item">
            <form action="<?= $_SERVER["PHP_SELF"] . "?post_id={$_GET["post_id"]}"; ?>" method="post">
                <div class="row">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">short_text</i>
                        <label for="replyContent">Reply Content</label>
                        <textarea name="replyContent" id="replyContent" class="materialize-textarea" data-length="300" autocomplete="off"><?= htmlspecialchars($_POST["replyContent"] ?? ""); ?></textarea>
                        <span class="red-text"><?= $errors["replyContent"] ?? ""; ?></span>
                    </div>
                </div>

                <div class="row">
                    <div class="col s3 l2">
                        <button class="btn waves-effect waves-light light-blue darken-2" type="submit" name="reply" value="reply">
                            Reply
                            <i class="material-icons right">send</i>
                        </button>
                    </div>
                </div>
            </form>
        </li>
    </ul>

    <!-- For replies -->
    <ul class="collection">

        <?php foreach ($replies as $reply) : ?>

            <?php 
            
            // Query the reply's author
            $replyAuthor = $usersDb->getOneById(["user_id" => $reply["user_id"]]);
                
            ?>

            <li class="collection-item avatar">
                <!-- Reply's author profile picture -->
                <img src="https://picsum.photos/id/237/200/300" alt="Author's profile picture" class="circle">
                
                <!-- Reply's author name -->
                <span class="title margin-right-xsm"><?= htmlspecialchars($replyAuthor["user_fullname"]); ?></span>
                
                <!-- Reply's date -->
                <span><?= htmlspecialchars($reply["reply_created_at"]); ?></span>

                <p><?= htmlspecialchars($reply["reply_content"]); ?></p>
                <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
            </li>
        <?php endforeach; ?>
    </ul>
</main>

<?php require_once("templates/footer.php"); ?>

<!-- Check all session -->
<?php if (isset($_SESSION["success_reply_post"])) : ?>
    <?php if (!$_SESSION["success_reply_post"]) : ?>

        <!-- Display flash error message -->
        <script>
            displayToast(
                "Error on replying the post. Make sure you are logged in and try again later!",
                "error"
            );
        </script>
        <!-- Unset the session after usage -->
        <?php unset($_SESSION["success_reply_post"]); ?>

    <?php else : ?>
        <script>
            displayToast(
                "Success on replying the post!",
                "success"
            );
        </script>
        <?php unset($_SESSION["success_reply_post"]); ?>
    <?php endif; ?>

<?php endif; ?>