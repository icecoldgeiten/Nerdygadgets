<?php
include "cartfunctions.php";

function Order($credentials, $cart) {
    include "connect.php";
    $totalprice = GetCartPrice($cart);

    if (!empty($credentials) && !empty($cart) && !empty($totalprice)) {
        $querry = "insert into order_nl (Name, Address, Address2, PostalCode, City, PhoneNumber, TotalPrice)
               values(?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'sssssif', $credentials['postal-name'], $credentials['postal-address1'], $credentials['postal-address2'], $credentials['postal-postalcode'], $credentials['postal-city'], $credentials['postal-phone'], $totalprice);
        mysqli_stmt_execute($stmt);
    }

    $orderID = mysqli_insert_id($Connection);

    if (isset($orderID)) {
        //Hier maak je de order lines aan
        foreach ($cart as $productID => $quantity) {
            OrderLine($orderID, $productID, $quantity);
        }
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