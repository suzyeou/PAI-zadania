<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use app\forms\RegisterForm;

class RegisterCtrl {
    private $form;

    public function __construct() {
        $this->form = new RegisterForm();
    }

    public function action_registerView() {
        $this->generateView();
    }

    public function action_register() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');
        $this->form->pass2 = ParamUtils::getFromRequest('pass2');

        if (empty($this->form->login)) {
            Utils::addErrorMessage('Podaj login');
        }
        if (empty($this->form->pass)) {
            Utils::addErrorMessage('Podaj hasło');
        }
        if (empty($this->form->pass2)) {
            Utils::addErrorMessage('Powtórz hasło');
        }

        if (App::getMessages()->isError()) {
            $this->generateView();
            return;
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $this->form->login)) {
            Utils::addErrorMessage('Login może składać się tylko z liter i cyfr (bez spacji i znaków specjalnych)');
        }

        if (strlen($this->form->login) < 3) {
            Utils::addErrorMessage('Login musi mieć co najmniej 3 znaki');
        }

        if (strlen($this->form->pass) < 4) {
            Utils::addErrorMessage('Hasło musi mieć co najmniej 4 znaki');
        }

        if ($this->form->pass !== $this->form->pass2) {
            Utils::addErrorMessage('Hasła nie są identyczne');
        }

        $forbiddenLogins = ['admin', 'administrator', 'root'];
        if (in_array(strtolower($this->form->login), $forbiddenLogins)) {
            Utils::addErrorMessage('Ta nazwa użytkownika jest zarezerwowana');
        }

        if (!App::getMessages()->isError()) {
            if (App::getDB()->has("USER", ["login" => $this->form->login])) {
                Utils::addErrorMessage('Ten login jest już zajęty');
            }
        }

        if (App::getMessages()->isError()) {
            $this->generateView();
            return;
        }

        try {
            App::getDB()->insert("USER", [
                "login" => $this->form->login,
                "password" => password_hash($this->form->pass, PASSWORD_DEFAULT),
                "createdAt" => date("Y-m-d H:i:s")
            ]);

            $idUser = App::getDB()->id();

            App::getDB()->insert("USER_ROLE", [
                "idUser" => $idUser,
                "idRole" => 2
            ]);

            Utils::addInfoMessage('Konto zostało utworzone. Możesz się zalogować.');
            App::getRouter()->redirectTo('loginView');

        } catch (\PDOException $e) {
            Utils::addErrorMessage('Błąd zapisu do bazy danych');
            $this->generateView();
        }
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('RegisterView.tpl');
    }
}