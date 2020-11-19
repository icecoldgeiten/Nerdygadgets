<?php
include "connect.php";
include "cartfunctions.php";


function Order($cart) {
    //Hier maak je de order aan in de database met credentials

    $naam = $_POST["postal-name"];
    $address1= $_POST["postal-address1"];
    $address2= $_POST["postal-address2"];
    $postcode = $_POST["postal-postalcode"];
    $city = $_POST["postal-city"];
    $phone = $_POST["postal-phone"];
    $orderID = 1;

    insertgeust($naam,$address1,$address2, $postcode, $city, $phone, $orderID);

    //OrderID is het id van de order die je net hebt aangemaakt


    foreach ($cart as $productID => $quantity) {
    //Hier maak je de order lines aan
        OrderLine($orderID, $productID, $quantity);
    }
}

//VERGEET NIET DE VOORAAD VAN EEN PRODUCT OOK BIJ TE WERKEN
function OrderLine($orderID, $productID, $quantity) {
    //Hier maken we de orderline

    //Je hebt nu je product
    $product = GetProduct($productID);
    vardump($product);

    $Query = " insert into orderline_nl (OrderID, StockItemID, Quantity)
                values (?,?,?)";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'iii', $orderID, $productID, $quantity);
    mysqli_stmt_execute($statement);
    //Zorg dat je de orderline koppelt aan je order
    //Vergeet ook het het aantal $quantity in de orderline te zetten
}

function insertgeust($naam, $address1, $address2, $postcode, $city, $phone, $orderID){
    $querry = "insert into order_nl (name, Address, Address2, PostalCode, City, PhoneNumber)
               values(?,?,?,?,?,?)
               where OrderID = ?";
    $statement = mysqli_prepare($connection, $querry);
    mysqli_stmt_bind_param($statement, 'sssssii', $naam,$address1, $address2, $postcode, $city, $phone, $orderID);
    mysqli_stmt_execute($statement);
}
