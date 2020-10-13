<?php

// Config directory
require_once "config/config.php";

// Helper directory
require_once "helper/UserValidator.php";

// Logic directory
require_once "logic/Database.php";

if (isset($_POST["register"])) {
    $userValidator = new UserValidator($_POST, "register");
    $errors = $userValidator->validateForm();

    if (!$errors) {
        // No error message, data is valid -> insert to DB
        
    } else {
        
    }
}

?>

<?php require_once("templates/header_guest.php"); ?>

<main class="row container">
    <h3>Register</h3>
    <!-- Points to the current file -->
    <form action="<?= $_SERVER["PHP_SELF"]; ?>" class="col s12" autocomplete="off" method="post">

        <!-- firstName & lastName -->
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" class="validate" autocomplete="off" value="<?= htmlspecialchars($_POST["firstName"] ?? ""); ?>">
                <span class="red-text"><?= $errors["firstName"] ?? ""; ?></span>
            </div>
            <div class="input-field col s6">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" class="validate" autocomplete="off" value="<?= htmlspecialchars($_POST["lastName"] ?? ""); ?>">
            </div>
        </div>

        <!-- email -->
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="validate" autocomplete="off" value="<?= htmlspecialchars($_POST["email"] ?? ""); ?>">
                <span class="red-text"><?= $errors["email"] ?? ""; ?></span>
            </div>
        </div>

        <!-- password & passwordConfirmation -->
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">lock</i>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="validate" autocomplete="off" value="<?= htmlspecialchars($_POST["password"] ?? ""); ?>">
                <span class="red-text"><?= $errors["password"] ?? ""; ?></span>
            </div>
            <div class="input-field col s6">
                <label for="passwordConfirmation">Password Confirmation</label>
                <input type="password" name="passwordConfirmation" id="passwordConfirmation" class="validate" autocomplete="off" value="<?= htmlspecialchars($_POST["passwordConfirmation"] ?? ""); ?>">
            </div>
        </div>

        <div class="row">
            <div class="col s3 l2">
                <button class="btn waves-effect waves-light light-blue darken-2" type="submit" name="register" value="register">
                    Register
                    <i class="material-icons right">send</i>
                </button>
            </div>

            <div class="col s9 l10">
                Already have an account? Click <a href="login.php">here</a> to login into the forum.
            </div>
        </div>
    </form>
</main>

<?php require_once("templates/footer.php"); ?>