<form method="get" action="address-form.php">
    Vul hier het bezorgadres in:<br>
    <br>
    <label for="delivery-name">Naam *</label><br>
    <input type="text" name="delivery-name" required><br>
    <label for="delivery-address1">Straatnaam en huisnummer *</label><br>
    <input type="text" name="delivery-address1" required><br>
    <label for="delivery-address2">Extra adresregel</label><br>
    <input type="text" name="delivery-address2"><br>
    <label for="delivery-postalcode" style="margin-right: 4px">Postcode *</label><label for="delivery-city">Plaats *</label><br>
    <input type="text" name="delivery-postalcode" required maxlength="6" size="4" style="margin-right: 8px"><input type="text" name="delivery-city" required><br>
    <label for="delivery-phone">Telefoonnummer *</label><br>
    +31<input type="text" name="delivery-phone" required maxlength="10" size="17"><br>
</form>