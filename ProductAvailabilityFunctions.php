<?php

function ProductAvailableDays($date) {
    $diff = abs(strtotime($date) - strtotime("now"));
    $days = floor(($diff)/ (60*60*24));

    return $days;
}

function ProductAvailable($id, $amount) {
    $product = GetProduct($id);
    $days = ProductAvailableDays($product['ValidTo']);
    $stock = CheckStock($id, $amount);

    if ($days <= 0 || !$stock) {
        return false;
    }

    return true;
}