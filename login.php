<?php
include "header.php";
include "accountfunctions.php";
if ($_SESSION["inlog"] === true ){
    header("location: account.php");
}else {
$_SESSION["inlog"] = false;
}
if (isset($_POST["register"])){
    header("location: register.php");
}
?>
<form method="post">
<label for="Username">Email adres *<br>
    <input type="text" name="EmailAddress"><br>
</label>
<br>
<label for="Password">Wachtwoord *<br>
    <input type="password" name="Password" minlength="8"><br>
</label>
<br>
<input type="submit" value="Login" name="submit">
<input type="submit" value="register" name="register">
</form>
<?php
if (isset($_POST["register"])){
    header("location: register.php");
}
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