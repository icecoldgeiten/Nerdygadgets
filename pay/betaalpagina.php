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
    <form action='../transactie.php'>
    <input type='submit' name='betaling' value='Betaling gelukt!'>
    <input type='submit' name='betaling' value='Betaling mislukt!'>
    </form>
</body>
</html>