<?php
include "header.php";
include ""
?>
<form method="post">
    <h1>Hier kan je je gegevens aanpassen, mocht dat nodig zijn.</h1>
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
    <input type="submit" value="Ga door..." name="submit">
</form>