<?php
include "accountfunctions.php";

$information = GetInformation($_SESSION["email"]);

foreach ($information as $key => $value) {

    $customerid = $value["CustomerID"]
    ?>
    <form method="post">
        <label for="EmailAddress">Emailadres <br>
            <input type="text" name="EmailAddress" value="<?=$value["EmailAddress"]?>" ><br>
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
            <input type="tel" name="PhoneNumber" value="<?=$value["PhoneNumber"]?>" ><br>
        </label>
        <br>
    </form>
    <?php
}
?>