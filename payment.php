<?php
include __DIR__ . "/header.php";
include __DIR__ . "/orderfunctions.php";
?>
<div class="payment mb-5">
    <div class="row mt-2">
        <div class="col-md-6 col-xs-12">
            <form method="post" name="pay" id="pay">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Gegevens</h3>
                        <small class="text-danger">Alles met een * is verplicht</small>
                    </div>
                    <div class="col-md-12"
                         
                    <?php
                         If($_SESSION["inlog"]) {
                            include "CartAccount.php";
                        } else {
                           include "check-out/postal-form.php";
                         ?>
                </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-12">
                <h3>Bezorging</h3>
                <?php include "check-out/delivery.php"; ?>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h3>Betaling</h3>
                <?php include "pay/betaal.php"; ?>
            </div>
        </div>
        </form>
    </div>
    <div class="col-md-6 col-xs-12 mt-md-5">
        <button class="btn btn-dark d-md-none mb-3" data-toggle="collapse" data-target="#PaymentCart"><i
                    class="fas fa-shopping-cart mr-2"></i>Winkelmand bekijken
        </button>
        <div class="PaymentCart collapse d-sm-block" id="PaymentCart">
            <div class="col-md-12">
                <p class="font-weight-bold d-none d-sm-block">Winkelmand</p>
                <table class="table table-dark table-responsive">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Aantal</th>
                        <th>Prijs</th>
                        <th>Totaal</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cart = GetCart();
                    $products = GetProducts($cart);
                    SendCost(220);
                    $totalcart = 0;
                    foreach ($products as $key => $slot) {
                        $item = $slot["stockitemid"];
                        $prijs = sprintf("%.2f", $slot["SellPrice"]);
                        $totaalprijs = $prijs * $cart[$item];
                        $totalcart = $totalcart + $totaalprijs;
                        if ($cart[$item] > 0) {
                            ?>
                            <tr>
                                <td><?= $slot['stockitemname'] ?></td>
                                <td><?= $cart[$item] ?></td>
                                <td><?= $prijs ?></td>
                                <td><?= $totaalprijs ?></td>
                            </tr>
                        <?php }
                    } ?>
                    <tr>
                        <td>Totaal:</td>
                        <td><?= $totalcart ?></td>
                        <td>Euro</td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <!--        <div class="col-md-6 col-xs-12">-->
    <!--            <div class="row">-->
    <!--                <div class="col-md-12 pr-5">-->
    <!--                    --><?php //Advertisement(); ?>
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
</div>
<div class="row">
    <div class="col-md-12">
        <input type="submit" class="btn btn-success" name="submit" value="Door naar betalen" form="pay">
    </div>
</div>
</div>
<?php

if (isset($_POST["submit"]) && !empty($_SESSION['cart'])) {
    $_SESSION["credentials"] = $_POST;
    header("location: betaalpagina.php");
}
include __DIR__ . "/footer.php";
?>

