<?php
include "delivery-form.php";
?>
<form method="get" action="<?php print(htmlspecialchars($_SERVER["PHP_SELF"]));?>">
    <input type="checkbox" name="postal">Bezorgadres is niet hetzelfde als factuuradres<br>
    <br>
    <input type="submit" value="Ga door...">
</form>
<?php
if(isset($_GET["postal"])){
    if($_GET["postal"]){
        echo("Vul hier het factuuradres in:<br><br>");
        include "postal-form.php";
    }
}
