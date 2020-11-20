<?php
include "cartfunctions.php";

$cart = GetCart();
$Query = " 
           SELECT QuantityOnHand  
            FROM StockItemHoldings  
            WHERE stockitemid = ?";

$statement = mysqli_prepare($Connection, $Query);
mysqli_stmt_bind_param($statement, 'i', $id);
mysqli_stmt_execute($statement);
$result = mysqli_stmt_get_result($statement);

$Okay = mysqli_fetch_assoc($result);

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
    DeleteCart();
}

?>
<table>
    <tr>
        <th>Product</th>
        <th>Aantal</th>
        <th>Prijs 1x</th>
        <th>Prijs totaal</th>
    </tr>

    <?php
    $cart = GetCart();
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
                    <?php

                    if(!CheckStock($item , $cart[$item])){ ?>
                        <form method="post">
                            <input type="submit" class="button small-btn" name="AddOne" value="+">
                            <input type="hidden" name="addOne" value="<?= $item ?>">
                        </form>
                    <?php
                    }
                        ?>
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