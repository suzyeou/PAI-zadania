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

$conf->root_path = dirname(__FILE__);
$conf->server_url = 'http://'.$conf->server_name;
$conf->app_url = $conf->server_url.$conf->app_root;

if ($conf->clean_urls) {
    $conf->action_root = $conf->app_root."/";
} else {
    $conf->action_root = $conf->app_root.$conf->action_script.'?'.$conf->action_param.'=';
}
$conf->action_url = $conf->server_url.$conf->action_root;

App::createAndInitialize($conf);

$conf->roles = SessionUtils::loadObject('_roles', true);

if (!is_array($conf->roles)) {
    $conf->roles = array();
}

function getConf() { return core\App::getConf(); }
function getMessages() { return core\App::getMessages(); }
function getSmarty() { return core\App::getSmarty(); }