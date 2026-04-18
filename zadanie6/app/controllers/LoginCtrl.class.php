<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;
use core\SessionUtils;
use app\forms\LoginForm;

class LoginCtrl {
    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }

    public function getParams() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');
    }

    public function validate() {
        if (!isset($this->form->login) || !isset($this->form->pass)) return false;

        if (empty($this->form->login)) App::getMessages()->addError('Nie podano loginu.');
        if (empty($this->form->pass)) App::getMessages()->addError('Nie podano hasła.');

        if (App::getMessages()->isError()) return false;

        $record = App::getDB()->get("user", [
            "login",
            "pass",
            "role"
        ], [
            "login" => $this->form->login,
            "pass" => $this->form->pass
        ]);

        if ($record) {
            RoleUtils::addRole($record['role']);
            
            \core\SessionUtils::storeObject('_roles', App::getConf()->roles);
            \core\SessionUtils::store('user', $record['login']);
        } else {
            App::getMessages()->addError('Niepoprawny login lub hasło z bazy danych.');
        }

        return !App::getMessages()->isError();
    }

    public function action_login() {
        $this->getParams();
        if ($this->validate()) {
            App::getRouter()->redirectTo('calcShow');
        } else {
            $this->generateView();
        }
    }

    public function action_logout() {
        SessionUtils::remove('_roles');
        SessionUtils::remove('user');
        
        App::getMessages()->addInfo('Poprawnie wylogowano.');
        App::getRouter()->redirectTo('login');
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('login.html');
    }
}