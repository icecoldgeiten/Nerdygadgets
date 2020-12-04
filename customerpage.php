<?php
include "header.php";
include "accountfunctions.php";
$username = $_SESSION["email"];

$information = GetInformation($username);

foreach ($information as $key => $value) {
    ?>
    <form method="post">
        <h1>Hier kan je je gegevens aanpassen, mocht dat nodig zijn.</h1>
        <label for="EmailAddress">Emailadres <br>
            <input type="text" name="EmailAddress" value="<?=$value["EmailAddress"]?>" ><br>
        </label>
        <br>
        <label for="Password">Wachtwoord <br>
            <input type="text" name="Password" minlength="8" ><br>
        </label>
        <label for="password2">Nogmaals uw wachtwoord <br>
            <input type="text" name="password2" minlength="8" ><br>
        </label>
        <br>
        <label for="Name">Naam <br>
            <input type="text" name="Name" value="<?=$value["Name"]?>" ><br>
        </label>
        <br>
        <label for="Address">Adresregel 1 <br>
            <input type="text" name="Address" value="<?=$value["Address"]?>" ><br>
        </label>
        <br>
        <label for="Address2">Adresregel 2<br>
            <input type="text" name="Address2" value="<?=$value["Address2"]?>"><br>
        </label>
        <br>
        <label for="PostalCode">Postcode <br>
            <input type="text" name="PostalCode" value="<?=$value["PostalCode"]?>"  max="6"><br>
        </label>
        <label for="City">Plaats <br>
            <input type="text" name="City" value="<?=$value["City"]?>" ><br>
        </label>
        <br>
        <label for="PhoneNumber">Telefoonnummer <br>
            <input type="tel" name="PhoneNumber" value="+31<?=$value["PhoneNumber"]?>" ><br>
        </label>
        <br>
        <input type="submit" value="Sla gegevens op..." name="submit">
    </form>
    <?php
}
if(isset($_POST["submit"])){
    if(isset($_POST["Password"])){
        if (!empty($_POST) && CheckPwd($_POST["Password"], $_POST["password2"]) === true) {
            UpdateUserPWD($_POST);
            UpdateUser($_POST);
        } elseif (CheckPwd($_POST["Password"], $_POST["password2"])) {
            print CheckPwd($_POST["Password"], $_POST["password2"]);
        }
    }
    else {
        UpdateUser($_POST);
    }
}
?>