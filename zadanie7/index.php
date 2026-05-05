<?php
require_once dirname(__FILE__).'/init.php';

use core\App;

header("Location: ".App::getConf()->action_url.App::getRouter()->getDefaultRoute());