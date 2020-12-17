<?php
include "cartfunctions.php";
include "ProductAvailabilityFunctions.php";

function Order($credentials, $cart, $id)
{
    include "SQLaccount.php";
    $totalprice = GetCartPrice($cart);

    if (empty($credentials) && empty($cart) && empty($totalprice)) {
        return false;
    }

    foreach ($cart as $productID => $quantity) {
        if (!ProductAvailable($productID, $quantity)) {
            return false;
        }
    }
    try {
        $querry = "insert into order_nl (Name, Address, Address2, PostalCode, City, PhoneNumber, TotalPrice, DeliveryMethodID, PaymentMethodID, EmailAddress, CustomerID)
           values(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'sssssidiiss', $credentials['postal-name'], $credentials['postal-address1'], $credentials['postal-address2'], $credentials['postal-postalcode'], $credentials['postal-city'], $credentials['postal-phone'], $totalprice, $credentials['deliveryoptions'], $credentials['betaal'], $credentials['postal-EmailAddress'], $id);
        mysqli_stmt_execute($stmt);
    } catch (Exception $e){
        header("location: payment.php");
        print "Er is iets mis met de formulering van uw postcode of email";
        return false;
        die();
    }
    $orderID = mysqli_insert_id($Connection);

    if (isset($orderID)) {
        foreach ($cart as $productID => $quantity) {
            OrderLine($orderID, $productID, $quantity);
        }
    }

    if (mysqli_affected_rows($Connection) > 0) {
        return true;
    }

    return false;
}

function OrderLine($orderID, $productID, $quantity)
{
    include "SQLaccount.php";

    $product = GetProduct($productID);

    $querry = "insert into orderline_nl (UnitPrice, StockItemName, StockItemID, Quantity, OrderID)
               values(?,?,?,?,?)";
    $stmt = mysqli_prepare($Connection, $querry);
    mysqli_stmt_bind_param($stmt, 'ssiii', $product['SellPrice'], $product['stockitemname'], $product['stockitemid'], $quantity, $orderID);
    $result = mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($Connection) > 0) {
        UpdateStock($productID, $quantity);
    }

    return true;
}

function UpdateStock($ID, $quantity)
{
    include "SQLaccount.php";
    $Query = " 
           UPDATE StockItemHoldings  
            SET QuantityOnHand = (QuantityOnHand - ?)
            WHERE stockitemid = ?";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'ii', $quantity, $ID);
    mysqli_stmt_execute($statement);
}
