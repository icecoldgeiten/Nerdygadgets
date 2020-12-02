<?php
include "header.php";
include "accountfunctions.php";
$_SESSION["inlog"] = false;
?>
<form method="post">
<label for="Username">Email adres *<br>
    <input type="text" name="EmailAddress" required><br>
</label>
<br>
<label for="Password">Wachtwoord *<br>
    <input type="password" name="Password" minlength="8" required><br>
</label>
<br>
<input type="submit" value="Login" name="submit">
</form>
<?php
if (isset($_POST["submit"]) && !empty($_POST)){
    if(CheckUser($_POST["EmailAddress"], $_POST["Password"])) {
        $_SESSION["inlog"] = true;
        $_SESSION["email"] = $_POST["EmailAddress"];
    }
    else {
        echo ("De combinatie van uw gebruikersnaam en het wachtwoord is onbekend in ons systeem... Probeer het nogmaals...");
    }
}
include "footer.php";