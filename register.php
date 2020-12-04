<?php
include "header.php";
include "accountfunctions.php";
if ($_SESSION["inlog"]){
    header("location: account.php");
}
?>
<form method="post">
    <label for="EmailAddress">Emailadres *<br>
        <input type="text" name="EmailAddress" required><br>
    </label>
    <br>
    <label for="Password">Wachtwoord *<br>
        <input type="password" name="Password" minlength="8" required><br>
    </label>
    <label for="password2">Nogmaals uw wachtwoord *<br>
        <input type="password" name="password2" minlength="8" required><br>
    </label>
    <br>
    <label for="Name">Naam *<br>
        <input type="text" name="Name" required><br>
    </label>
    <br>
    <label for="Address">Straatnaam en huisnummer *<br>
        <input type="text" name="Address" required><br>
    </label>
    <br>
    <label for="Address2">Adresregel 2<br>
        <input type="text" name="Address2"><br>
    </label>
    <br>
    <label for="PostalCode">Postcode *<br>
        <input type="text" name="PostalCode" required max="6"><br>
    </label>
    <label for="City">Plaats *<br>
        <input type="text" name="City" required><br>
    </label>
    <br>
    <label for="PhoneNumber">Telefoonnummer *<br>
        <input type="tel" name="PhoneNumber" value="+31" required><br>
    </label>
    <br>
    <input type="submit" value="Ga door..." name="submit">
</form>
<br>
<?php
if (isset($_POST["submit"])) {
    if (!CheckUsername($_POST["EmailAddress"])) {
        if (!empty($_POST) && CheckPwd($_POST["Password"], $_POST["password2"]) === true) {
            InsertUser($_POST);
            echo("Uw account is aangemaakt, u wordt nu doorgestuurd naar de inlogpagina!");
            header("location: login.php");
        } elseif (CheckPwd($_POST["Password"], $_POST["password2"])) {
            print CheckPwd($_POST["Password"], $_POST["password2"]);
        } else {
            echo("Er is een fout opgetreden, probeer het later nog een keer...");
        }
    } else{
        print "gebruikersnaam al in gebruik";
    }
}


include "footer.php";