<?php

$amount = $_REQUEST['amount'] ?? null;
$years = $_REQUEST['years'] ?? null;
$interest = $_REQUEST['interest'] ?? null;

$messages = [];

if (!isset($amount) || $amount == "") {
    $messages[] = 'Nie podano kwoty kredytu.';
}
if (!isset($years) || $years == "") {
    $messages[] = 'Nie podano liczby lat.';
}

if (!isset($interest) || $interest == "") {
    $messages[] = 'Nie wybrano oprocentowania.';
}

if (empty($messages)) {
    
    if (!is_numeric($amount)) {
        $messages[] = 'Kwota kredytu musi być liczbą.';
    } elseif ($amount <= 0) {
        $messages[] = 'Kwota kredytu musi być wartością dodatnią.';
    }

    if (!is_numeric($years)) {
        $messages[] = 'Liczba lat musi być liczbą.';
    } else {
        $years_int = intval($years);
        if ($years_int <= 0) {
            $messages[] = 'Liczba lat musi być większa od zera.';
        } elseif ($years != $years_int) {
            $messages[] = 'Liczba lat musi być liczbą całkowitą.';
        }
    }

    if (!is_numeric($interest)) {
        $messages[] = 'Oprocentowanie musi być liczbą.';
    } elseif ($interest < 0) {
        $messages[] = 'Oprocentowanie nie może być ujemne.';
    }
}

if (empty($messages)) {
    
    $amount = floatval($amount);
    $years = intval($years);
    $interest = intval($interest);

    $total_percentage = ($years * $interest) / 100;
    $extra_cost = $amount * $total_percentage;
    $total_sum = $amount + $extra_cost;
    
    $months = $years * 12;
    $result = $total_sum / $months;
}

include 'calc_view.php';
