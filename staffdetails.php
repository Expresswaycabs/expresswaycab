<?php
require('./includes/config.inc.php');
include('./includes/header1.html');
require(MYSQL);
$reg_errors = array();
$sp_id = $_SESSION['sp_id'];
if($_SERVER['REQUEST_METHOD']=='POST'){

/*check for name*/
if($_POST['em_name']!=""){
          $em_name = mysqli_real_escape_string($dbc,$_POST['em_name']);
}else{
          $reg_errors['em_name'] = 'Enter valid name!';
}

/*check for mobile no*/
if($_POST['em_mno']!=""){
          $em_mno = mysqli_real_escape_string($dbc,$_POST['em_mno']);
}else{
          $reg_errors['$em_mno'] = 'Enter valid mobile no!';
}

/*check for dob*/
if($_POST['em_DOB']!=""){
          $em_DOB = mysqli_real_escape_string($dbc,$_POST['em_DOB']);
}else{
          $reg_errors['$em_DOB'] = 'Enter valid seat number!';
}

/*check for gender*/
if($_POST['em_gender']!=""){
          $em_gender = mysqli_real_escape_string($dbc,$_POST['em_gender']);
}else{
          $reg_errors['$em_gender'] = 'Enter gender!';
}

/*check for license*/
if($_POST['em_lno']!=""){
          $em_lno = mysqli_real_escape_string($dbc,$_POST['em_lno']);
}else{
          $reg_errors['$em_lno'] = 'Enter license no!';
}

/*check for aadhar*/
if($_POST['aadhar']!=""){
          $aadhar = mysqli_real_escape_string($dbc,$_POST['aadhar']);
}else{
          $reg_errors['aadhar'] = 'Enter aadhar no!';
}

/*check for car no*/
if($_POST['car_no']!=""){
          $car_no = mysqli_real_escape_string($dbc,$_POST['car_no']);
}else{
          $reg_errors['car_no'] = 'Enter car number!';
}


if(empty($reg_errors)){
          
		  $result = mysqli_query( $dbc , "SELECT em_lno FROM em_driver_detail WHERE em_lno= '$em_lno' LIMIT 0 , 30");
		  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		  $rows = mysqli_num_rows($result);
		  
		  if($rows==0){
		         $query = "INSERT INTO em_driver_detail(sp_id,em_name,em_lno,em_DOB,em_mno,em_gender,car_no,aadhar)VALUES('$sp_id','$em_name','$em_lno','$em_DOB','$em_mno','$em_gender','$car_no','$aadhar')";
		         $result = mysqli_query($dbc,$query);
				 
				 if(mysqli_affected_rows($dbc)==1){
				 header('Location:staffdetails.php');
				 }else{
				    if($rows==2){
					$reg_errors['em_lno'] = 'This driver is already registered.';
					}else{
				        $row = mysqli_fetch_array($result,MYSQLI_NUM);
						if($row[0]==$_POST['em_lno']){
					    $reg_errors['em_lno'] = 'This driver is already registered.';
					    }
					}	
				 }
		  }
}

}

?>
<!--Fleet details header-->
<div class="container-fluid">
<div class="row">
  <div class="col-md-3"><h2 class="ofm">OnlineFleetManager</h2></div>
  <div class="col-md-6"></div>
  <div class="col-md-3">
    <h2 class="ofm">StaffDetails</h2>
  </div>
</div>
</div>
<!--Fleet details header ends-->
<br>
<!--Database display starts-->
<div class="container-fluid" style="background:#ccffff;">
<?php

   $result = mysqli_query( $dbc , "SELECT em_name,em_mno,em_DOB,em_gender,em_lno,aadhar,car_no FROM em_driver_detail WHERE sp_id= '$sp_id' LIMIT 0 , 30");
		  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		  echo '<div class="table-responsive">
		  <table class="table table-hover">
                <caption style="color:black;text-align:center;">Driver Details</caption>
                <thead>
	            <tr>
		          <th>Name</th>
		          <th>Mobile No</th>
		          <th>Date of Birth</th>
				  <th>Gender</th>
		          <th>License No</th>
				  <th>Aadhar Card No</th>
				  <th>Car Number</th>
				  <th></th>
				  <th>Update</th>
				  <th>Delete</th>
	            </tr>
                </thead>'; 
		  while($row = mysqli_fetch_array($result)){
		  echo "<tbody>"; 
		  echo "<form action=staffdata.php method=POST>";
	      echo "<tr>";
		  echo "<td>" . "<input type=text name=em_name value=".$row['em_name']." size=20 </td>";
		  echo "<td>" . "<input type=text name=em_mno value=".$row['em_mno']." size=9 </td>";
		  echo "<td>" . "<input type=text name=em_DOB value=".$row['em_DOB']." size=9 </td>";
		  echo "<td>" . "<input type=text name=em_gender value=".$row['em_gender']." size=9 </td>";
	      echo "<td>" . "<input type=text name=em_lno value=".$row['em_lno']." size=9 </td>";
		  echo "<td>" . "<input type=text name=aadhar value=".$row['aadhar']." size=12 </td>";
	      echo "<td>" . "<input type=text name=car_no value=".$row['car_no']." size=9 </td>";
		  echo "<td>" . "<input type=hidden name=hidden value=".$row['em_lno']." </td>";
		  echo "<td>" . "<input class='btn btn-success' type=submit name=update value=Update </td>";
		  echo "<td>" . "<input class='btn btn-success' type=submit name=delete value=Delete </td>";
	      echo "</tr>";
		  echo "</form>";
          echo "</tbody>";
		  }
         echo '</table>';
         echo '</div>';
?>
</div>
<!--Database display ends-->
<br>
<!--Data Entry form begins-->
<div class="container-fluid" style="background:#99ccff">
<p>Enter all the details below.</p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><br>
<div class="row">

<div class="col-md-2">
    <label for="emname" class="control-label">Name</label>
</div>	

<div class="col-md-2">
	<input class="form-control" type="text" name="em_name" value="<?php if(isset($_POST['em_name']))echo htmlspecialchars($_POST['em_name'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$em_name', $reg_errors))echo $reg_errors['$em_name'];?>">
</div>

<div class="col-md-2">
    <label for="mobno" class="control-label">Mobile Number</label>
</div>

<div class="col-md-2">	
	<input class="form-control" type="text" name="em_mno" value="<?php if(isset($_POST['car_no']))echo htmlspecialchars($_POST['em_mno'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$em_mno', $reg_errors))echo $reg_errors['$em_mno'];?>">
</div>

<div class="col-md-2">
    <label for="dob" class="control-label">Date of Birth</label>
</div>

<div class="col-md-2">	
	<input class="form-control" type="date" name="em_DOB" value="<?php if(isset($_POST['em_DOB']))echo htmlspecialchars($_POST['em_DOB'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$em_DOB', $reg_errors))echo $reg_errors['$em_DOB'];?>">
</div>
</div>
<br>
<div class="row">

<div class="col-md-2">
    <label for="gender" class="control-label">Gender</label>
</div>	

<div class="col-md-2">
	<select class="form-control" name="em_gender">
		<option <?php if (isset($_POST['em_gender']) && $em_gender=="male") echo "checked";?> value="male">Male</option>
		<option <?php if (isset($_POST['em_gender']) && $em_gender=="female") echo "checked";?> value="female">Female</option>
		<option <?php if (isset($_POST['em_gender']) && $em_gender=="others") echo "checked";?> value="others">Others</option>
	</select>
</div>

<div class="col-md-2">
    <label for="license" class="control-label">License Number</label>
</div>

<div class="col-md-2">	
	<input class="form-control" type="text" name="em_lno" value="<?php if(isset($_POST['em_lno']))echo htmlspecialchars($_POST['em_lno'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$em_lno', $reg_errors))echo $reg_errors['$em_lno'];?>">
</div>

<div class="col-md-2">
    <label for="aadhar" class="control-label">Aadhar Card Number</label>
</div>

<div class="col-md-2">	
	<input class="form-control" type="text" name="aadhar" value="<?php if(isset($_POST['aadhar']))echo htmlspecialchars($_POST['aadhar'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$aadhar', $reg_errors))echo $reg_errors['$aadhar'];?>">
</div>
</div>
<br>
<div class="row">

<div class="col-md-2">
    <label for="carno" class="control-label">Car Number</label>
</div>	

<div class="col-md-2">	
	<input class="form-control" type="text" name="car_no" value="<?php if(isset($_POST['car_no']))echo htmlspecialchars($_POST['car_no'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$car_no', $reg_errors))echo $reg_errors['$car_no'];?>">
</div>

</div><br>
                <div class="row">
				<div class="col-md-6"></div>
                <div class="col-md-3">
                <input class="btn btn-primary" type="submit" id="register" name="register" style="text-align:center" value="Add"/>
                </div>
				<div class="col-md-3"></div>
                </div>
<br>
</form>
</div>
<!--Data Entry form ends--><br>
<?php
include('./includes/footer.html');
?>
