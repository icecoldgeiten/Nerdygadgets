<?php
include __DIR__ . "/header.php";
include __DIR__ . "/connect.php";
$post = $_SESSION['post'];
if(!empty($post)) {
    if ($post['passed'] === 'Betaling gelukt!') {
        echo("<h1>De betaling is gelukt!</h1><br>");
        echo("U krijgt nu een orderbevestiging en een factuur via de mail.<br>");
        include __DIR__ . "/mailer.php";
        session_destroy();
    } else {
        echo("<h1>De betaling is niet gelukt!</h1><br>");
        echo("Je kan nog op de terugknop drukken om de betaling alsnog te voltooien.");
    }
} else {
    header("location: betaalpagina.php");
}
?>
<br>
<a href='index.php'>Ga hier terug naar de homepage...</a>
<?php
include __DIR__ . "/footer.php";

?>