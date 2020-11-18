<?php
include "cartfunctions.php";
$cart = GetCart();

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

?>
<table class="col-md-12 ">
    <tr>
        <th>Product</th>
        <th>Aantal</th>
        <th>Prijs 1x</th>
        <th>Prijs totaal</th>
    </tr>

    <?php
    $products = GetProducts($cart);
    $totalcart = 0;
    foreach ($products as $key => $slot) {

        $item = $slot["stockitemid"];
        $prijs = sprintf("%.2f", $slot["SellPrice"]);
        $totaalprijs = $prijs * $cart[$item];
        $totalcart = $totalcart + $totaalprijs;
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
<p>Totaalprijs: € <?= $totalcart ?></p>
<div class="col-md-4 offset-8 mt-5">
    <form method="post">
        <input type="submit" class="button" name="DeleteCart" value="Winkelmand legen">
    </form>
    <form method="post" action="index.php">
        <input type="submit" class="button " value="Doorgaan met winkelen">
    </form>
</div>