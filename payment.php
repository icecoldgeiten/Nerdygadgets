<?php
session_start();
include __DIR__ . "/header.php";
include __DIR__ . "/orderfunctions.php";
?>
<div class="payment mb-5">
    <form method="post">
        <div class="row mt-2">
            <div class="col-md-6">
                <div class="row ml-3">
                    <h3>Gegevens</h3>
                    <div class="col-md-12">
                        <?php include "check-out/postal-form.php"; ?>
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
                <input type="submit" class="button big-btn col-md-3 offset-9 mr-3" name="submit" value="Ga door">
            </div>
        </div>
    </form>
</div>
<?php
if (isset($_POST["submit"]) && !empty($_SESSION['cart'])) {
    Order($_POST, $_SESSION['cart']);
}
include __DIR__ . "/footer.php";
?>

