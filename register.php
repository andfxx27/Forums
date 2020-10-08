<?php 

if (isset($_POST["register"])) {

}

?>

<?php require_once("templates/header_guest.php"); ?>

<main class="row container">
    <h3>Register</h3>
    <form action="register.php" class="col s12" autocomplete="off" method="post">

        <!-- firstName & lastName -->
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">account_circle</i>
                <label for="firstName">First Name</label>
                <input type="text" name="firstName" id="firstName" class="validate">
            </div>
            <div class="input-field col s6">
                <label for="lastName">Last Name</label>
                <input type="text" name="lastName" id="lastName" class="validate">
            </div>
        </div>

        <!-- email -->
        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">email</i>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="validate">
            </div>
        </div>

        <!-- password & passwordConfirmation -->
        <div class="row">
            <div class="input-field col s6">
                <i class="material-icons prefix">lock</i>
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="validate" autocomplete="off">
            </div>
            <div class="input-field col s6">
                <label for="passwordConfirmation">Password Confirmation</label>
                <input type="password" name="passwordConfirmation" id="passwordConfirmation" class="validate">
            </div>
        </div>

        <button class="btn waves-effect waves-light light-blue darken-2" type="submit" name="register" value="register">
            Register
            <i class="material-icons right">send</i>
        </button>
    </form>
</main>

<?php require_once("templates/footer.php"); ?>