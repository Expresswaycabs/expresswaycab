<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["us-cdbr-iron-east-02.cleardb.net"];
$username = $url["b48d7c722bf68a"];
$password = $url["903a58ac24087be"];
$db = substr($url["mysql://b48d7c722bf68a:903a58ac24087be@us-cdbr-iron-east-02.cleardb.net/heroku_79f9ab8d2fe0569?reconnect=true"], 1);

$dbc = new mysqli($server, $username, $password, $db);

$active_group = 'default';
$active_record = TRUE ;
$db['default']['hostname'] = $server;
$db['default']['username'] = $username;
$db['default']['password'] = $password;
$db['default']['database'] = $db;
$db['default']['dbdriver'] = 'mysql';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['striction'] = FALSE;


?>
