<form method="get" action="address-form.php">
    <label for="postal-name">Naam *</label><br>
    <input type="text" name="postal-name" required><br>
    <label for="postal-address1">Straatnaam en huisnummer *</label><br>
    <input type="text" name="postal-address1" required><br>
    <label for="postal-address2">Extra adresregel</label><br>
    <input type="text" name="postal-address2"><br>
    <label for="postal-postalcode">Postcode *</label>&nbsp;&nbsp;&nbsp;&nbsp;<label for="postal-city">Plaats *</label><br>
    <input type="text" name="postal-postalcode" required maxlength="6" size="4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="postal-city" required><br>
    <label for="postal-phone">Telefoonnummer *</label><br>
    +31<input type="text" name="postal-phone" required maxlength="10" size="17"><br>
</form>