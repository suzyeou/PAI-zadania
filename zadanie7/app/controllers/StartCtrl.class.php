<?php
namespace app\controllers;

use core\App;
use core\SessionUtils;
use core\RoleUtils;

class StartCtrl {
    public function action_start() {
        $user = SessionUtils::loadObject('user', true);

        if (!$user) {
            App::getRouter()->redirectTo('loginView');
        } else {
            if (RoleUtils::inRole('admin')) {
                App::getRouter()->redirectTo('adminView');
            } else {
                App::getRouter()->redirectTo('userView');
            }
        }
    }
}