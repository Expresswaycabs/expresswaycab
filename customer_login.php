<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);

$login_errors = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

if(filter_var($_POST['customer_eid'],FILTER_VALIDATE_EMAIL)){
     $customer_eid = mysqli_real_escape_string($dbc,$_POST['customer_eid']);
}else{
     $login_errors['customer_eid'] = 'Enter a valid email id!';
}

if(!empty($_POST['customer_pass'])){
      $customer_pass = mysqli_real_escape_string($dbc,$_POST['customer_pass']);
}else{
      $login_errors['customer_pass'] = 'Enter your password!';
}

if(empty($login_errors)){
      $query = "SELECT customer_id,customer_name,customer_eid,customer_pass FROM customer_detail WHERE (customer_eid='$customer_eid' AND customer_pass='$customer_pass')";
	  $result = mysqli_query($dbc,$query);
	  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
	  if(mysqli_num_rows($result)==1){
	     $row = mysqli_fetch_array($result,MYSQLI_NUM);
		 $_SESSION['customer_id'] = $row[0];
		 $_SESSION['customer_name'] = $row[1];
		 $_SESSION['customer_eid'] = $row[2];
		 $_SESSION['customer_pass'] = $row[3];
		 header('Location:getacab.php');
		 session_register('customer_id');
	  }else{
         $login_errors['customer_eid'] = 'Email and Password do not match!';
      }		 
}
}
?>
<form action="" method="POST">
<div class="container-fluid">
<div class="loginform">
<br><br><br>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
<input class="form-control" type="email" name="customer_eid" id="cust_em" value="<?php if(isset($_POST['customer_eid']))echo htmlspecialchars($_POST['customer_eid'])?>" autocomplete="off" placeholder="name@domain.com"></div>
<span class="error"><?php if (array_key_exists('$customer_eid', $login_errors))echo $login_errors['$customer_eid']?></span>
</div><br>

<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
<input class="form-control" type="password" name="customer_pass" id="cust_pwd" value="" autocomplete="off" placeholder="password"></div>
<span class="error"><?php if (array_key_exists('$customer_pass', $login_errors))echo $login_errors['$customer_pass']?></span>
</div><br>

<div class="row">
<input type="checkbox" id="rm" value="">Remember Me
</div><br>

<div class="row">
<button type="submit" class="btn btn-success" id="logbtn">Log In</button>
</div><br><br>
<div class="row">
<a href="#" id="fpwd">Can't access your account?</a></div>
<div class="row">
<p id="rgstr">Don't have an account? <a href="customer_registration.php"> Register Yourself!!</a></p></div>
</form> 

</div>
</div><br>
<?php
include('./includes/footer.html');
?>
