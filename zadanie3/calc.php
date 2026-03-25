<?php
require_once __DIR__ . '/lib/smarty/libs/Smarty.class.php';

$amount = $_REQUEST['amount'] ?? null;
$years = $_REQUEST['years'] ?? null;
$interest = $_REQUEST['interest'] ?? null;

$messages = [];
$result = null;

if (isset($amount) || isset($years) || isset($interest)) {

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
        $interest = floatval($interest);

        $total_interest = $amount * ($interest / 100) * $years;
        $result = ($amount + $total_interest) / ($years * 12);
    }
}

$smarty = new Smarty\Smarty();

$smarty->setTemplateDir(__DIR__ . '/templates');
$smarty->setCompileDir(__DIR__ . '/templates_c');

$smarty->assign('amount', $amount);
$smarty->assign('years', $years);
$smarty->assign('interest', $interest);
$smarty->assign('messages', $messages);
$smarty->assign('result', $result);

$smarty->display('calc.html');