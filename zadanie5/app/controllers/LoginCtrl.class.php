<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\RoleUtils;
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

        if ($this->form->login == "admin" && $this->form->pass == "admin") {
            RoleUtils::addRole('admin');
        } else if ($this->form->login == "user" && $this->form->pass == "user") {
            RoleUtils::addRole('user');
        } else {
            App::getMessages()->addError('Niepoprawny login lub hasło.');
        }

        if (!App::getMessages()->isError()) {
            $_SESSION['_roles'] = serialize(App::getConf()->roles);
        }

        return !App::getMessages()->isError();
    }


    public function action_login() {
        $this->getParams();
        if ($this->validate()) {
            App::getRouter()->forwardTo('calcShow');
        } else {
            $this->generateView();
        }
    }

    public function action_logout() {
        session_destroy();
        App::getRouter()->redirectTo('login');
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->display('login.html');
    }
}