<?php
include "connect.php";
include "cartfunctions.php";

function Order($credentials, $cart) {
    //Hier maak je de order aan in de database met credentials
    var_dump($credentials);

    //OrderID is het id van de order die je net hebt aangemaakt
    $orderID = 1;

    //Hier maak je de order lines aan
    foreach ($cart as $productID => $quantity) {
        OrderLine($orderID, $productID, $quantity);
    }
}

//VERGEET NIET DE VOORAAD VAN EEN PRODUCT OOK BIJ TE WERKEN
function OrderLine($orderID, $productID, $quantity) {
    //Hier maken we de orderline

    //Je hebt nu je product
    $product = GetProduct($productID);

    //Zorg dat je de orderline koppelt aan je order
    //Vergeet ook het het aantal $quantity in de orderline te zetten
}