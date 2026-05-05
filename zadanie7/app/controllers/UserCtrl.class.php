<?php

namespace app\controllers;

use core\App;
use core\SessionUtils;

class UserCtrl {

    public function action_userView() {
        $user = SessionUtils::loadObject('user', true);

        if (!$user) {
            App::getRouter()->redirectTo('loginView');
            return;
        }

        App::getSmarty()->assign('user', $user);
        App::getSmarty()->assign('songs', []); 

        $this->generateView();
    }

    public function generateView() {
        App::getSmarty()->display('UserView.tpl');
    }
}