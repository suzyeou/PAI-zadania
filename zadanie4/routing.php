<?php
use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('calcShow');
App::getRouter()->addRoute('calcShow',    'CalcCtrl');
App::getRouter()->addRoute('calcCompute', 'CalcCtrl');