<?php
session_start();
include __DIR__ ."/header.php";
include __DIR__ ."/cartfunctions.php";
include __DIR__ ."/connect.php";
$cart = $_SESSION["cart"];

If(isset($_POST["More"])){
    AddMore($cart);
}

If(isset($_POST["Less"])){
    Remove($cart);
}
if(isset($_POST["Delete"])) {
    Delete($cart);
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
    if ($cart[$item] >0){
    ?>
<tr>
    <td> <?= $slot["stockitemname"]?></td>

    <td> <?= $cart[$item]?></td>
    <td> <?= $prijs?></td>
    <td> <?= $totaalprijs?></td>
    <td>
        <form method="post">
            <input type="submit" name="More" value="Meer kopen">
            <input type="hidden" name="more" value="<?=$item?>">
        </form>
    </td>
    <td>
        <form method="post">
            <input type="submit" name="Less" value="Minder kopen">
            <input type="hidden" name="less" value="<?=$item?>">
        </form>
    </td>
    <td>
        <form method="post">
            <input type="submit" name="Delete" value="Verwijderen">
            <input type="hidden" name="delete" value="<?=$item?>">
        </form>
    </td>

</tr>
<?php
    }
}
?>
</table>
<?php
include __DIR__ ."/footer.php"
?>

