<?php

function TransformCamelCase($string) : string  {
    $value = '';
    $parts = preg_split('/(?=[A-Z])/',  $string, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($parts as $part) {
        if ($value) {
            $value = $value . ' ' . $part;
        } else {
            $value = $part;
        }
    }
    return $value;
}