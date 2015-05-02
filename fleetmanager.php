<?php
require('./includes/config.inc.php');
include('./includes/header1.html');
require(MYSQL);
?>
session_register(sp_id);
<div class="ofmmenu">
<div class="container-fluid">
<h2 class="ofm">OnlineFleetManager</h2>
<form method="POST" action="">
<br><br>
<div class="row">
  <div class="col-md-2">
    <a href="fleetdetails.php"><img src="images/taxifleet.jpg" id="txft" class="img-responsive center-block" alt="no img"></a>
  </div>  
  <div class="col-md-2">	
	<h3><a href="fleetdetails.php">Access Fleet Details</a></h3>
  </div>
  <div class="col-md-4"></div>
  <div class="col-md-2">
    <a href="staffdetails.php"><img src="images/staff.jpg" id="stf" class="img-responsive center-block" alt="no img"></a>
  </div>
  <div class="col-md-2">  
	<h3><a href="staffdetails.php">Access Employee Details</a></h3>
  </div>
</div>
<br>
<div class="row">
  <div class="col-md-2">
    <a href="#"><img src="images/cash.jpg" id="mgact" class="img-responsive center-block" alt="no img"></a>
  </div> 
  <div class="col-md-2">  
   <h3><a href="#">Manage Company Accounts</a></h3>
  </div>
  <div class="col-md-4"></div>
  <div class="col-md-2">
    <a href="#"><img src="images/tracktaxi.jpg" id="trktx" class="img-responsive center-block" alt="no img"></a>
  </div>  
  <div class="col-md-2">	
	<h3><a href="#">Track Your Taxi</a></h3>
  </div>
</div>


</form>
</div>
</div><br>
<?php
include('./includes/footer.html');
?>
