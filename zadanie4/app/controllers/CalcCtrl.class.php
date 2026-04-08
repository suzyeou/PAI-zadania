<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;

class CalcCtrl {

    private $form;
    private $result;

    public function __construct() {
        $this->form = [];
        $this->result = null;
    }

    public function action_calcShow() {
    $this->form['amount'] = '';
    $this->form['years'] = '';
    $this->form['interest'] = '';
    
    $this->generateView();
}

    public function action_calcCompute() {
        $this->form['amount'] = ParamUtils::getFromRequest('amount');
        $this->form['years'] = ParamUtils::getFromRequest('years');
        $this->form['interest'] = ParamUtils::getFromRequest('interest');

        if ($this->validate()) {
            $amount = floatval($this->form['amount']);
            $years = intval($this->form['years']);
            $interest = floatval($this->form['interest']);

            $total_interest = $amount * ($interest / 100) * $years;
            $this->result = ($amount + $total_interest) / ($years * 12);
            
            $this->result = round($this->result, 2);
            Utils::addInfoMessage('Obliczenia wykonane pomyślnie.');
        }

        $this->generateView();
    }

    private function validate() {
        if (!(isset($this->form['amount']) && isset($this->form['years']) && isset($this->form['interest']))) {
            return false; 
        }

        if ($this->form['amount'] == "") Utils::addErrorMessage('Nie podano kwoty kredytu.');
        if ($this->form['years'] == "") Utils::addErrorMessage('Nie podano liczby lat.');
        if ($this->form['interest'] == "") Utils::addErrorMessage('Nie podano oprocentowania.');

        if (App::getMessages()->isError()) return false;

        if (!is_numeric($this->form['amount'])) {
            Utils::addErrorMessage('Kwota kredytu musi być liczbą.');
        } elseif ($this->form['amount'] <= 0) {
            Utils::addErrorMessage('Kwota kredytu musi być wartością dodatnią.');
        }

        if (!is_numeric($this->form['years'])) {
            Utils::addErrorMessage('Liczba lat musi być liczbą.');
        } else {
            $years_int = intval($this->form['years']);
            if ($years_int <= 0) {
                Utils::addErrorMessage('Liczba lat musi być większa od zera.');
            } elseif ($this->form['years'] != $years_int) {
                Utils::addErrorMessage('Liczba lat musi być liczbą całkowitą.');
            }
        }

        if (!is_numeric($this->form['interest'])) {
            Utils::addErrorMessage('Oprocentowanie musi być liczbą.');
        } elseif ($this->form['interest'] < 0) {
            Utils::addErrorMessage('Oprocentowanie nie może być ujemne.');
        }

        return !App::getMessages()->isError();
    }

    private function generateView() {
        App::getSmarty()->assign('page_title', 'Kalkulator Kredytowy');
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('res', $this->result);
        App::getSmarty()->display('calc.html');
    }
}