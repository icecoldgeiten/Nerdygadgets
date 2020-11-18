<?php
include __DIR__ . "/header.php";
?>
<div class="payment">
    <div class="row mt-2">
        <div class="col-md-6">
            <div class="row ml-3">
                <h3>Gegevens</h3>
            </div>
            <div class="row ml-3">
                <h3>Bezorging</h3>
            </div>
            <div class="row ml-3">
                <h3>Betaling</h3>
            </div>

        </div>
        <div class="col-md-6">
            <h3>Winkelmand</h3>
            <?php include "cart.php"; ?>
        </div>
    </div>
</div>
<?php
include __DIR__ . "/footer.php";
?>

