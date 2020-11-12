<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Betaalpagina</title>
</head>
<body>
<?php
if (isset($_GET["bank"])){
    echo("<h1>Welkom op de betaalpagina van de " . $_GET["bank"] . "!</h1>");
    echo("<br>");
    echo("Kies tussen de volgende 2 opties:<br>");
    echo("<form action='transactie.php'>");
        echo("<input type='submit' name='betaling' value='Betaling gelukt!'>");
        echo("<input type='submit' name='betaling' value='Betaling mislukt!'>");
    echo("</form>");
}
if (isset($_GET["credit-bank"])){
    echo("<h1>Welkom op de betaalpagina van de " . $_GET["credit-bank"] . "!</h1>");
    echo("<br>");
    echo("Kies tussen de volgende 2 opties:<br>");
    echo("<form action='transactie.php'>");
    echo("<input type='submit' name='betaling' value='Betaling gelukt!'>");
    echo("<input type='submit' name='betaling' value='Betaling mislukt!'>");
    echo("</form>");
}
else{
    echo("<h1>Welkom op de betaalpagina!</h1>");
    echo("<br>");
    echo("Kies tussen de volgende 2 opties:<br>");
    echo("<form action='transactie.php'>");
    echo("<input type='submit' name='betaling' value='Ik heb betaald'>");
    echo("<input type='submit' name='betaling' value='Ik heb niet betaald'>");
    echo("</form>");
}
?>
</body>
</html>