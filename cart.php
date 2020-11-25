<?php
include "connect.php";

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
                <td><a href="view.php?id=<?=$slot['stockitemid']?>" style="color: white" </a> <?= $slot["stockitemname"] ?></td>
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
                        <span class="icon-input-btn">
<!--                      <i class="fas fa-shopping-cart mr-2" style="color:#676EFF;"> </i>   <a href="payment.php" class="HrefDecoration mr-3"><i class="fas fa-shopping-cart mr-2" style="color:#676EFF;"></i>Winkelmand</a>-->
                            <i class="fas fa-shopping-cart mr-2" style="color:#676EFF;"> </i>
                            <input type="submit" class="button" name="DeleteRow" >
                        </span>
                        <input type="hidden" name="deleteRow" value="<?= $item ?>">
                    </form>
                </td>
            </tr>

            <?php
        }
    }
    ?>
</table>
<font size="+3" style="color:navajowhite;">
<p>Totaalprijs: € <?= $totalcart ?></p>
</font>
<div class="col-md-4 offset-8 mt-5">
    <form method="post">
        <input type="submit" class="button" name="DeleteCart" value="Winkelmand legen">
    </form>
    <form method="post" action="index.php">
        <input type="submit" class="button " value="Doorgaan met winkelen">
    </form>
</div>