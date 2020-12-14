<?php

function ProductAvailableDays($date) {
//    $date2 = new DateTime($date);
//    $today = new DateTime();
//    $days2  = $date2->diff($today)->format('%a');

    $date = preg_split('/[\s]+/', $date);
    $diff = abs(strtotime("now") - strtotime($date[0]));
    $days = ($diff)  / (60 * 60 * 24);

    return round($days);
}

function ProductAvailable($id, $amount) {
    $product = GetProduct($id);
    $days = ProductAvailableDays($product['ValidTo']);
    $stock = CheckStock($id, $amount);

    if ($days <= 0 || $stock) {
        return false;
    }

    return true;
}