<?php
$conf->server_name = 'localhost';
$conf->server_url = 'http://'.$conf->server_name;

$conf->app_root = '/zadanie7'; 

$conf->action_root = $conf->app_root.'/ctrl.php?action=';
$conf->action_url = $conf->server_url.$conf->action_root;
$conf->app_url = $conf->server_url.$conf->app_root;
$conf->root_path = dirname(__FILE__);

$conf->assets_url = $conf->app_url.'/public/assets';

$conf->db_type = 'mysql';
$conf->db_name = 'moodtrackdb';
$conf->db_user = 'root';
$conf->db_pass = '';
$conf->db_server = 'localhost';