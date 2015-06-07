<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);
?>
<!--Thankyou-->
<div class="onlinefleetmanager">
<div class="container-fluid">
<h3 style="color:orange"><b>Your Booking is Confirmed!!!</b></h3>
<a href="getacab.php">Click here</a> if you want to book another taxi.
</div>
</div><br>
<?php
include('./includes/footer.html');
?>
