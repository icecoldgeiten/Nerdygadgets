<?php
include "header.php";
include "accountfunctions.php";
//if (!$_SESSION["email"]){
//    header("location: login.php");
//}
$email = $_SESSION["email"];
$information = GetInformation($email);

foreach ($information as $key => $value) {
    
    $customerid = $value["CustomerID"]
    ?>
    <form method="post">
        <h1>Hier kan je je gegevens aanpassen, mocht dat nodig zijn.</h1>
        <label for="EmailAddress">Emailadres <br>
            <input type="text" name="EmailAddress" value="<?=$value["EmailAddress"]?>" ><br>
        </label>
        <br>
        <label for="Password">Wachtwoord <br>
            <input type="password" name="Password" minlength="8" ><br>
        </label>
        <label for="password2">Nogmaals uw wachtwoord <br>
            <input type="password" name="password2" minlength="8" ><br>
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
            +31<input type="tel" name="PhoneNumber" value="<?=$value["PhoneNumber"]?>" ><br>
        </label>
        <br>
        <input type="submit" value="Sla gegevens op..." name="submit">
        Als u uw gegevens veranderd, wordt u teruggestuurd naar de inlogpagina om opnieuw in te loggen.
    </form>
    <?php
}
if(isset($_POST["submit"])){
    if($_POST["Password"]){
        if (CheckPwd($_POST["Password"], $_POST["password2"]) === true && CheckFormatPwd($_POST["Password"]) === true) {
            UpdateUserPWD($_POST, $customerid);
            UpdateUser($_POST,$customerid);
        } elseif (CheckPwd($_POST["Password"], $_POST["password2"])) {
            print CheckPwd($_POST["Password"], $_POST["password2"]);
        } elseif (CheckFormatPwd($_POST["Password"])){
            print CheckFormatPwd($_POST["Password"]);
        }
    }
    else {
        UpdateUser($_POST,$customerid);
    }
}
?>