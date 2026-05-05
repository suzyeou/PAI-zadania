<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\SessionUtils;

class AdminCtrl {
    
    public function action_adminView() {
        $user = SessionUtils::loadObject('user', true);
        $moods = App::getDB()->select("MOOD", ["idMood", "name"]);

        App::getSmarty()->assign('user', $user);
        App::getSmarty()->assign('moods', $moods);

        $this->generateView();
    }

    public function generateView() {
        App::getSmarty()->display('AdminView.tpl');
    }
}