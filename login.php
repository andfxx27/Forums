<?php

// Config directory
require_once "config/config.php";
require_once "config/session.php";

// Helper directory
require_once "helper/TablenameConstants.php";
require_once "helper/UserValidator.php";

// Logic directory
require_once "logic/Database.php";
require_once "logic/UsersTable.php";

if (isset($_POST["login"])) {
    $userValidator = new UserValidator($_POST, "login");
    $finalResult = $userValidator->validateForm();
    $errors = $finalResult["errors"];

    if (!$errors) {
        // No error message, data is valid -> check user availability from DB
        $db = new UsersTable($pdo, TABLE_USER);

        // Check if the user is registered
        $user = $db->getOneByEmail($finalResult["sanitizedData"]["user_email"]);

        if ($user) {
            // Check if the password is correct
            if ($db->verifyUserAccount($user, $finalResult["sanitizedData"]["user_password"])) {
                // User is authenticated -> set session to user's email
                $_SESSION["success_login"] = $user["user_email"];
                header("location: index.php");
            } else {
                $_SESSION["success_login"] = false;
            }
        } else {
            // No user account is found
            $_SESSION["success_login"] = false;
        }
    } else {
        $_SESSION["success_login"] = false;
    }

    unset($_POST["login"]);
}

?>

<?php require_once("templates/header_guest.php"); ?>

<main class="container">
    <h3>Login</h3>
    <form action="<?= $_SERVER["PHP_SELF"]; ?>" autocomplete="off" method="post">
        <!-- email -->
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="validate" autocomplete="off" value="<?= htmlspecialchars($_POST["email"] ?? ""); ?>">
                <span class="red-text"><?= $errors["email"] ?? ""; ?></span>
            </div>
        </div>

        <!-- password -->
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="validate" autocomplete="off" value="<?= htmlspecialchars($_POST["password"] ?? ""); ?>">
                <span class="red-text"><?= $errors["password"] ?? ""; ?></span>
            </div>
        </div>

        <div class="row">
            <div class="col s3 l2">
                <button class="btn waves-effect waves-light light-blue darken-2" type="submit" name="login" value="login">
                    Login
                    <i class="material-icons right">send</i>
                </button>
            </div>

            <div class="col s9 l10">
                Don't have an account yet? Click <a href="register.php">here</a> to register a new account.
            </div>
        </div>
    </form>
</main>

<?php require_once("templates/footer.php"); ?>

<!-- Check all session -->
<!-- Success registration session -->
<?php if (isset($_SESSION["success_insert"])) : ?>
    <?php if ($_SESSION["success_insert"]) : ?>

        <!-- Display flash success message -->
        <script>
            displayToast(
                "Success on registering new account! You are now able to login to the forum.",
                "success"
            );
        </script>

        <!-- Unset the session after usage -->
        <?php unset($_SESSION["success_insert"]); ?>
    <?php endif; ?>
<?php endif; ?>

<!-- Failed login session -->
<?php if (isset($_SESSION["success_login"])) : ?>
    <?php if (!$_SESSION["success_login"]) : ?>

        <script>
            displayToast(
                "Failed on login process! Make sure your credentials are registered correctly.",
                "error"
            );
        </script>

        <!-- Unset the session after usage -->
        <?php unset($_SESSION["success_login"]); ?>
    <?php endif; ?>
<?php endif; ?>