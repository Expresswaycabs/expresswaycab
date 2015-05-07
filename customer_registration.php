<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);

$reg_errors = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

/*check for full name*/
if(preg_match('/^[A-Z ]{2,40}$/i',$_POST['customer_name'])){
          $customer_name = mysqli_real_escape_string($dbc,$_POST['customer_name']);
}else{
          $reg_errors['$customer_name'] = 'Enter your name!';
}

/*check for birth date*/
if($_POST['customer_DOB']!=""){
          $customer_DOB = mysqli_real_escape_string($dbc,$_POST['customer_DOB']);
}else{
          $reg_errors['$customer_DOB'] = 'Enter your birth date!';
}

/*check for gender*/
if($_POST['customer_gender']!=""){
          $customer_gender = mysqli_real_escape_string($dbc,$_POST['customer_gender']);
}else{
          $reg_errors['$customer_gender'] = 'Enter your name!';
}

/*check for email id*/
if(filter_var($_POST['customer_eid'],FILTER_VALIDATE_EMAIL)){
          $customer_eid = mysqli_real_escape_string($dbc,$_POST['customer_eid']);
}else{
          $reg_errors['$customer_eid'] = 'Enter a valid email id!';
}

/*check for password*/
if(preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,20}$/i',$_POST['customer_pass'])){
     if($_POST['customer_pass']==$_POST['customer_pass1']){
          $customer_pass = mysqli_real_escape_string($dbc,$_POST['customer_pass']);
     }else{
          $reg_errors['$customer_pass1'] = 'Passwords do not match';
		  }	 
}else{
          $reg_errors['$customer_pass'] = 'Enter a valid password!';
}

/*check for mobile number*/
if(preg_match('/^[0-9]{10}$/',$_POST['customer_mno'])){
          $customer_mno = mysqli_real_escape_string($dbc,$_POST['customer_mno']);
}else{
          $reg_errors['$customer_mno'] = 'Enter your mobile number!';
}

/*check for address*/
if($_POST['customer_add']!=""){
          $customer_add = mysqli_real_escape_string($dbc,$_POST['customer_add']);
}else{
          $reg_errors['$customer_add'] = 'Enter your address!';
}

/*check for city*/
if(preg_match('/^[A-Z\'.-]{2,40}$/i',$_POST['customer_city'])){
          $customer_city = mysqli_real_escape_string($dbc,$_POST['customer_city']);
}else{
          $reg_errors['$customer_city'] = 'Enter your city!';
}

/*check for pincode*/
if(preg_match('/^[0-9]{6}$/i',$_POST['customer_pin'])){
          $customer_pin = mysqli_real_escape_string($dbc,$_POST['customer_pin']);
}else{
          $reg_errors['$customer_pin'] = 'Enter your pincode!';
}

if(empty($reg_errors)){

          
		  $result = mysqli_query( $dbc , "SELECT customer_eid,customer_mno FROM customer_detail WHERE customer_eid= '$customer_eid' OR customer_mno= '$customer_mno' LIMIT 0 , 30");
		  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		  $rows = mysqli_num_rows($result);
		  
		  if($rows==0){
		         $query = "INSERT INTO customer_detail(customer_name,customer_DOB,customer_gender,customer_eid,customer_pass,customer_mno,customer_add,customer_city,customer_pin)VALUES('$customer_name','$customer_DOB','$customer_gender','$customer_eid','$customer_pass','$customer_mno','$customer_add','$customer_city','$customer_pin')";
		         $result = mysqli_query($dbc,$query);
				 
				 if(mysqli_affected_rows($dbc)==1){
				 header('Location:customer_login.php');
				 }else{
				    if($rows==2){
					$reg_errors['customer_eid'] = 'This email is already registered.';
					$reg_errors['customer_mno'] = 'This mobile number is already registered';
					}else{
				        $row = mysqli_fetch_array($result,MYSQLI_NUM);
						if(($row[0]==$_POST['customer_eid'])&&($row[1]==$_POST['customer_mno'])){
						$reg_errors['customer_eid'] = 'This email is already registered.';
						$reg_errors['customer_mno'] = 'This mobile number is already registered';
						}else if($row[0]==$_POST['customer_eid']){
					    $reg_errors['customer_eid'] = 'This email is already registered.';
					    }else if($row[0]==$_POST['customer_eid']){
						$reg_errors['customer_mno'] = 'This mobile number is already registered.';
						}
					}	
				 }
		  }
}

}

?>
<div class="registration_form">
<div class="container">

<form method="POST" action="customer_registration.php" style="background:#99ccff"><br>
               <label for="fullname" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Full Name</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="customer_name" value="<?php if(isset($_POST['customer_name']))echo htmlspecialchars($_POST['customer_name'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_name', $reg_errors))echo $reg_errors['$customer_name'];?></span>
                <br><br>
				<label for="birthdate" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Birth Date</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="date" name="customer_DOB" value="<?php if(isset($_POST['customer_DOB']))echo htmlspecialchars($_POST['customer_DOB'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_DOB', $reg_errors))echo $reg_errors['$customer_DOB'];?></span>
                <br><br>
				<label for="gender" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Gender</label>
					    <div class="col-sm-3 col-md-3 col-lg-3">
                     <input type="radio" name="customer_gender"
                       <?php if (isset($_POST['customer_gender']) && $customer_gender=="female") echo "checked";?>
                          value="female">Female
                     <input type="radio" name="customer_gender"
                       <?php if (isset($_POST['customer_gender']) && $customer_gender=="male") echo "checked";?>
                          value="male">Male
					 <input type="radio" name="customer_gender"
                       <?php if (isset($_POST['customer_gender']) && $customer_gender=="others") echo "checked";?>
                          value="others">Others	  
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_gender', $reg_errors))echo $reg_errors['$customer_gender']?></span>
                <br><br>
				<label for="email" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Email ID</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="email" name="customer_eid" value="<?php if(isset($_POST['customer_eid']))echo htmlspecialchars($_POST['customer_eid'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_eid', $reg_errors))echo $reg_errors['$customer_eid']?></span>
                <br><br>
				<label for="password" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Password</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="password" data-toggle="tooltip" data-placement="right" title="Enter only alphanumeric values!" name="customer_pass" value="<?php if(isset($_POST['customer_pass']))echo htmlspecialchars($_POST['customer_pass'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_pass', $reg_errors))echo $reg_errors['$customer_pass']?></span>
                <br><br>
				<label for="confirmpassword" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Confirm Password</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="password" data-toggle="tooltip" data-placement="right" title="Enter only alphanumeric values!" name="customer_pass1" value="<?php if(isset($_POST['customer_pass1']))echo htmlspecialchars($_POST['customer_pass1'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_pass1', $reg_errors))echo $reg_errors['$customer_pass1']?></span>
                <br><br>
				<label for="mobile" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Mobile Number</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="customer_mno" value="<?php if(isset($_POST['customer_mno']))echo htmlspecialchars($_POST['customer_mno'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_mno', $reg_errors))echo $reg_errors['$customer_mno']?></span>
                <br><br>
				<label for="address" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Address</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <textarea rows="6" cols="33" name="customer_add" style="color:black;" value="<?php if(isset($_POST['customer_add']))echo htmlspecialchars($_POST['customer_add'])?>" autocomplete="off"></textarea>
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_add', $reg_errors))echo $reg_errors['$customer_add']?></span>
                <br><br><br><br><br><br><br>
				<label for="city" class="col-sm-3 col-md-3 col-lg-3 control-label" id="city" style="text-align:right">City</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" id="ccity" type="text" name="customer_city" value="<?php if(isset($_POST['customer_city']))echo htmlspecialchars($_POST['customer_city'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_city', $reg_errors))echo $reg_errors['$customer_city']?></span>
                <br><br>
				<label for="pincode" class="col-sm-3 col-md-3 col-lg-3 control-label" id="pcode" style="text-align:right">Pin Code</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" id="pin" data-toggle="tooltip" data-placement="top" title="Enter 6-digit pincode!" name="customer_pin" value="<?php if(isset($_POST['customer_pin']))echo htmlspecialchars($_POST['customer_pin'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$customer_pin', $reg_errors))echo $reg_errors['$customer_pin']?></span>
                <br><br>
				<div class="row">
                <div class="col-md-12">
                <input class="btn btn-primary" type="submit" id="register" name="register" value="Register"/>
                </div>
                </div><br>
</form>

</div>
</div><br>
<?php
include('./includes/footer.html');
?>
