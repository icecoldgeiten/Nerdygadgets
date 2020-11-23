<?php
session_start();
include "orderfunctions.php";

if (empty($_SESSION["credentials"])) {
    header("location: /");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Betaalpagina</title>
</head>
<body>
<h1>Welkom op de betaalpagina<?php
    if (isset($_GET["bank"])){
        echo(" van de " . $_GET["bank"]);
    }
    if (isset($_GET["credit-bank"])){
        echo(" van de " . $_GET["credit-bank"]);
    }
    ?>!</h1>
    <br>
    Kies tussen de volgende 2 opties:<br>
    <br>
    <form method="post">
    <input type='submit' name='passed' value='Betaling gelukt!'>
    <input type='submit' name='failed' value='Betaling mislukt!'>
    </form>
</body>
</html>
<?php

if (isset($_POST['passed'])) {
    Order($_SESSION["credentials"], $_SESSION['cart']);
    include __DIR__ . "/mailer.php";
}
?>