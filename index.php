<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);
?>

<!--NEED A RIDE?-->
<div class="container-fluid">
<div class="optionmenu">
<h1 class="needaride">NEED A RIDE??!!</h1><br><br>
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-3">
<a type="button" class="btn btn-success btn-lg" id="getcabbutton" href="customer_login.php">Get A Cab</a>
</div>
<div class="col-md-3">
<a type="button" class="btn btn-success btn-lg" id="managebutton" href="serviceprovider_login.php">Online Fleet Manager</a>
</div>
<div class="col-md-3"></div>
</div>
</div><br>
<!--NEED A RIDE? ENDS-->

<!--Provide Feedback,Track Your Taxi,Manage your booking-->

<div class="customermenu">
<div class="container-fluid">
<div class="row">
  <div class="col-md-4">
    <a href="feedback.php"><img src="images/feedback.jpg" id="fbk" class="img-responsive center-block" alt="no img"></a>
    <h2>Provide Feedback</h2>
  </div>
  <div class="col-md-4">
    <a href="#"><img src="images/tracktaxi.jpg" id="tktx" class="img-responsive center-block" alt="no img"></a>
    <h2>Track Your Taxi</h2>
  </div>
  <div class="col-md-4">
    <a href="#"><img src="images/managebooking.jpg" id="mgbk" class="img-responsive center-block" alt="no img"></a>
    <h2>Manage Bookings</h2>
  </div>
</div>
</div>
</div><br>
<!--Menu ends here-->

<!--Online Fleet Manager Description-->
<div class="onlinefleetmanager">
<div class="container-fluid">
<h3 style="color:orange">What is Online Fleet Manager?</h3>
<div class="row">
  <div class="col-md-4">
    <p><a style="color:orange">Online Fleet Manager</a> is a one-stop
       online help for all the taxi service
       providers.It helps with managing your fleet of
	   taxis and staff details with the easy-to-use database.<br>Not only this, your company is also ranked on the basis of the customer feedback provided to ExpresswayCabs.</p>
  </div>
  <div class="col-md-4">
    <img src="images/owner.jpg" class="img-responsive center-block" alt="no img">
  </div>
  <div class="col-md-4">
    <p>So what are you waiting for?!!<br>Register yourself and experience a new way of handling your business.</p>
    <a type="button" class="btn btn-success btn-lg" id="registerbutton" href="serviceprovider_registration.php">Register</a>
  </div>
</div>
</div>
</div><br>
<?php
include('./includes/footer.html');
?>
