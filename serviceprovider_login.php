<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);
$login_errors = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

if(filter_var($_POST['sp_eid'],FILTER_VALIDATE_EMAIL)){
     $sp_eid = mysqli_real_escape_string($dbc,$_POST['sp_eid']);
}else{
     $login_errors['sp_eid'] = 'Enter a valid email id!';
}

if(!empty($_POST['sp_pass'])){
      $sp_pass = mysqli_real_escape_string($dbc,$_POST['sp_pass']);
}else{
      $login_errors['sp_pass'] = 'Enter your password!';
}

if(empty($login_errors)){
      $query = "SELECT sp_id,sp_eid,sp_pass,sp_ownname FROM service_provider WHERE (sp_eid='$sp_eid' AND sp_pass='$sp_pass')";
	  $result = mysqli_query($dbc,$query);
	  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
	  if(mysqli_num_rows($result)==1){
	     $row = mysqli_fetch_array($result,MYSQLI_NUM);
		 $_SESSION['sp_id'] = $row[0];
		 $_SESSION['sp_eid'] = $row[1];
		 $_SESSION['sp_pass'] = $row[2];
		 $_SESSION['sp_ownname'] = $row[3];
		 header('Location:fleetmanager.php');
		 
	  }else{
         $login_errors['sp_eid'] = 'Email and Password do not match!';
      }	
     	  
}
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="container-fluid">
<div class="loginform">
<br><br><br>
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
<input class="form-control" type="email" name="sp_eid" id="cust_em" value="<?php if(isset($_POST['sp_eid']))echo htmlspecialchars($_POST['sp_eid'])?>" autocomplete="off" placeholder="name@domain.com"></div>
<span class="error"><?php if (array_key_exists('$sp_eid', $login_errors))echo $login_errors['$sp_eid'];?></span>
</div><br>

<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
<input class="form-control" type="password" name="sp_pass" id="cust_pwd" value="<?php if(isset($_POST['sp_pass']))echo htmlspecialchars($_POST['sp_pass'])?>" autocomplete="off" placeholder="password"></div>
<span class="error"><?php if (array_key_exists('$sp_pass', $login_errors))echo $login_errors['$sp_pass'];?></span>
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
<p id="rgstr">Don't have an account? <a href="serviceprovider_registration.php"> Register Yourself!!</a></p></div>
</form> 

</div>
</div><br>
<?php
include('./includes/footer.html');
?>
