<?php
session_start();
include __DIR__ ."/header.php";
include __DIR__ ."/cartfunctions.php";
include __DIR__ ."/connect.php";

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
//print_r($cart)

?>
<table>
    <tr>
        <th>Naam</th>
        <th>Aantal</th>
        <th>enkele prijs</th>
        <th>totaal prijs</th>
    </tr>

<?php

$products = GetProducts($cart);
foreach ($products as $key => $slot){
    $item = $slot["stockitemid"];
    $prijs = sprintf("%.2f", $slot["SellPrice"]);
    $totaalprijs = $prijs * $cart[$item];
    ?>
<tr>
    <td> <?= $slot["stockitemname"]?></td>
    <td> <?= $cart[$item]?></td>
    <td> <?= $prijs?></td>
    <td> <?= $totaalprijs?></td>
    </tr>
<?php
}
?>
</table>
<!--<form action="payment.php" >-->
<!--    <input type="submit" name="doorgaan" value="Doorgaan naar betalen">-->
</form>

<?php
include __DIR__ ."/footer.php"
?>

