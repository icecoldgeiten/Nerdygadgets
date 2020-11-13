<?php
include "connect.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Betalen</title>
</head>
<body>
Selecteer uw betaalmethode: <br>
<form method="get" action="betaal.php">
    <?php
    $query = "SELECT PaymentMethodID, PaymentMethodName FROM paymentmethods";
    $statement = mysqli_prepare($Connection, $query);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $paymentmethods = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($paymentmethods as $method) {
    ?>
    <input type="radio" name="betaal" value="<?= $method["PaymentMethodName"] ?>"<?=  isset($_GET["betaal"]) && $_GET["betaal"] === $method["PaymentMethodName"] ? 'checked' : '' ?>>
        <label for="<?= $method["PaymentMethodName"] ?>"><?= $method["PaymentMethodName"] ?></label>
    <?php
}
?>
    <input type="submit" name="submit" value="Ga door...">
    <br>
    <br>
</form>
<?php
include "betaalacties.php";
?>
</body>
</html>