<?php
include "header.php";
include "accountfunctions.php";
if ($_SESSION["inlog"]) {
    header("location: account.php");
}
?>
    <div class="col-md-12">
        <form method="post" class="col-md-6 offset-md-3 col-xs-12">
            <h3 class="mb-0">Regristreren</h3>
            <small class="text-danger">* Verplichte velden</small>
            <div class="form-group">
                <label for="EmailAddress">Emailadres <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="EmailAddress" required>
            </div>
            <div class="form-group">
                <label for="Password">Wachtwoord <span class="text-danger">*</span></label>
                    <input type="password" class="form-control" name="Password" minlength="8" required>
            </div>
            <div class="form-group">
                <label for="password2">Nogmaals uw wachtwoord <span class="text-danger">*</span></label>
                <input type="password" class="form-control" name="password2" minlength="8" required>
            </div>
            <div class="form-group">
                <label for="Name">Naam <span class="text-danger">*</span>
                    <input type="text" class="form-control" name="Name" required> </label>
            </div>
            <div class="form-group">
                <label for="Address">Straatnaam en huisnummer <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="Address" required>
            </div>
            <div class="form-group">
                <label for="Address2">Adresregel 2 </label>
                <input type="text" class="form-control" name="Address2">
            </div>
            <div class="form-group">
                <label for="PostalCode">Postcode <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="PostalCode" required max="6">
                <label for="City">Plaats <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="City" required>
            </div>
            <div class="form-group">
                <label for="PhoneNumber">Telefoonnummer <span class="text-danger">*</span>
                    <input type="tel" class="form-control" name="PhoneNumber" value="+31" required>
            </div>
            <input type="submit" class="btn btn-success" value="Ga door..." name="submit">
        </form>

    </div>

<?php
if (isset($_POST["submit"])) {
    if (!CheckUsername($_POST["EmailAddress"])) {
        if (!empty($_POST) && CheckPwd($_POST["Password"], $_POST["password2"]) === true && CheckFormatPwd($_POST["Password"]) === true) {
            InsertUser($_POST);
            echo("Uw account is aangemaakt, u wordt nu doorgestuurd naar de inlogpagina!");
            include __DIR__ . "/mailer-account.php";
            header("location: login.php");
        } elseif (CheckPwd($_POST["Password"], $_POST["password2"])) {
            print CheckPwd($_POST["Password"], $_POST["password2"]);
        } elseif (CheckFormatPwd($_POST["Password"])) {
            print CheckFormatPwd($_POST["Password"]);
        } else {
            echo("Er is een fout opgetreden, probeer het later nog een keer...");
        }
    } else {
        print "gebruikersnaam al in gebruik";
    }
}


include "footer.php";