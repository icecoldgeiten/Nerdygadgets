<?php
include __DIR__ . "/header.php";
include __DIR__ . "/orderfunctions.php";
?>
<div class="payment mb-5">
    <div class="row mt-2">
        <div class="col-md-6">
            <form method="post" name="pay" id="pay">
                <div class="row ml-3">
                    <h3>Gegevens</h3><br>
                    <font size="4">
                        <strong><br>Alles met een * is verplicht</strong>
                    </font>
                    <div class ="col-md-12"
                        <?php
                        If($_SESSION["inlog"]) {
                            include "CartAccount.php";
                        } else {
//                        if statement maken met of er ingelogd is en dan het adres daarvandaan halen ipv een een de form met else de form.
//                        if ingelogged = true{
//                            function GetAddress
                            //  radio knop met factuur adres anders dan huidig adres
                            //  if isset(radioknop) {
                            //include "check-out/postal-form.php";
                            //}else{include "check-out/postal-form.php"; }
                            include "check-out/postal-form.php";
                        }?>

                    </div>
                </div>
                <div class="row ml-3">
                    <h3>Bezorging</h3>
                    <div class="col-md-12">
                        <?php include "check-out/delivery.php"; ?>
                    </div>
                </div>
                <div class="row ml-3">
                    <h3>Betaling</h3>
                    <div class="col-md-12">
                        <?php include "pay/betaal.php"; ?>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-6">
            <h3>Winkelmand</h3>
            <div class="col-md-12">
                <?php include "cart.php"; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <input type="submit" class="buttong big-btn col-md-3 offset-9 mr-3" name="submit" value="Door naar betalen" form="pay">
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

