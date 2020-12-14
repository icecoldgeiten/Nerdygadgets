<?php
//include "accountfunctions.php";

$information = GetInformation($_SESSION["email"]);

foreach ($information as $key => $value) {

    $customerid = $value["CustomerID"];

    ?>
    <label for="postal-name">Naam <span class="text-danger" >*</span></label><br>
    <input type="text" name="postal-name" class="resizedTextbox" value="<?=$value["Name"]?>"required><br>
    <label for="postal-EmailAddress">E-mailadres <span class="text-danger">*</span></label><br>
    <input type="text" name="postal-EmailAddress" value="<?=$value["EmailAddress"]?>" required><br>
    <label for="postal-address1">Straatnaam en huisnummer <span class="text-danger">*</span></label><br>
    <input type="text" name="postal-address1" value="<?=$value["Address"]?>" required><br>
    <label for="postal-address2">Extra adresregel</label><br>
    <input type="text" name="postal-address2" value="<?=$value["Address2"]?>"><br>
    <label for="postal-postalcode" style="margin-right: 4px">Postcode <span class="text-danger">*</span></label>
    <input type="text" class="mb-1" name="postal-postalcode" value="<?=$value["PostalCode"]?>"  maxlength="6" size="4" style="margin-right: 8px" required>
    <label for="postal-city">Woonplaats <span class="text-danger">*</span></label><br>
    <input type="text" name="postal-city" value="<?=$value["City"]?>" required class="resizedTextbox"><br>
    <label for="postal-phone">Telefoonnummer <span class="text-danger">*</span></label><br>
    <input type="tel" name="postal-phone" value="<?=$value["PhoneNumber"]?>" required maxlength="12"><br>

    <?php
}
?>