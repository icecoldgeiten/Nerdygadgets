<?php
if ($_GET["betaling"] === "Betaling gelukt!" || $_GET["betaling"] === "Ik heb betaald") {
    include "connect.php";

    echo ("<h1>De betaling is gelukt!</h1><br>");
    echo ("U krijgt nu een orderbevestiging en een factuur via de mail.<br>");
    echo ("<br>");
    echo ("<a href='index.php'>Ga hier terug naar de homepage...</a>");
}
if ($_GET["betaling"] === "Betaling mislukt!" || $_GET["betaling"] === "Ik heb niet betaald") {
    echo ("<h1>De betaling is niet gelukt!</h1><br>");
    echo ("Je kan nog op de terugknop drukken om de betaling alsnog te voltooien.");
    echo ("<br>");
    echo ("<a href='index.php'>Ga hier terug naar de homepage...</a>");
}