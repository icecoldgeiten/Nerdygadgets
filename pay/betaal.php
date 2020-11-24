<p>Selecteer uw betaalmethode:</p>
<?php
$query = "SELECT PaymentMethodID, PaymentMethodName FROM paymentmethods";
$statement = mysqli_prepare($Connection, $query);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);
$paymentmethods = mysqli_fetch_all($result, MYSQLI_ASSOC);

foreach ($paymentmethods as $method) {
    ?>
    <input type="radio" name="betaal"
           value="<?= $method["PaymentMethodID"] ?>"<?= isset($_GET["betaal"]) && $_GET["betaal"] === $method["PaymentMethodName"] ? 'checked' : '' ?>>
    <label for="<?= $method["PaymentMethodName"] ?>"><?= $method["PaymentMethodName"] ?></label>
    <br>
    <?php
}
?>
<?php
include "betaalacties.php"
?>
