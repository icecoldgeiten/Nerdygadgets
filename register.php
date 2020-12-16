<?php
include "header.php";
include "accountfunctions.php";
if ($_SESSION["inlog"]) {
    header("location: account.php");
}
?>
    <div class="row">
        <div class="col-md-8 col-xs-12">
            <form method="post" class="col-md-10">
                <h3 class="mb-0">Registreren</h3>
                <small class="text-danger">* Verplichte velden</small>
                <div class="form-group">
                    <label for="EmailAddress">E-mailadres <span class="text-danger">*</span></label>
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
                        <input type="tel" class="form-control" name="PhoneNumber" placeholder="+31" required>
                </div>
                <input type="submit" class="btn btn-success" value="Ga door..." name="submit">
                <a href="login.php" class="btn btn-outline-info">Ik heb al een account</a>
            </form>
        </div>
        <div class="col-md-4 col-xs-12 mt-5 mt-md-0">
            <h3>Wachtwoord regels</h3>

            <div class="psw-rules">
                <p>Er moet een cijfer in het wachtwoord</p>
                <hr class="wide-line">
                <p>Er moet een hoofdletter in het wachtwoord</p>
                <hr class="wide-line">
                <p>Er moet een kleine letter in het wachtwoord</p>
                <hr class="wide-line">
                <p>Er moet een speciaal karakter in het wachtwoord</p>
                <hr class="wide-line">
                <p>Er mogen geen spaties in het wacthwoord</p>
                <hr class="wide-line">

            </div>
        </div>
    </div>

<?php
if (isset($_POST["submit"])) {
    if (!CheckUsername($_POST["EmailAddress"])) {
        if (!empty($_POST) && CheckPwd($_POST["Password"], $_POST["password2"]) === true && CheckFormatPwd($_POST["Password"]) === true) {
            InsertUser($_POST);
            echo("Uw account is aangemaakt, u wordt nu doorgestuurd naar de inlogpagina!");
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