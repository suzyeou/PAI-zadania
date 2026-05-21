<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\SessionUtils;
use core\ParamUtils;

class AdminCtrl {
    
    public function action_adminView() {
        $this->loadAdminData();
        $this->generateView();
    }

    public function action_adminViewPart() {
        $this->loadAdminData();
        App::getSmarty()->display('AdminMoodTable.tpl');
    }

    private function loadAdminData() {
        $user = SessionUtils::loadObject('user', true);
        
        $searchMood = ParamUtils::getFromRequest('searchMood');
        $moodWhere = [];
        if (!empty($searchMood)) {
            $moodWhere["name[~]"] = '%' . $searchMood . '%'; 
        }
        $moods = App::getDB()->select("MOOD", ["idMood", "name"], $moodWhere);

        $currentAdminId = (is_object($user) && isset($user->idUser)) ? $user->idUser : 0;
        $userWhere = [
            "idUser[!]" => $currentAdminId,
            "login[!]" => ['admin', 'administrator']
        ];

        $totalUsers = App::getDB()->count("USER", $userWhere);

        $perPage = 5; 
        $page = ParamUtils::getFromRequest('page');
        if (empty($page) || !is_numeric($page) || $page < 1) $page = 1; else $page = intval($page);
        
        $totalPages = ceil($totalUsers / $perPage);
        if ($totalPages < 1) $totalPages = 1;
        if ($page > $totalPages) $page = $totalPages;

        $offset = ($page - 1) * $perPage;
        $userWhere["LIMIT"] = [$offset, $perPage];
        $users = App::getDB()->select("USER", ["idUser", "login"], $userWhere);

        App::getSmarty()->assign('user', $user);
        App::getSmarty()->assign('moods', $moods);
        App::getSmarty()->assign('searchMood', $searchMood);
        App::getSmarty()->assign('users', $users);
        App::getSmarty()->assign('currentPage', $page);
        App::getSmarty()->assign('totalPages', $totalPages);
    }

    public function action_moodSave() {
        $idMood = ParamUtils::getFromRequest('idMood');
        $name = ParamUtils::getFromRequest('name');

        if (empty($name) || trim($name) == '') {
            Utils::addErrorMessage('Nazwa nastroju nie może być pusta.');
        } else {
            $cleanedName = trim($name);

            if (!empty($idMood)) {
                $exists = App::getDB()->has("MOOD", [
                    "AND" => [
                        "name" => $cleanedName,
                        "idMood[!]" => $idMood
                    ]
                ]);
            } else {
                $exists = App::getDB()->has("MOOD", [
                    "name" => $cleanedName
                ]);
            }

            if ($exists) {
                Utils::addErrorMessage('Nastrój o nazwie "' . $cleanedName . '" już istnieje w katalogu.');
            }
        }

        if (App::getMessages()->isError()) {
            $this->action_adminView();
            return;
        }

        try {
            if (!empty($idMood)) {
                App::getDB()->update("MOOD", ["name" => trim($name)], ["idMood" => $idMood]);
                Utils::addInfoMessage('Pomyślnie zaktualizowano nazwę nastroju.');
            } else {
                App::getDB()->insert("MOOD", ["name" => trim($name)]);
                Utils::addInfoMessage('Nowy nastrój został pomyślnie dodany do katalogu.');
            }
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Błąd zapisu nastroju w bazie danych.');
        }

        $this->action_adminView();
    }

    public function action_moodDelete() {
        $idMood = ParamUtils::getFromRequest('idMood');
        if (!empty($idMood)) {
            try {
                App::getDB()->delete("MOOD", ["idMood" => $idMood]);
                Utils::addInfoMessage('Nastrój został pomyślnie usunięty.');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Nie można usunąć nastroju. Jest przypisany do utworów użytkowników.');
            }
        }
        $this->action_adminView();
    }

    public function action_userSave() {
        $idUser = ParamUtils::getFromRequest('idUser');
        $newPass = ParamUtils::getFromRequest('password');

        if (empty($newPass)) {
            Utils::addErrorMessage('Wpisz nowe hasło, jeśli chcesz je zmienić.');
        } else if (strlen($newPass) < 4) {
            Utils::addErrorMessage('Nowe hasło musi mieć co najmniej 4 znaki.');
        }

        if (App::getMessages()->isError()) {
            $this->action_adminView();
            return;
        }

        if (!empty($idUser)) {
            try {
                $userLogin = App::getDB()->get("USER", "login", ["idUser" => $idUser]);
                App::getDB()->update("USER", ["password" => password_hash($newPass, PASSWORD_DEFAULT)], ["idUser" => $idUser]);
                Utils::addInfoMessage('Pomyślnie zmieniono hasło dla użytkownika: ' . $userLogin);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Błąd aktualizacji hasła w bazie danych.');
            }
        }
        $this->action_adminView();
    }

    public function action_userDelete() {
        $idUser = ParamUtils::getFromRequest('idUser');
        if (!empty($idUser)) {
            try {
                $userLogin = App::getDB()->get("USER", "login", ["idUser" => $idUser]);
                
                App::getDB()->delete("SONG", ["idUser" => $idUser]);
                App::getDB()->delete("USER", ["idUser" => $idUser]);
                
                Utils::addInfoMessage('Użytkownik ' . $userLogin . ' oraz wszystkie jego utwory zostały pomyślnie usunięte.');
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Nie można usunąć użytkownika z powodu błędu bazy danych.');
            }
        }
        $this->action_adminView();
    }

    public function generateView() {
        App::getSmarty()->display('AdminView.tpl');
    }
}