<?php
require('./includes/config.inc.php');
include('./includes/header2.html');
require(MYSQL);
?>
Enter your billing information:
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="container-fluid">
<div class="loginform" style="height:300px">

<div class="row">
<div class="col-sm-4 col-md-4 col-lg-4">
Enter Your Credit Card No:
</div>
<div class="col-sm-6 col-md-6 col-lg-6">
<input type="text" name="cardno" placeholder="****-****-****">
</div>
<div class="col-sm-2 col-md-2 col-lg-2"></div>
</div>

<div class="row">
<div class="col-sm-3 col-md-3 col-lg-3">
Enter Expiration Date:
</div>
<div class="col-sm-3 col-md-3 col-lg-3">
<input type="text" name="exdate" placeholder="mm/dd/yyyy">
</div>
<div class="col-sm-3 col-md-3 col-lg-3">
CVV:
</div>
<div class="col-sm-3 col-md-3 col-lg-3">
<input type="text" name="cvv" size="3">
</div>
</div>

<div class="row">
<div class="col-sm-4 col-md-4 col-lg-4">
Enter Your Phone No:
</div>
<div class="col-sm-6 col-md-6 col-lg-6">
<input type="text" name="phno" placeholder="Enter 10 digit phone no">
</div>
</div>

<div class="row">
<div class="col-sm-4 col-md-4 col-lg-4">
Enter Your Email No:
</div>
<div class="col-sm-6 col-md-6 col-lg-6">
<input type="email" name="email" placeholder="xyz@abc.com">
</div>
</div>

<div class="row">
<button type="submit" class="btn btn-success" id="logbtn">Confirm Payment</button>
</div>

</div>
</div>
</form> 
