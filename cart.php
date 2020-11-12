<?php
session_start();
include __DIR__ ."/header.php";
include __DIR__ ."/cartfunctions.php";
include __DIR__ ."/connect.php.php";
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
<form action="payment.php" >
    <input type="submit" name="doorgaan" value="Door gaan naar betalen">
</form>

<?php




include __DIR__ ."/footer.php"
?>

