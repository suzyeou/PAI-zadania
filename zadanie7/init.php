<?php
require_once 'core/Config.class.php';
require_once 'core/App.class.php';

use core\App;
use core\Config;
use core\SessionUtils;

$conf = new Config();
$conf->clean_urls = false;
$conf->action_param = 'action';
$conf->action_script = '/ctrl.php';

include 'config.php'; 

App::createAndInitialize($conf);

$conf->roles = SessionUtils::loadObject('_amelia_roles', true);
if (!is_array($conf->roles)) {
    $conf->roles = array();
}

$user = SessionUtils::loadObject('user', true);
App::getSmarty()->assign('user', $user);

if (isset($user) && isset($user->role)) {
    $conf->roles[$user->role] = true;
}

function getConf() { return core\App::getConf(); }
function getMessages() { return core\App::getMessages(); }
function getSmarty() { return core\App::getSmarty(); }