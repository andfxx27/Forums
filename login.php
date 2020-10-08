<?php 

if (isset($_POST["login"])) {

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
                <input type="text" name="email" id="email" class="validate" autocomplete="off">
            </div>
        </div>

        <!-- password -->
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="validate" autocomplete="off">
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