<?php
include "../connect.php";
?>
Selecteer uw bezorgmethode: <br>
<form method="get" action="delivery.php">
<select id="deliveryoptions" name="deliveryoptions">
    <?php
    $query = "SELECT DeliveryMethodID, DeliveryMethodName FROM deliverymethods";
    $statement = mysqli_prepare($Connection, $query);
    mysqli_stmt_execute($statement);
    $result = mysqli_stmt_get_result($statement);
    $paymentmethods = mysqli_fetch_all($result, MYSQLI_ASSOC);

    foreach ($paymentmethods as $method) {
    ?>
    <option value="<?= $method["DeliveryMethodName"] ?>"><?= $method["DeliveryMethodName"] ?>
    <?php
}
?>
</select>
</form>