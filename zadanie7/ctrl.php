<?php
require_once 'init.php';
use core\App;

$root = App::getConf()->root_path;

if (file_exists($root.'/routing.php')) {
    include $root.'/routing.php';
}

App::getRouter()->go();