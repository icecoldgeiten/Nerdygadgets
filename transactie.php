<?php
include __DIR__ . "/header.php";
include __DIR__ . "/connect.php";

if (isset($_GET["passed"]) && $_GET["passed"] === "Betaling gelukt!") {
    echo("<h1>De betaling is gelukt!</h1><br>");
    echo("U krijgt nu een orderbevestiging en een factuur via de mail.<br>");
    include __DIR__ . "/mailer.php";
}
if (isset($_GET["failed"]) && $_GET["failed"] === "Betaling mislukt!") {
    echo("<h1>De betaling is niet gelukt!</h1><br>");
    echo("Je kan nog op de terugknop drukken om de betaling alsnog te voltooien.");
}
?>
<br>
<a href='index.php'>Ga hier terug naar de homepage...</a>
<?php
include __DIR__ . "/footer.php";
?>