<?php
include "cartfunctions.php";
include "ProductAvailabilityFunctions.php";

function StartTransaction()
{
    include "SQLaccount.php";
    mysqli_autocommit($Connection, false);
    mysqli_begin_transaction($Connection);
}

function OrderCommit()
{
    include "SQLaccount.php";
    mysqli_commit($Connection);
    mysqli_autocommit($Connection, true);
}

function OrderRollback()
{
    include "SQLaccount.php";
    mysqli_rollback($Connection);
    mysqli_autocommit($Connection, true);
}

function MakeOrder($credentials, $cart, $id)
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

    if (mysqli_affected_rows($Connection) > 0) {
        return $orderID;
    } else {
        return false;
    }
}

function MakeOrderLine($orderID, $cart)
{
    include "SQLaccount.php";

    foreach ($cart as $productID => $quantity) {
        $product = GetProduct($productID);
        $querry = "insert into orderline_nl (UnitPrice, StockItemName, StockItemID, Quantity, OrderID)
               values(?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'ssiii', $product['SellPrice'], $product['stockitemname'], $product['stockitemid'], $quantity, $orderID);
        mysqli_stmt_execute($stmt);
    }
    if (mysqli_affected_rows($Connection) > 0) {
        return true;
    } else {
        return false;
    }
}

function UpdateTheStock($cart)
{
    include "SQLaccount.php";
    foreach ($cart as $productID => $quantity) {
        $Query = " 
           UPDATE StockItemHoldings  
            SET QuantityOnHand = (QuantityOnHand - ?)
            WHERE stockitemid = ?";
        $statement = mysqli_prepare($Connection, $Query);
        mysqli_stmt_bind_param($statement, 'ii', $quantity, $productID);
        mysqli_stmt_execute($statement);
    }
    if (mysqli_affected_rows($Connection) > 0) {
        return true;
    } else {
        return false;
    }
}

function OrderProducts($credentials, $cart, $id)
{
    include "SQLaccount.php";
    StartTransaction();
    $orderID = MakeOrder($credentials, $cart, $id);
    if (isset($orderID) && $orderID != false) {
        if (MakeOrderLine($orderID, $cart)) {
            if (UpdateTheStock($cart)) {
                OrderCommit();
                return true;
            } elseif (!UpdateTheStock($cart)) {
                OrderRollback();
                return false;
            }
        } elseif (!MakeOrderLine($orderID, $cart)) {
            OrderRollback();
            return false;
        }

    } elseif (!MakeOrder($credentials, $cart, $id)) {
        OrderRollback();
        return false;
    }
    return false;
}