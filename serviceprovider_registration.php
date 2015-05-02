<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);

$reg_errors = array();

if($_SERVER['REQUEST_METHOD']=='POST'){

/*check for company name*/
if(preg_match('/^[A-Z ]{2,40}$/i',$_POST['sp_name'])){
          $sp_name = mysqli_real_escape_string($dbc,$_POST['sp_name']);
}else{
          $reg_errors['$sp_name'] = 'Enter your name!';
}

/*check for email id*/
if(filter_var($_POST['sp_eid'],FILTER_VALIDATE_EMAIL)){
          $sp_eid = mysqli_real_escape_string($dbc,$_POST['sp_eid']);
}else{
          $reg_errors['$sp_eid'] = 'Enter a valid email id!';
}

/*check for password*/
if(preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,20}$/i',$_POST['sp_pass'])){
     if($_POST['sp_pass']==$_POST['sp_pass1']){
          $sp_pass = mysqli_real_escape_string($dbc,$_POST['sp_pass']);
     }else{
          $reg_errors['$sp_pass1'] = 'Passwords do not match';
		  }	 
}else{
          $reg_errors['$sp_pass'] = 'Enter a valid password!';
}

/*check for license no*/
if($_POST['sp_lno']!=""){
          $sp_lno = mysqli_real_escape_string($dbc,$_POST['sp_lno']);
}else{
          $reg_errors['$sp_lno'] = 'Enter your birth date!';
}

/*check for mobile number*/
if(preg_match('/^[0-9]{10}$/',$_POST['sp_mno'])){
          $sp_mno = mysqli_real_escape_string($dbc,$_POST['sp_mno']);
}else{
          $reg_errors['$sp_mno'] = 'Enter your mobile number!';
}

/*check for owner's name*/
if(preg_match('/^[A-Z. ]{2,40}$/i',$_POST['sp_ownname'])){
          $sp_ownname = mysqli_real_escape_string($dbc,$_POST['sp_ownname']);
}else{
          $reg_errors['$sp_ownname'] = 'Enter your name!';
}

/*check for no of cars*/
if($_POST['sp_no_of_cars']!=""){
          $sp_no_of_cars = mysqli_real_escape_string($dbc,$_POST['sp_no_of_cars']);
}else{
          $reg_errors['$sp_no_of_cars'] = 'Enter your name!';
}

/*check for no of drivers*/
if($_POST['sp_no_of_drivers']!=""){
          $sp_no_of_drivers = mysqli_real_escape_string($dbc,$_POST['sp_no_of_drivers']);
}else{
          $reg_errors['$sp_no_of_drivers'] = 'Enter your name!';
}

/*check for aadhar*/
if(preg_match('/^[0-9]{12}$/i',$_POST['sp_aadhar'])){
          $sp_aadhar = mysqli_real_escape_string($dbc,$_POST['sp_aadhar']);
}else{
          $reg_errors['$sp_aadhar'] = 'Enter your pincode!';
}

/*check for address*/
if($_POST['sp_add']!=""){
          $sp_add = mysqli_real_escape_string($dbc,$_POST['sp_add']);
}else{
          $reg_errors['$sp_add'] = 'Enter your address!';
}

/*check for city*/
if($_POST['sp_city']!=""){
          $sp_city = mysqli_real_escape_string($dbc,$_POST['sp_city']);
}else{
          $reg_errors['$sp_city'] = 'Enter your city!';
}


if(empty($reg_errors)){

          
		  $result = mysqli_query( $dbc , "SELECT sp_eid,sp_mno FROM service_provider WHERE sp_eid= '$sp_eid' OR sp_mno= '$sp_mno' LIMIT 0 , 30");
		  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		  $rows = mysqli_num_rows($result);
		  
		  if($rows==0){
		         $query = "INSERT INTO service_provider(sp_name,sp_eid,sp_lno,sp_mno,sp_city,sp_no_of_cars,sp_ownname,sp_add,sp_pass,sp_no_of_drivers,sp_aadhar)VALUES('$sp_name','$sp_eid','$sp_lno','$sp_mno','$sp_city','$sp_no_of_cars','$sp_ownname','$sp_add','$sp_pass','$sp_no_of_drivers','$sp_aadhar')";
		         $result = mysqli_query($dbc,$query);
				 
				 if(mysqli_affected_rows($dbc)==1){
				 header('Location:serviceprovider_login.php');
				 }else{
				    if($rows==2){
					$reg_errors['sp_eid'] = 'This email is already registered.';
					$reg_errors['sp_mno'] = 'This mobile number is already registered';
					}else{
				        $row = mysqli_fetch_array($result,MYSQLI_NUM);
						if(($row[0]==$_POST['sp_eid'])&&($row[1]==$_POST['sp_mno'])){
						$reg_errors['sp_eid'] = 'This email is already registered.';
						$reg_errors['sp_mno'] = 'This mobile number is already registered';
						}else if($row[0]==$_POST['sp_eid']){
					    $reg_errors['sp_eid'] = 'This email is already registered.';
					    }else if($row[0]==$_POST['sp_eid']){
						$reg_errors['sp_mno'] = 'This mobile number is already registered.';
						}
					}	
				 }
		  }
}

}

?>
<div class="registration_form">
<div class="container">

<form method="POST" action="" style="background:#99ccff"><br>
               <label for="fullname" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Company Name</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="sp_name" value="<?php if(isset($_POST['sp_name']))echo htmlspecialchars($_POST['sp_name'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_name', $reg_errors))echo $reg_errors['$sp_name'];?></span>
                <br><br>
				<label for="email" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Email ID</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="sp_eid" value="<?php if(isset($_POST['sp_eid']))echo htmlspecialchars($_POST['sp_eid'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_eid', $reg_errors))echo $reg_errors['$sp_eid'];?></span>
                <br><br>
				<label for="password" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Password</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="password" name="sp_pass" value="<?php if(isset($_POST['sp_pass']))echo htmlspecialchars($_POST['sp_pass'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_pass', $reg_errors))echo $reg_errors['$sp_pass'];?></span>
                <br><br>
				<label for="confirmpassword" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Confirm Password</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="password" name="sp_pass1" value="<?php if(isset($_POST['sp_pass1']))echo htmlspecialchars($_POST['sp_pass1'])?>" autocomplete="off">
				   </div>
                <span class="error"<?php if (array_key_exists('$sp_pass1', $reg_errors))echo $reg_errors['$sp_pass1'];?>></span>
                <br><br>
				<label for="clicense" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Company License Number</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="sp_lno" value="<?php if(isset($_POST['sp_lno']))echo htmlspecialchars($_POST['sp_lno'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_lno', $reg_errors))echo $reg_errors['$sp_lno'];?></span>
                <br><br>
				<label for="mobile" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Mobile Number</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="sp_mno" value="<?php if(isset($_POST['sp_mno']))echo htmlspecialchars($_POST['sp_mno'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_mno', $reg_errors))echo $reg_errors['$sp_mno'];?></span>
                <br><br>
				<label for="owner" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Owner's Name</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="sp_ownname" value="<?php if(isset($_POST['sp_ownname']))echo htmlspecialchars($_POST['sp_ownname'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_ownname', $reg_errors))echo $reg_errors['$sp_ownname'];?></span>
                <br><br>
				<label for="noofcars" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">No. of Cars</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="sp_no_of_cars" value="<?php if(isset($_POST['sp_no_of_cars']))echo htmlspecialchars($_POST['sp_no_of_cars'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_no_of_cars', $reg_errors))echo $reg_errors['$sp_no_of_cars'];?></span>
                <br><br>
				<label for="noofdrivers" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">No. of Drivers</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="sp_no_of_drivers" value="<?php if(isset($_POST['sp_no_of_drivers']))echo htmlspecialchars($_POST['sp_no_of_drivers'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_no_of_drivers', $reg_errors))echo $reg_errors['$sp_no_of_drivers'];?></span>
                <br><br>
				<label for="aadhar" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Owner's Aadhar Number</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <input class="form-control" type="text" name="sp_aadhar" value="<?php if(isset($_POST['sp_aadhar']))echo htmlspecialchars($_POST['sp_aadhar'])?>" autocomplete="off">
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_aadhar', $reg_errors))echo $reg_errors['$sp_aadhar'];?></span>
                <br><br>
				<label for="address" class="col-sm-3 col-md-3 col-lg-3 control-label" style="text-align:right">Address</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					   <textarea rows="6" cols="33" name="sp_add" value="<?php if(isset($_POST['sp_add']))echo htmlspecialchars($_POST['sp_add'])?>" autocomplete="off"></textarea>
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_add', $reg_errors))echo $reg_errors['$sp_add'];?></span>
                <br><br><br><br><br><br><br>
				<label for="city" class="col-sm-3 col-md-3 col-lg-3 control-label" id="city" style="text-align:right">City</label>
				   <div class="col-sm-3 col-md-3 col-lg-3">
					  <select class="form-control" id="sp_city" name="sp_city">
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Bengaluru, Karnataka") echo "checked";?>value="Bengaluru, Karnataka">Bengaluru</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Kochi, Kerala") echo "checked";?>value="Kochi, Kerala">Kochi, Kerala</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Belagavi, Karnataka") echo "checked";?>value="Belagavi, Karnataka">Belagavi, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Chennai, Tamil Nadu") echo "checked";?>value="Chennai, Tamil Nadu">Chennai, Tamil Nadu</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Mangalore, Karnataka") echo "checked";?>value="Mangalore, Karnataka">Mangalore, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Hyderabad, Telangana") echo "checked";?>value="Hyderabad, Telangana">Hyderabad, Telangana</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Panaji, Goa") echo "checked";?>value="Panaji, Goa">Panaji, Goa</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Hampi, Karnataka") echo "checked";?>value="Hampi, Karnataka 583239">Hampi, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Davangere, Karnataka") echo "checked";?>value="Davangere, Karnataka">Davangere, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Hubli, Karnataka") echo "checked";?>value="Hubli, Karnataka">Hubli, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Krishnagiri, Tamil Nadu") echo "checked";?>value="Krishnagiri, Tamil Nadu">Krishnagiri, Tamil Nadu</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Vellore, Tamil Nadu") echo "checked";?>value="Vellore, Tamil Nadu">Vellore, Tamil Nadu</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Chitradurga, Karnataka") echo "checked";?>value="Chitradurga, Karnataka">Chitradurga, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Tumakuru, Karnataka") echo "checked";?>value="Tumakuru, Karnataka">Tumakuru, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Hassan, Karnataka") echo "checked";?>value="Hassan, Karnataka">Hassan, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Belur, Karnataka") echo "checked";?>value="Belur, Karnataka">Belur, Karnataka</option>
  <option <?php if (isset($_POST['sp_city']) && $sp_city=="Mysuru, Karnataka") echo "checked";?>value="Mysuru, Karnataka">Mysuru, Karnataka</option>
</select>
				   </div>
                <span class="error"><?php if (array_key_exists('$sp_city', $reg_errors))echo $reg_errors['$sp_city'];?></span>
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
