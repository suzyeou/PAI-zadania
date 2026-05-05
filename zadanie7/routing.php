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

App::getRouter()->addRoute('userView',     'UserCtrl',  ['User','Admin']);
App::getRouter()->addRoute('adminView',    'AdminCtrl', ['Admin']);