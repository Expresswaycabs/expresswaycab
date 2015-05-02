<?php
require('./includes/config.inc.php');
redirect_invalid_user();
$_SESSION = array();
session_destroy();
setcookie(session_name(),'',time()-300);
$page_title = 'Logout';
include('./includes/header.html');
echo '<div style="padding-bottom:300px;background:#99ccff"><br><h3>Logged Out!!</h3><p>Thank you for visiting. You are now logged out. Please come back soon!</p></div><br>';
require(MYSQL);
include('./includes/footer.html');
?>
