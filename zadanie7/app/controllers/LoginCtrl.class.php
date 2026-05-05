<?php

namespace app\controllers;

use core\App;
use core\Utils;
use core\RoleUtils;
use core\ParamUtils;
use core\SessionUtils;
use app\forms\LoginForm;
use app\transfer\User;

class LoginCtrl {

    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }

    public function action_loginView() {
        $this->generateView();
    }

    public function action_login() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');

        if (empty($this->form->login)) {
            Utils::addErrorMessage('Nie podano loginu');
        }
        if (empty($this->form->pass)) {
            Utils::addErrorMessage('Nie podano hasła');
        }

        if (App::getMessages()->isError()) {
            $this->generateView();
            return;
        }

        $user_data = App::getDB()->get("USER", "*", [
            "login" => $this->form->login
        ]);

        if ($user_data && password_verify($this->form->pass, $user_data['password'])) {
            $roles = App::getDB()->select("USER_ROLE", [
                "[>]ROLE" => ["idRole" => "idRole"]
            ], [
                "ROLE.name"
            ], [
                "USER_ROLE.idUser" => $user_data['idUser']
            ]);

            if (session_status() == PHP_SESSION_NONE) session_start();
            unset($_SESSION['_amelia_roles']);

            foreach ($roles as $r) {
                RoleUtils::addRole($r['name']); 
            }

            $user = new User($user_data['login'], $roles[0]['name'] ?? 'user');
            SessionUtils::storeObject('user', $user); 

            if (RoleUtils::inRole('Admin')) {
                App::getRouter()->redirectTo("adminView");
            } else {
                App::getRouter()->redirectTo("userView");
            }
        } else {
            Utils::addErrorMessage('Niepoprawny login lub hasło');
            $this->generateView();
        }
    }

    public function action_logout() {
        SessionUtils::remove('user');
        session_destroy();
        App::getRouter()->redirectTo('loginView');
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('user', SessionUtils::loadObject('user', true));
        App::getSmarty()->display('LoginView.tpl');
    }
}