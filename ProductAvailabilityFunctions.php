<?php

function ProductAvailableDays($date) {
    $date = new DateTime($date);
    $today = new DateTime();
    $days  = $date->diff($today)->format('%a');

    return $days;
}
// Vragen hoe dit anders kan dan

function ProductAvailable($id, $amount) {
    $product = GetProduct($id);
    var_dump($product); exit();
    $days = ProductAvailableDays($date);
    $stock = CheckStock($id, $amount);

    if ($days <= 0 && $stock) {
        return false;
    }

    return true;
}