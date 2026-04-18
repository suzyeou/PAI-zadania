<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;
use app\forms\CalcForm;
use app\transfer\CalcResult;

class CalcCtrl {

    private $form;
    private $result;

    public function __construct() {
        $this->form = new CalcForm();
        $this->result = new CalcResult();
    }

    public function action_calcShow() {
        $this->form->amount = '';
        $this->form->years = '';
        $this->form->interest = '';
        $this->generateView();
    }

    public function action_calcCompute() {
        $this->form->amount = ParamUtils::getFromRequest('amount');
        $this->form->years = ParamUtils::getFromRequest('years');
        $this->form->interest = ParamUtils::getFromRequest('interest');

        if ($this->validate()) {
            $amount = floatval($this->form->amount);
            $years = intval($this->form->years);
            $interest = floatval($this->form->interest);

            $total_interest = $amount * ($interest / 100) * $years;
            $this->result->result = ($amount + $total_interest) / ($years * 12);
            
            $this->result->result = round($this->result->result, 2);
            
            App::getMessages()->addInfo('Obliczenia wykonane pomyślnie.');
        }

        $this->generateView();
    }

    private function validate() {
        if (!(isset($this->form->amount) && isset($this->form->years) && isset($this->form->interest))) {
            return false; 
        }

        if ($this->form->amount == "") App::getMessages()->addError('Nie podano kwoty kredytu.');
        if ($this->form->years == "") App::getMessages()->addError('Nie podano liczby lat.');
        if ($this->form->interest == "") App::getMessages()->addError('Nie podano oprocentowania.');

        if (App::getMessages()->isError()) return false;

        $amount = floatval($this->form->amount);

        if ($amount > 100000 && !RoleUtils::inRole('admin')) {
            App::getMessages()->addError('Tylko administrator może obliczać kredyt powyżej 100 000 zł.');
        }

        if (!is_numeric($this->form->amount)) {
            App::getMessages()->addError('Kwota kredytu musi być liczbą.');
        } elseif ($amount <= 0) {
            App::getMessages()->addError('Kwota kredytu musi być wartością dodatnią.');
        }

        if (!is_numeric($this->form->years)) {
            App::getMessages()->addError('Liczba lat musi być liczbą.');
        } else {
            $years_int = intval($this->form->years);
            if ($years_int <= 0) {
                App::getMessages()->addError('Liczba lat musi być większa od zera.');
            } elseif ($this->form->years != $years_int) {
                App::getMessages()->addError('Liczba lat musi być liczbą całkowitą.');
            }
        }

        if (!is_numeric($this->form->interest)) {
            App::getMessages()->addError('Oprocentowanie musi być liczbą.');
        } elseif ($this->form->interest < 0) {
            App::getMessages()->addError('Oprocentowanie nie może być ujemne.');
        }

        return !App::getMessages()->isError();
    }

    private function generateView() {
        App::getSmarty()->assign('page_title', 'Kalkulator Kredytowy');
        
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('res', $this->result);
        
        $user = \core\SessionUtils::load('user', true);
        
        App::getSmarty()->assign('user', $user);

        App::getSmarty()->display('calc.html');
    }
}