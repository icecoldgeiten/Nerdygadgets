<?php
include "delivery-form.php";
?>
<form method="get" action="checkout-form.php">
    <input type="hidden" name="postal" value="0">
    <input type="checkbox" name="postal" value="1">Bezorgadres is niet hetzelfde als factuuradres<br>
</form>
<?php
if(isset($_GET["postal"])){
    if($_GET["postal"] === 1) {
        include "postal-form.php";
    }
}