<?php
include "header.php";
include "accountfunctions.php";
if (isset($_SESSION["inlog"])) {
    if ($_SESSION["inlog"] === true) {
        header("location: account.php");
    } else {
        $_SESSION["inlog"] = false;
    }
}
if (isset($_POST["register"])) {
    header("location: register.php");
}
?>
    <div class="col-md-12">
        <form method="post" class="col-md-6 offset-md-3 col-xs-12">
            <h3>Inlog pagina</h3>
            <div class="form-group">
                <label for="EmailAddress">Email adres <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="EmailAddress" required>
            </div>
            <div class="form-group">
                <label for="Password">Wachtwoord <span class="text-danger">*</span> </label>
                <input type="password" class="form-control" name="Password" minlength="8" required>
            </div>
            <input type="submit" class="btn btn-success mb-2 mb-md-0" value="Log in" name="submit">
            <a href="register.php" class="btn btn-outline-info">Ik heb nog geen account</a>
        </form>
        <?php
        if (isset($_POST["submit"]) && !empty($_POST)) {
            if (CheckUser($_POST["EmailAddress"], $_POST["Password"])) {
                $_SESSION["inlog"] = true;
                $_SESSION["email"] = $_POST["EmailAddress"];
            } else {
                echo("De combinatie van uw gebruikersnaam en het wachtwoord is onbekend in ons systeem... Probeer het nogmaals...");
            }
        }
        ?>
    </div>
<?php
include "footer.php";
?>