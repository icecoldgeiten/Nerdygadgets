<?php
session_start();
include __DIR__ ."/header.php";
include __DIR__ . "/cartfunctions.php";
include __DIR__ ."/connect.php";

if (isset($_GET["id"])) {
    $stockItemID = $_GET["id"];
} else {
    $stockItemID = 0;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

</head>
<body>


</body>
</html>

<?php
$cart = $_SESSION["cart"];

?>
<table>
    <tr>
        <th>Aantal</th>
        <th>Item</th>
        <th>totaal prijs</th>
    </tr>

<?php
viewcart($cart);

?>
</table>
<form method="post" action="cart.php">
    <input type="hidden" name="stockItemID" value="<?php print($stockItemID) ?>">
    <input type="submit" class="button" name="remove" value="Leeg winkelmandje">
</form>
<form method="post" action="cart.php">
    <input type="hidden" name="stockItemID" value="<?php print($stockItemID) ?>">
    <input type="submit" class="button" name="minder" value="1 Item verwijderen">
</form>
<form method="post" action="cart.php">
    <input type="hidden" name="stockItemID" value="<?php print($stockItemID) ?>">
    <input type="submit" class="button" name="meer" value="1 Item toevoegen">
</form>
<form action="payment.php" >
    <input type="submit" class="button" name="doorgaan" value="Door gaan naar betalen">
</form>

<?php

if (isset($_POST["remove"])){
    DeleteCart($stockItemID);
}

if (isset($_POST["meer"])){
    RaiseProduct($stockItemID);
}

if (isset($_POST["minder"])){
    LowerProduct($stockItemID);
}





include __DIR__ ."/footer.php"
?>

