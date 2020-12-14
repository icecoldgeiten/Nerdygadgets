<?php
include "cartfunctions.php";
include "ProductAvailabilityFunctions.php";

function Order($credentials, $cart, $id) {
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
        $querry = "insert into order_nl (Name, Address, Address2, PostalCode, City, PhoneNumber, TotalPrice, DeliveryMethodID, PaymentMethodID, EmailAddress, CustomerID)
           values(?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($Connection, $querry);
        mysqli_stmt_bind_param($stmt, 'sssssidiiss', $credentials['postal-name'], $credentials['postal-address1'], $credentials['postal-address2'], $credentials['postal-postalcode'], $credentials['postal-city'], $credentials['postal-phone'], $totalprice, $credentials['deliveryoptions'], $credentials['betaal'], $credentials['postal-EmailAddress'], $id);
        mysqli_stmt_execute($stmt);

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

function UpdateStock($ID, $quantity) {
    include "SQLaccount.php";
    $Query = " 
           UPDATE StockItemHoldings  
            SET QuantityOnHand = (QuantityOnHand - ?)
            WHERE stockitemid = ?";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'ii', $quantity, $ID);
    mysqli_stmt_execute($statement);
}

function StartTransaction() {
    include "SQLaccount.php";
    mysqli_autocommit($Connection, false);
    mysqli_begin_transaction($Connection);
}

function OrderCommit() {
    include "SQLaccount.php";
    mysqli_commit($Connection);
    mysqli_autocommit($Connection, true);
}

function OrderRollback() {
    include "SQLaccount.php";
    mysqli_rollback($Connection);
    mysqli_autocommit($Connection, true);
}

function OrderNew($credentials, $cart, $id) {
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
    $querry = "insert into order_nl (Name, Address, Address2, PostalCode, City, PhoneNumber, TotalPrice, DeliveryMethodID, PaymentMethodID, EmailAddress, CustomerID)
           values(?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = mysqli_prepare($Connection, $querry);
    mysqli_stmt_bind_param($stmt, 'sssssidiiss', $credentials['postal-name'], $credentials['postal-address1'], $credentials['postal-address2'], $credentials['postal-postalcode'], $credentials['postal-city'], $credentials['postal-phone'], $totalprice, $credentials['deliveryoptions'], $credentials['betaal'], $credentials['postal-EmailAddress'], $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_affected_rows($Connection) > 0) {
        return true;
    }
    else{
        return false;
    }
}

function OrderLineNew($orderID, $productID, $quantity){
    include "SQLaccount.php";
    $product = GetProduct($productID);

    $querry = "insert into orderline_nl (UnitPrice, StockItemName, StockItemID, Quantity, OrderID)
               values(?,?,?,?,?)";
    $stmt = mysqli_prepare($Connection, $querry);
    mysqli_stmt_bind_param($stmt, 'ssiii', $product['SellPrice'], $product['stockitemname'], $product['stockitemid'], $quantity, $orderID);
    mysqli_stmt_execute($stmt);
    if (mysqli_affected_rows($Connection) > 0) {
        return true;
    }
    else{
        return false;
    }
}
function UpdateStockNew($ID, $quantity) {
    include "SQLaccount.php";
    $Query = " 
           UPDATE StockItemHoldings  
            SET QuantityOnHand = (QuantityOnHand - ?)
            WHERE stockitemid = ?";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 'ii', $quantity, $ID);
    mysqli_stmt_execute($statement);
    if (mysqli_affected_rows($Connection) > 0) {
        return true;
    }
    else{
        return false;
    }
}

function GetOrderID($name){
    include "SQLaccount.php";
    $Query = " 
           SELECT MAX(OrderID) as OrderID
           FROM order_nl
           WHERE Name = ?";
    $statement = mysqli_prepare($Connection, $Query);
    mysqli_stmt_bind_param($statement, 's', $name);
    mysqli_stmt_execute($statement);
    $T = mysqli_stmt_get_result($statement);
    $s = mysqli_fetch_all($T, MYSQLI_ASSOC);
    foreach ($s as $key => $value){
        return $value['OrderID'];
    }
}
function OrderProduct($credentials, $cart, $id){
    include "SQLaccount.php";
    StartTransaction();
    if(OrderNew($credentials, $cart, $id)){
        $orderID = GetOrderID($credentials['postal-name']);
        if (isset($orderID)) {
            foreach ($cart as $productID => $quantity) {
                if (OrderLineNew($orderID, $productID, $quantity)) {
                    if (UpdateStockNew($productID, $quantity)){
                        OrderCommit();
                        return true;
                    }
                    elseif (!UpdateStockNew($productID, $quantity)){
                        OrderRollback();
                        return false;
                    }
                }
                elseif (!OrderLineNew($orderID, $productID, $quantity)) {
                    OrderRollback();
                    return false;
                }
            }
        }
    }
    elseif (!OrderNew($credentials, $cart, $id)) {
        OrderRollback();
        return false;
    }
}