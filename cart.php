<?php
include __DIR__ . "/header.php";
include __DIR__ . "/orderfunctions.php";

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
<div class="cart col-md-12">
    <div class="row">
        <div class="table-responsive mt-5">
            <table class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Totaal</th>
                </tr>

                <?php
                $cart = GetCart();
                $products = GetProducts($cart);
                SendCost(220);
                $totalcart = 0;
                foreach ($products as $key => $slot) {
                    $item = $slot["stockitemid"];
                    SendCost($item);
                    $prijs = sprintf("%.2f", $slot["SellPrice"]);
                    $totaalprijs = $prijs * $cart[$item];
                    $totalcart = $totalcart + $totaalprijs;
                    if ($cart[$item] > 0) {
                        ?>
                        <tr>
                            <td><a href="view.php?id=<?= $slot['stockitemid'] ?>"
                                   style="color: white" </a> <?= $slot["stockitemname"] ?></td>
                            <td> <?= $cart[$item] ?></td>
                            <td> <?= $prijs ?></td>
                            <td> <?= $totaalprijs ?></td>
                            <td>
                                <?php

                                if (!CheckStock($item, $cart[$item])) { ?>
                                    <form method="post">
                                        <button name="AddOne" class="btn btn-success"><i class="fas fa-plus"></i>
                                        </button>
                                        <input type="hidden" name="addOne" value="<?= $item ?>">
                                    </form>
                                    <?php
                                }
                                ?>
                            </td>
                            <td>
                                <form method="post">
                                    <button name="RemoveOne" class="btn btn-danger"><i class="fas fa-minus"></i>
                                    </button>
                                    <input type="hidden" name="removeOne" value="<?= $item ?>">
                                </form>
                            </td>
                            <td>
                                <form method="post">
                                    <button name="DeleteRow" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                                    </button>
                                    <input type="hidden" name="deleteRow" value="<?= $item ?>">
                                </form>
                            </td>
                        </tr>

                        <?php


                    }
                }
                ?>
            </table>
        </div>
    </div>
    <div class="row mb-3 mt-3">
        <div class="col-md-12">
            <?php
            if ($totalcart < 50 && $totalcart > 1) {
                ?>
                <p class="m-0 text-info"> Verzend kosten: 6.95 </p>
                <?php
            }
            ?>
            <h3>Totaalprijs: € <?= SendCost($totalcart) ?></h3>

        </div>
    </div>
    <div class="row">
        <form method="post" action="index.php">
            <input type="submit" class="btn btn-info mr-1 mb-2" value="Doorgaan met winkelen">
        </form>
        <form method="post">
            <input type="submit" class="btn btn-outline-danger" name="DeleteCart" value="Winkelmand legen">
        </form>
    </div>
    <div class="row mt-3">
        <a href="payment.php" class="btn btn-success">Naar afrekenen</a>
    </div>
</div>

