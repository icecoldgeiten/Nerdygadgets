<div class="col-md-12">
    <?php
    include __DIR__ . "/header.php";
    include __DIR__ . "/connect.php";
    $post = $_SESSION['post'];
    if (!empty($post)) {
        if ($post['passed'] === 'Betaling gelukt!') {
            echo("<h1>Yes. De betaling is gelukt!</h1><br>");
            echo("U krijgt een bevestiging van uw order factuur toegestuurd.<br>");
            include __DIR__ . "/mailer.php";
            unset($_SESSION['cart']);
        }
        else {
            ?>
            <h1 class='mb-0'>Huh? Er is iets fout gegaan met bestellen</h1><br>
            <h3 class='mb-0'>Zou je het nog een keer willen proberen?</h3><br>
            <p>Je kan het opnieuw proberen door uw bestelling nogmaals te doen.</p>
            <p>Lukt het nog steeds niet? Neem dan contact op.</p><br>
            <?php
        }
    } else {
        header("location: betaalpagina.php");
    }
    ?>
    <br>
    <a href='index.php'>Terug naar de homepage...</a>
</div>
<?php
include __DIR__ . "/footer.php";

?>