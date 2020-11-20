<?php
include "cartfunctions.php";

function Order($credentials) {
    var_dump($credentials);
    exit();
    include "connect.php";
    $totalprice = GetCartPrice($cart);


    if (!empty($credentials) && !empty($cart) && !empty($totalprice)) {
        $querry = "insert into order_nl (Name, Address, Address2, PostalCode, City, PhoneNumber, TotalPrice)
               values(?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'sssssid', $credentials['postal-name'], $credentials['postal-address1'], $credentials['postal-address2'], $credentials['postal-postalcode'], $credentials['postal-city'], $credentials['postal-phone'], $totalprice);
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
// array(3) { ["SellPrice"]=> string(8) "22.35600" ["stockitemname"]=> string(42) "DBA joke mug - mind if I join you? (White)" ["stockitemid"]=> int(16) }


//VERGEET NIET DE VOORAAD VAN EEN PRODUCT OOK BIJ TE WERKEN
function OrderLine($orderID, $productID, $quantity)
{
    include "connect.php";
    //Hier maken we de orderline

    //Je hebt nu je product
    $product = GetProduct($productID);

    $querry = "insert into orderline_nl (UnitPrice, StockItemName, StockItemID, Quantity, OrderID)
               values(?,?,?,?,?)";
    $stmt = mysqli_prepare($Connection, $querry);
    mysqli_stmt_bind_param($stmt, 'ssiii', $product['SellPrice'], $product['stockitemname'], $product['stockitemid'], $quantity, $orderID);
    mysqli_stmt_execute($stmt);

    $OrderLineID = mysqli_insert_id($Connection);
}
    //Zorg dat je de orderline koppelt aan je order
    //Vergeet ook het het aantal $quantity in de orderline te zetten
