<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $Connection = mysqli_connect("localhost", "viewaccount", "c!05*6!pXbWlW8a5&Py", "nerdygadgets");
    mysqli_set_charset($Connection, 'latin1');
    $DatabaseAvailable = true;
} catch (mysqli_sql_exception $e) {
    $DatabaseAvailable = false;
}
if (!$DatabaseAvailable) {
    ?><h2>Website wordt op dit moment onderhouden.</h2><?php
    die();
}
