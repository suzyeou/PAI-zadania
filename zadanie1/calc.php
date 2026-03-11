<?php

$amount = $_REQUEST['amount'] ?? null;
$years = $_REQUEST['years'] ?? null;
$interest = $_REQUEST['interest'] ?? null;

$messages = [];

if (!(isset($amount) && isset($years) && isset($interest))) {
    $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

if ($amount == "") {
    $messages[] = 'Nie podano kwoty kredytu';
}
if ($years == "") {
    $messages[] = 'Nie podano liczby lat';
}

if (empty($messages)) {
    
    if (!is_numeric($amount)) {
        $messages[] = 'Kwota nie jest liczbą';
    }
    
    if (!is_numeric($years)) {
        $messages[] = 'Liczba lat nie jest liczbą';
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
    
    if ($months > 0) {
        $result = $total_sum / $months;
    } else {
        $messages[] = 'Liczba lat musi być większa od zera';
    }
}

include 'calc_view.php';