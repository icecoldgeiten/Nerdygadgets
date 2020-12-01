<?php
include "header.php";
include "accountfunctions.php";
$_SESSION["inlog"] = false;
?>
<form method="post">
<label for="Username">Gebruikersnaam *<br>
    <input type="text" name="Username" required><br>
</label>
<br>
<label for="Password">Wachtwoord *<br>
    <input type="text" name="Password" minlength="8" required><br>
</label>
<br>
<input type="submit" value="Login" name="submit">
</form>
<?php
if (isset($_POST["submit"]) && !empty($_POST) && CheckUsername($_POST["username"])){
    if(CheckUser($_POST["Username"], $_POST["Password"])) {
        $_SESSION["inlog"] = true;
    }
    else {
        echo ("De combinatie van uw gebruikersnaam en het wachtwoord is onbekend in ons systeem... Probeer het nogmaals...");
    }
}
include "footer.php";