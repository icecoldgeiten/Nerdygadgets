<?php
include "header.php";
include "accountfunctions.php";
?>
<form method="post" action="">
    <label for="EmailAddress">Emailadres *<br>
        <input type="text" name="EmailAddress" required><br>
    </label>
    <br>
    <label for="Username">Gebruikersnaam *<br>
        <input type="text" name="Username" required><br>
    </label>
    <br>
    <label for="Password">Wachtwoord *<br>
        <input type="text" name="Password" minlength="8" required><br>
    </label>
    <label for="password2">Nogmaals uw wachtwoord *<br>
        <input type="text" name="password2" minlength="8" required><br>
    </label>
    <br>
    <label for="Name">Naam *<br>
        <input type="text" name="Name" required><br>
    </label>
    <br>
    <label for="Address">Adresregel 1 *<br>
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
    <input type="submit" value="Ga door...">
</form>
<br>
<?php
if (isset($_POST["submit"]) && CheckPwd($_POST["Password"], $_POST["password2"]) === true) {
    if (!empty($_POST)){
        InsertUser($_POST);
        if (InsertUser()){
            echo ("Uw account is aangemaakt, u wordt nu doorgestuurd naar de inlogpagina!");
            header("location: login.php");
        }
        else{
            echo ("Er is een fout opgetreden, probeer het later nog een keer...");
        }
    }
    else {
        echo "De velden zijn niet ingevuld";
    }
}
else {
    CheckPwd($_POST["Password"], $_POST["password2"]);
    }
include "footer.php";