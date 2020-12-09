<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $Connection = mysqli_connect("localhost", "Customer", "ETYfo5%DyCuBD0@wcR0", "nerdygadgets");
    mysqli_set_charset($Connection, 'latin1');
    $DatabaseAvailable = true;
} catch (mysqli_sql_exception $e) {
    $DatabaseAvailable = false;
}
if (!$DatabaseAvailable) {
    ?><h2>Website wordt op dit moment onderhouden.</h2><?php
    die();
}
?>
