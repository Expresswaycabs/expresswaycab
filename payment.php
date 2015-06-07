<?php
require('./includes/config.inc.php');
require(MYSQL);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	 <meta name="viewport" content="width=device-width, initial-scale=1"/>
	 <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	 <title>Book Cabs Online</title>
	 <link rel="shortcut icon" href="images/favicon.ico">
	 <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="css/styles.css">
	 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=hi"></script>
	 <style>
	   @media screen and (max-width:767px){
	      .logo,.needaride,.row,.ofm{
		   text-align:center;
		   }
	   }
	   @media screen and (min-width:768px){
	      .logo,.needaride,.row,.ofm{
		  text-align:center;
		  }
	   }
	   @media screen and (min-width:992px){
	      .logo,.needaride,.row,.ofm{
		  align-content:center;
		  }
	   }
	   @media projection and (min-width:1200px){
	      .logo,.needaride,.row,.ofm{
		  text-align:center;
		  }
	   }
	   .error{
	       color:red;
	   }
	 </style>
	 <script>
         $(document).ready(function(){
         $('[data-toggle="tooltip"]').tooltip();   
         });
        </script>
</head>
<body>
<div class="header">
<h1 class="logo">PAYMENT GATEWAY</h1>
</div>		
<br>&nbsp;&nbsp;Enter your billing information:
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="container-fluid">


<div class="row">
<div class="col-sm-3 col-md-3 col-lg-3">
Enter Your Credit Card No:
</div>
<div class="col-sm-3 col-md-3 col-lg-3">
<input type="text" name="cardno" placeholder="****-****-****">
</div>
<div class="col-sm-6 col-md-6 col-lg-6"></div>
</div><br>

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
</div><br>

<div class="row">
<div class="col-sm-3 col-md-3 col-lg-3">
Enter Your Phone No:
</div>
<div class="col-sm-3 col-md-3 col-lg-3">
<input type="text" name="phno" placeholder="Enter 10 digit phone no">
</div>
<div class="col-sm-6 col-md-6 col-lg-6"></div>
</div><br>
<br>

<div class="row">
<div class="col-sm-3 col-md-3 col-lg-3">
Enter Your Email No:
</div>
<div class="col-sm-3 col-md-3 col-lg-3">
<input type="email" name="email" placeholder="xyz@abc.com">
</div>
<div class="col-sm-6 col-md-6 col-lg-6"></div>
</div><br><br>

<div class="row">
<button type="submit" class="btn btn-success" id="logbtn">Confirm Payment</button>
</div>


</div>
</form> 
</body>
</html>
