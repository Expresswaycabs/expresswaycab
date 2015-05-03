<?php
$url = parse_url(getenv("CLEARDB_DATABASE_URL"));

$server = $url["us-cdbr-iron-east-02.cleardb.net"];
$username = $url["b48d7c722bf68a"];
$password = $url["903a58ac24087be"];
$db = substr($url["heroku_79f9ab8d2fe0569"], 1);

$dbc = new mysqli($server, $username, $password, $db);


?>
