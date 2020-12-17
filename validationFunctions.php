<?php

function validateString($string): string {
    $string = trim($string, "\'\<\>\?\!\|\/");
    $string = stripcslashes($string);
    $string = htmlspecialchars($string, ENT_QUOTES, 'UTF-8');

    return $string;
}