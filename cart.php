<?php
include __DIR__ . "/header.php";
include "cartfunctions.php";
$cart = $_SESSION["cart"];

if (isset($_POST["AddOne"])) {
    AddOne($cart);
}
if (isset($_POST["RemoveOne"])) {
    RemoveOne($cart);
}
if (isset($_POST["DeleteRow"])) {
    DeleteRow($cart);
}
if (isset($_POST["DeleteCart"])) {
    DeleteCart($cart);
}

$cart = $_SESSION["cart"];
?>
<table class="col-md-8">
    <tr>
        <th>Naam</th>
        <th>Aantal</th>
        <th>enkele prijs</th>
        <th>totaal prijs</th>
    </tr>

    <?php
    $products = GetProducts($cart);
    foreach ($products as $key => $slot) {

        $item = $slot["stockitemid"];
        $prijs = sprintf("%.2f", $slot["SellPrice"]);
        $totaalprijs = $prijs * $cart[$item];
        if ($cart[$item] > 0) {
            ?>
            <tr>
                <td> <?= $slot["stockitemname"] ?></td>
                <td> <?= $cart[$item] ?></td>
                <td> <?= $prijs ?></td>
                <td> <?= $totaalprijs ?></td>
                <td>
                    <form method="post">
                        <input type="submit" class="button small-btn" name="AddOne" value="+">
                        <input type="hidden" name="addOne" value="<?= $item ?>">
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="submit" class="button small-btn" name="RemoveOne" value="-">
                        <input type="hidden" name="removeOne" value="<?= $item ?>">
                    </form>
                </td>
                <td>
                    <form method="post">
                        <input type="submit" class="button big-btn" name="DeleteRow" value="Verwijderen">
                        <input type="hidden" name="deleteRow" value="<?= $item ?>">
                    </form>
                </td>
            </tr>

            <?php
        }
    }
    ?>
</table>
<div class="col-md-2 offset-6">
    <form method="post">
        <input type="submit" class="button" name="DeleteCart" value="Winkelmand legen">
    </form>
    <form method="post" action="index.php">
        <input type="submit" class="button " value="Doorgaan met winkelen">
    </form>
</div>
<?php
include __DIR__ . "/footer.php"
?>

