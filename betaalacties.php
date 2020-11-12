<?php
if (isset($_GET["submit"])) {
    if (isset($_GET["betaal"])) {
        if ($_GET["betaal"] === "iDEAL") {
            echo("<form action='betaalpagina.php'>");
            echo("<label for='bank'>Kies uw bank: </label>");
            echo("<select id='bank' name='bank'>");
            echo("<option value='ABN Amro'>ABN Amro</option>");
            echo("<option value='ING'>ING</option>");
            echo("<option value='Rabobank'>Rabobank</option>");
            echo("<option value='ASN Bank'>ASN Bank</option>");
            echo("<option value='Bunq'>Bunq Bank</option>");
            echo("<option value='Handelsbanken'>Handelsbanken</option>");
            echo("<option value='Knab'>Knab</option>");
            echo("<option value='Moneyou'>Moneyou</option>");
            echo("<option value='Regiobank'>Regiobank</option>");
            echo("<option value='SNS Bank'>SNS Bank</option>");
            echo("<option value='Triodos Bank'>Triodos Bank</option>");
            echo("<option value='Van Lanschot'>Van Lanschot</option>");
            echo("</select>");
            echo("<br>");
            echo("Als u op 'bestellen' klikt, wordt u omgeleid naar de iDEAL pagina van uw bank.<br>");
            echo("<br>");
            echo("<input type='submit' value='Bestellen'>"); //Dit moet komen in de volledige winkelmand
            echo("</form>");
        }
        if ($_GET["betaal"] === "Credit-Card") {
            echo("<form action='betaalpagina.php'>");
            echo("<label for='creditcard-bank'>Kies een soort creditcard: </label>");
            echo("<select id='credit-bank' name='credit-bank'>");
            echo("<option value='VISA'>VISA</option>");
            echo("<option value='Mastercard'>Mastercard</option>");
            echo("<option value='American Express'>American Express</option>");
            echo("</select><br>");
            echo("Creditcard-nummer:  <input type='text' name='creditcard-nummer' placeholder='XXXX-XXXX-XXXX-XXXX'><br>");
            echo("Geldig tot:         <input type='text' name='creditcard-maand' placeholder='MM' size='1'> / <input type='text' name='creditcard-jaar' placeholder='YY' size='1'><br>");
            echo("Naam op kaart:      <input type='text' name='creditcard-naam' placeholder='J.J. Janssen'><br>");
            echo("CVC-code:           <input type='text' name='creditcard-cvc' placeholder='XXX' size='2'><br>");
            echo("<br>");
            echo("<input type='submit' value='Bestellen'>"); //Dit moet komen in de volledige winkelmand
            echo("</form>");
        }
        if ($_GET["betaal"] === "Cash") {
            echo("<form action='betaalpagina.php'>");
            echo("Betaal binnen 2 werkdagen aan de balie...<br>");
            echo("<br>");
            echo("<input type='submit' value='Bestellen'>"); //Dit moet komen in de volledige winkelmand
            echo("</form>");
        }
        if ($_GET["betaal"] === "Check") {
            echo("<form action='betaalpagina.php'>");
            echo("Lever de check binnen 2 werkdagen af bij de balie...<br>");
            echo("<br>");
            echo("<input type='submit' value='Bestellen'>"); //Dit moet komen in de volledige winkelmand
            echo("</form>");
        }
        if ($_GET["betaal"] === "EFT") {
            echo("<form action='betaalpagina.php'>");
            echo("Maak het totaalbedrag binnen 2 werkdagen over naar IBAN:<br>");
            echo("<br>");
            echo("NL12 TEST 1234 5678 90<br>");
            echo("<br>");
            echo("Vul bij het betalingskenmerk het ordernummer in, die u op de factuur krijgt...<br>");
            echo("<br>");
            echo("<input type='submit' value='Bestellen'>"); //Dit moet komen in de volledige winkelmand
            echo("</form>");
        }
    }
    else{
        echo("U heeft nog geen keuze gemaakt.<br>");
        echo("Maak alsnog een keuze en klik opnieuw op 'Ga door...'");
    }
}