<?php
use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('calcShow');

App::getRouter()->addRoute('calcShow',    'CalcCtrl',  ['user','admin']);
App::getRouter()->addRoute('calcCompute', 'CalcCtrl',  ['user','admin']);
App::getRouter()->addRoute('login',       'LoginCtrl');
App::getRouter()->addRoute('logout',      'LoginCtrl', ['user','admin']);