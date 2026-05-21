<?php
namespace app\controllers;

use core\App;
use core\Utils;
use core\ParamUtils;
use core\SessionUtils;
use app\forms\SongForm;

class UserCtrl {
    private $form;

    public function __construct() {
        $this->form = new SongForm();
    }
    
    public function action_userView() {
        $this->checkAndLoadData();
        $this->generateView();
    }

    public function action_userViewPart() {
        $this->checkAndLoadData();
        App::getSmarty()->display('UserViewTable.tpl');
    }

    private function checkAndLoadData() {
        $user = SessionUtils::loadObject('user', true);
        if (!$user) { 
            App::getRouter()->redirectTo('loginView'); 
            return; 
        }

        $userData = App::getDB()->get("USER", "idUser", ["login" => $user->login]);

        $searchForm['artist'] = ParamUtils::getFromRequest('sf_artist');
        $searchForm['idMood'] = ParamUtils::getFromRequest('sf_mood');
        $searchForm['sort'] = ParamUtils::getFromRequest('sf_sort');
        
        $page = ParamUtils::getFromRequest('page');
        if (empty($page) || !is_numeric($page) || $page < 1) {
            $page = 1;
        } else {
            $page = intval($page);
        }

        if (empty($searchForm['sort'])) {
            $searchForm['sort'] = 'date_desc';
        }

        $where = [
            "SONG.idUser" => $userData
        ];

        if (!empty($searchForm['artist'])) {
            $where["SONG.artist[~]"] = $searchForm['artist']; 
        }

        if (!empty($searchForm['idMood'])) {
            $where["SONG.idMood"] = $searchForm['idMood'];
        }

        $totalRecords = App::getDB()->count("SONG", [
            "[>]MOOD" => ["idMood" => "idMood"]
        ], "SONG.idSong", $where);

        $limit = 3; 
        $totalPages = ceil($totalRecords / $limit); 
        
        if ($page > $totalPages && $totalPages > 0) {
            $page = $totalPages; 
        }
        $offset = ($page - 1) * $limit; 

        switch ($searchForm['sort']) {
            case 'date_asc': $where["ORDER"] = ["SONG.addedAt" => "ASC"]; break;
            case 'artist_asc': $where["ORDER"] = ["SONG.artist" => "ASC"]; break;
            case 'artist_desc': $where["ORDER"] = ["SONG.artist" => "DESC"]; break;
            case 'date_desc':
            default: $where["ORDER"] = ["SONG.addedAt" => "DESC"]; break;
        }

        $where["LIMIT"] = [$offset, $limit];

        $moods = App::getDB()->select("MOOD", ["idMood", "name"]);

        $songs = App::getDB()->select("SONG", [
            "[>]MOOD" => ["idMood" => "idMood"]
        ], [
            "SONG.idSong",
            "SONG.title",
            "SONG.artist",
            "SONG.intensity",
            "MOOD.name(mood_name)"
        ], $where);

        App::getSmarty()->assign('user', $user);
        App::getSmarty()->assign('form', $this->form);
        App::getSmarty()->assign('searchForm', $searchForm);
        App::getSmarty()->assign('moods', $moods);
        App::getSmarty()->assign('songs', $songs);
        App::getSmarty()->assign('page', $page);
        App::getSmarty()->assign('totalPages', $totalPages);
    }

    public function action_songEdit() {
        $user = SessionUtils::loadObject('user', true);
        if (!$user) { App::getRouter()->redirectTo('loginView'); return; }

        $idSong = ParamUtils::getFromRequest('idSong');
        $idUser = App::getDB()->get("USER", "idUser", ["login" => $user->login]);

        if (!empty($idSong)) {
            $songData = App::getDB()->get("SONG", "*", ["idSong" => $idSong, "idUser" => $idUser]);

            if ($songData) {
                $this->form->idSong = $songData['idSong'];
                $this->form->title = $songData['title'];
                $this->form->artist = $songData['artist'];
                $this->form->idMood = $songData['idMood'];
                $this->form->intensity = $songData['intensity'];
            } else {
                Utils::addErrorMessage('Nie znaleziono utworu lub brak uprawnień.');
            }
        }

        $this->action_userView();
    }

    public function action_songSave() {
        $user = SessionUtils::loadObject('user', true);
        if (!$user) { App::getRouter()->redirectTo('loginView'); return; }

        $this->form->idSong = ParamUtils::getFromRequest('idSong');
        $this->form->title = ParamUtils::getFromRequest('title');
        $this->form->artist = ParamUtils::getFromRequest('artist');
        $this->form->idMood = ParamUtils::getFromRequest('idMood');
        $this->form->intensity = ParamUtils::getFromRequest('intensity');

        if (empty($this->form->title) || trim($this->form->title) == '') { 
            Utils::addErrorMessage('Podaj tytuł piosenki.'); 
        }
        if (empty($this->form->artist) || trim($this->form->artist) == '') { 
            Utils::addErrorMessage('Podaj wykonawcę.'); 
        }
        if (empty($this->form->idMood)) { 
            Utils::addErrorMessage('Wybierz nastrój z listy.'); 
        }
        
        if ($this->form->intensity === null || $this->form->intensity === '') {
            Utils::addErrorMessage('Podaj intensywność nastroju.');
        } else {
            if (!filter_var($this->form->intensity, FILTER_VALIDATE_INT) && $this->form->intensity !== '0') {
                Utils::addErrorMessage('Intensywność musi być liczbą całkowitą.');
            } else {
                $intensityVal = intval($this->form->intensity);
                if ($intensityVal < 1 || $intensityVal > 10) {
                    Utils::addErrorMessage('Intensywność nastroju musi mieścić się w przedziale od 1 do 10.');
                }
            }
        }

        if (App::getMessages()->isError()) {
            $this->action_userView();
            return;
        }

        $idUser = App::getDB()->get("USER", "idUser", ["login" => $user->login]);

        $cleanedTitle = trim($this->form->title);
        $cleanedArtist = trim($this->form->artist);

        if (empty($this->form->idSong)) {
            $isDuplicate = App::getDB()->has("SONG", [
                "AND" => [
                    "title" => $cleanedTitle,
                    "artist" => $cleanedArtist,
                    "idMood" => $this->form->idMood,
                    "idUser" => $idUser
                ]
            ]);
        } else {
            $isDuplicate = App::getDB()->has("SONG", [
                "AND" => [
                    "title" => $cleanedTitle,
                    "artist" => $cleanedArtist,
                    "idMood" => $this->form->idMood,
                    "idUser" => $idUser,
                    "idSong[!]" => $this->form->idSong
                ]
            ]);
        }

        if ($isDuplicate) {
            Utils::addErrorMessage('Masz już w swoim dzienniku utwór "' . $cleanedTitle . '" wykonawcy "' . $cleanedArtist . '" przypisany do tego nastroju.');
            $this->action_userView();
            return;
        }

        try {
            if (empty($this->form->idSong)) {
                App::getDB()->insert("SONG", [
                    "title" => $cleanedTitle,
                    "artist" => $cleanedArtist,
                    "idMood" => $this->form->idMood,
                    "intensity" => intval($this->form->intensity),
                    "idUser" => $idUser
                ]);
            } else {
                App::getDB()->update("SONG", [
                    "title" => $cleanedTitle,
                    "artist" => $cleanedArtist,
                    "idMood" => $this->form->idMood,
                    "intensity" => intval($this->form->intensity)
                ], [
                    "idSong" => $this->form->idSong,
                    "idUser" => $idUser 
                ]);
            }

            App::getRouter()->redirectTo('userView');

        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił nieoczekiwany błąd bazy danych podczas zapisu.');
            $this->action_userView();
        }
    }

    public function action_songDelete() {
        $user = SessionUtils::loadObject('user', true);
        if (!$user) { App::getRouter()->redirectTo('loginView'); return; }

        $idSong = ParamUtils::getFromRequest('idSong');
        $idUser = App::getDB()->get("USER", "idUser", ["login" => $user->login]);

        if (!empty($idSong)) {
            $songOwner = App::getDB()->get("SONG", "idUser", ["idSong" => $idSong]);

            if ($songOwner == $idUser) {
                App::getDB()->delete("SONG", ["idSong" => $idSong]);
            } else {
                Utils::addErrorMessage('Nie masz uprawnień do modyfikacji tego utworu.');
                $this->action_userView();
                return;
            }
        } else {
            Utils::addErrorMessage('Nie przekazano prawidłowego identyfikatora utworu.');
            $this->action_userView();
            return;
        }

        App::getRouter()->redirectTo('userView');
    }

    public function generateView() {
        App::getSmarty()->display('UserView.tpl');
    }
}