<?php
include "header.php";
include "accountfunctions.php";
if (!$_SESSION["email"]){
    header("location: login.php");
}

$email = $_SESSION["email"];
$information = GetInformation($email);

foreach ($information as $key => $value) {
    $customerid = $value["CustomerID"];
    $_SESSION["CustomerID"] = $customerid;
    ?>
        <div class="col-md-12">
            <form method="post" class="col-md-6 offset-md-3 col-xs-12">
                <h3>Hier kan je je gegevens aanpassen.</h3>
                <small class="text-danger">* Verplichte velden</small>
                <div class="form-group">
                    <label for="EmailAddress">Emailadres <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="EmailAddress" value="<?=$value["EmailAddress"]?>" required>
                </div>
                <div class="form-group">
                    <label for="Password">Wachtwoord</label>
                    <input type="password" class="form-control" name="Password" minlength="8">
                </div>
                <div class="form-group">
                    <label for="password2">Nogmaals uw wachtwoord</label>
                    <input type="password" class="form-control" name="password2" minlength="8">
                </div>
                <div class="form-group">
                    <label for="Name">Naam <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="Name" value="<?=$value["Name"]?>" required>
                </div>
                <div class="form-group">
                    <label for="Address">Straatnaam en huisnummer <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="Address" value="<?=$value["Address"]?>" required>
                </div>
                <div class="form-group">
                    <label for="Address2">Adresregel 2 </label>
                    <input type="text" class="form-control" name="Address2" value="<?=$value["Address2"]?>">
                </div>
                <div class="form-group">
                    <label for="PostalCode">Postcode <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="PostalCode" required max="6" value="<?=$value["PostalCode"]?>">
                </div>
                <div class="form-group">
                    <label for="City">Plaats <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="City" value="<?=$value["City"]?>" required>
                </div>
                <div class="form-group">
                    <label for="PhoneNumber">Telefoonnummer <span class="text-danger">*</span>
                        <input type="tel" class="form-control" name="PhoneNumber" value="<?=$value["PhoneNumber"]?>" required>
                </div>
                <input type="submit" class="btn btn-success" value="Ga door..." name="submit">
                <a href="account.php" class="btn btn-outline-info">Terug</a>
            </form>

        </div>

    <?php
}
if (isset($_POST["submit"])) {
    if ($_POST["Password"]) {
        if (CheckPwd($_POST["Password"], $_POST["password2"]) === true && CheckFormatPwd($_POST["Password"]) === true) {
            UpdateUserPWD($_POST, $customerid);
            UpdateUser($_POST, $customerid);
        } elseif (CheckPwd($_POST["Password"], $_POST["password2"])) {
            print CheckPwd($_POST["Password"], $_POST["password2"]);
        } elseif (CheckFormatPwd($_POST["Password"])) {
            print CheckFormatPwd($_POST["Password"]);
        }
    } else {
        UpdateUser($_POST, $customerid);
    }
}
?>