<?php
include "header.php";
if ($_SESSION["inlog"] === false){
    header("location: login.php");
}

?>
<div class="col-md-12 mt-5">
    <h5>Hi <?= $_SESSION['email'] ?>, Waarmee kunnen we je helpen?</h5>
    <a href="browse.php" class="btn btn-success mb-2">Winkelen</a>
    <form method="post" class="mb-2">
        <input type="submit" name="change" value="Verander je gegevens" class="btn btn-dark">
    </form>
    <form method="post">
        <input type="submit" name="logout" value="Uitloggen" class="btn btn-dark">
    </form>
</div>
<?php
If (isset($_POST["change"])){
    header("location: customerpage.php");
}
If (isset($_POST["logout"])){
    unset($_SESSION["inlog"]);
    unset($_SESSION['email']);
    header("location: login.php");
}
include "footer.php"
?>