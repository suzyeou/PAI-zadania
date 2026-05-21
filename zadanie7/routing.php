<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('start');

App::getRouter()->setLoginRoute('loginView');

App::getRouter()->addRoute('start',        'StartCtrl');

App::getRouter()->addRoute('loginView',    'LoginCtrl');
App::getRouter()->addRoute('login',        'LoginCtrl');
App::getRouter()->addRoute('logout',       'LoginCtrl');

App::getRouter()->addRoute('registerView', 'RegisterCtrl');
App::getRouter()->addRoute('register',     'RegisterCtrl');

App::getRouter()->addRoute('userView',     'UserCtrl',  ['User']);
App::getRouter()->addRoute('userViewPart', 'UserCtrl',  ['User']);
App::getRouter()->addRoute('songSave',     'UserCtrl',  ['User']);
App::getRouter()->addRoute('songDelete',   'UserCtrl',  ['User']);
App::getRouter()->addRoute('songEdit',     'UserCtrl',  ['User']);

App::getRouter()->addRoute('adminView',        'AdminCtrl', ['Admin']);
App::getRouter()->addRoute('adminViewPart',    'AdminCtrl', ['Admin']);
App::getRouter()->addRoute('moodSave',         'AdminCtrl', ['Admin']);
App::getRouter()->addRoute('moodDelete',       'AdminCtrl', ['Admin']);
App::getRouter()->addRoute('userDelete',       'AdminCtrl', ['Admin']);
App::getRouter()->addRoute('userSave',         'AdminCtrl', ['Admin']);