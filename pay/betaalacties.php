<?php
if (isset($_GET["submit"])) {
    if (isset($_GET["betaal"])) {
        switch ($_GET["betaal"]){
            case "iDEAL":
                include "payment-providers/ideal.php";
                break;
            case "Credit-Card":
                include "payment-providers/creditcard.php";
                break;
            case "Cash":
                include "payment-providers/cash.php";
                break;
            case "Check":
                include "payment-providers/check.php";
                break;
            case "EFT":
                include "payment-providers/EFT.php";
                break;
        }
    }
    else{
        echo("U heeft nog geen keuze gemaakt.<br>");
        echo("Maak alsnog een keuze en klik opnieuw op 'Ga door...'<br>");
    }
}