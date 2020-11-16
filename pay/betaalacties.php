<?php
if (isset($_GET["submit"])) {
    if (isset($_GET["betaal"])) {
        if ($_GET["betaal"] === "iDEAL") {
            include "payment-providers/ideal.php";
        }
        if ($_GET["betaal"] === "Credit-Card") {
            include "payment-providers/creditcard.php";
        }
        if ($_GET["betaal"] === "Cash") {
            include "payment-providers/cash.php";
        }
        if ($_GET["betaal"] === "Check") {
            include "payment-providers/check.php";
        }
        if ($_GET["betaal"] === "EFT") {
            include "payment-providers/EFT.php";
        }
    }
    else{
        echo("U heeft nog geen keuze gemaakt.<br>");
        echo("Maak alsnog een keuze en klik opnieuw op 'Ga door...'<br>");
    }
}