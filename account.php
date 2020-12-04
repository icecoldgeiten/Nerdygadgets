<?php
include "header.php";
if ($_SESSION["inlog"] === false){
    header("location: login.php");
}
?>

<form method="post">
    <input type="submit" name="change" value="Verander je gegevens" class="button">
</form>
<form method="post">
    <input type="submit" name="logout" value="Uitloggen" class="button">
</form>



<?php
If (isset($_POST["change"])){
    header("location: customerpage.php");
}
If (isset($_POST["logout"])){
    $_SESSION["inlog"] = false;
    header("location: login.php");
}
include "footer.php"
?>