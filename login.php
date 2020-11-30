<?php
include "header.php";
include "accountfunctions.php";
$_SESSION["inlog"] = false;
?>
<form method="post" action="">
<label for="Username">Gebruikersnaam *<br>
    <input type="text" name="Username" required><br>
</label>
<br>
<label for="Password">Wachtwoord *<br>
    <input type="text" name="Password" minlength="8" required><br>
</label>
<br>
<input type="submit" value="Login">
</form>
<?php
if (isset($_POST["submit"])){
    if(CheckUser($_POST["Username"], $_POST["Password"])){
        $_SESSION["inlog"] = true;

    }
    else {
        echo ("De combinatie van uw e-mailadres en het wachtwoord is onbekend in ons systeem... Probeer het nogmaals...");
    }
}
include "footer.php";