<?php
include "../connect.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <?php
        include __DIR__ . "/../header.php";
        if ($_GET["betaling"] === "Betaling gelukt!") {
            echo ("<h1>De betaling is gelukt!</h1><br>");
            echo ("U krijgt nu een orderbevestiging en een factuur via de mail.<br>");
        }
        if ($_GET["betaling"] === "Betaling mislukt!") {
            echo ("<h1>De betaling is niet gelukt!</h1><br>");
            echo ("Je kan nog op de terugknop drukken om de betaling alsnog te voltooien.");
        }
        ?>
        <br>
        <a href='index.php'>Ga hier terug naar de homepage...</a>
    </body>
</html>