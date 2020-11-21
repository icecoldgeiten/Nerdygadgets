<?php
session_start();
include "orderfunctions.php"
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
    <form method="get" action='betaalpagina.php'>
    <input type='submit' name='passed' value='Betaling gelukt!'>
    <input type='submit' name='failed' value='Betaling mislukt!'>
    </form>
</body>
</html>
<!--../transactie.php-->
<?php
$credentials = $_SESSION["credentials"];

if (isset($_GET['passed'])) {
    var_dump($credentials);
    Order($credentials, $_SESSION['cart']);
    var_dump("test");
}
?>