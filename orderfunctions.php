<?php
function changeStock($quantity, $ID) {
    include "connect.php";
    $stockquery = "UPDATE stockitemholdings SET QuantityOnHand = QuantityOnHand - ? WHERE StockItemID = ?";
    $Statement = mysqli_prepare($Connection, $stockquery);
    mysqli_stmt_bind_param($Statement, "ii", $quantity, $ID);
    mysqli_stmt_execute($Statement);
    if(mysqli_affected_rows($Statement) == 1 ){
        return TRUE;
    }
    else{
        return FALSE;
    }
}