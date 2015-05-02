<?php
require('./includes/config.inc.php');
include('./includes/header1.html');
require(MYSQL);
$reg_errors = array();
$sp_id = $_SESSION['sp_id'];
if($_SERVER['REQUEST_METHOD']=='POST'){

/*check for car no*/
if($_POST['car_no']!=""){
          $car_no = mysqli_real_escape_string($dbc,$_POST['car_no']);
}else{
          $reg_errors['$car_no'] = 'Enter valid car number!';
}

/*check for car type*/
if($_POST['car_type']!=""){
          $car_type = mysqli_real_escape_string($dbc,$_POST['car_type']);
}else{
          $reg_errors['$car_type'] = 'Enter valid car model!';
}

/*check for no of seats*/
if($_POST['car_cap']!=""){
          $car_cap = mysqli_real_escape_string($dbc,$_POST['car_cap']);
}else{
          $reg_errors['$car_cap'] = 'Enter valid seat number!';
}

/*check for no of cars*/
if($_POST['car_pool']!=""){
          $car_pool = mysqli_real_escape_string($dbc,$_POST['car_pool']);
}else{
          $reg_errors['$car_pool'] = 'Enter yes or no!';
}

/*check for price/km*/
if($_POST['price_km']!=""){
          $price_km = mysqli_real_escape_string($dbc,$_POST['price_km']);
}else{
          $reg_errors['$price_km'] = 'Enter price/km!';
}

/*check for waiting charges*/
if($_POST['waiting_hr']!=""){
          $waiting_hr = mysqli_real_escape_string($dbc,$_POST['waiting_hr']);
}else{
          $reg_errors['$waiting_hr'] = 'Enter waiting charges!';
}

if(empty($reg_errors)){
          
		  $result = mysqli_query( $dbc , "SELECT car_no FROM car_detail WHERE car_no= '$car_no' LIMIT 0 , 30");
		  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		  $rows = mysqli_num_rows($result);
		  
		  if($rows==0){
		         $query = "INSERT INTO car_detail(sp_id,car_type,car_cap,car_no,available,price_km,waiting_hr,car_pool,returning)VALUES('$sp_id','$car_type','$car_cap','$car_no','yes','$price_km','$waiting_hr','$car_pool','yes')";
		         $result = mysqli_query($dbc,$query);
				 
				 if(mysqli_affected_rows($dbc)==1){
				 header('Location:fleetdetails.php');
				 }else{
				    if($rows==2){
					$reg_errors['car_no'] = 'This car is already registered.';
					}else{
				        $row = mysqli_fetch_array($result,MYSQLI_NUM);
						if($row[0]==$_POST['car_no']){
					    $reg_errors['car_no'] = 'This car is already registered.';
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
    <h2 class="ofm">FleetDetails</h2>
  </div>
</div>
</div>
<!--Fleet details header ends-->
<br>
<!--Database display starts-->
<div class="container-fluid" style="background:#ccffff;">
<?php


   $result = mysqli_query( $dbc , "SELECT car_no,car_type,car_cap,car_pool,price_km,waiting_hr FROM car_detail WHERE sp_id= '$sp_id' LIMIT 0 , 30");
		  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		  echo '<table class="table table-hover">
                <caption style="color:black;text-align:center;">Car Details</caption>
                <thead>
	            <tr>
		          <th>Car Number</th>
		          <th>Car Model</th>
		          <th>No of Seats</th>
				  <th>Allow Carpool</th>
		          <th>Price/KM</th>
				  <th>Waiting Charges/HR</th>
				  <th></th>
				  <th>Update</th>
				  <th>Delete</th>
	            </tr>
                </thead>'; 
		  while($row = mysqli_fetch_array($result)){
		  echo "<tbody>"; 
		  echo "<form action=fleetdata.php method=POST>";
	      echo "<tr>";
		  echo "<td>" . "<input type=text name=car_no value=".$row['car_no']." size=20 </td>";
		  echo "<td>" . "<input type=text name=car_type value=".$row['car_type']." size=9 </td>";
		  echo "<td>" . "<input type=text name=car_cap value=".$row['car_cap']." size=9 </td>";
		  echo "<td>" . "<input type=text name=car_pool value=".$row['car_pool']." size=9 </td>";
	      echo "<td>" . "<input type=text name=price_km value=".$row['price_km']." size=9 </td>";
		  echo "<td>" . "<input type=text name=waiting_hr value=".$row['waiting_hr']." size=12 </td>";
		  echo "<td>" . "<input type=hidden name=hidden value=".$row['car_no']." </td>";
		  echo "<td>" . "<input class='btn btn-success' type=submit name=updateCar value=Update </td>";
		  echo "<td>" . "<input class='btn btn-success' type=submit name=deleteCar value=Delete </td>";
	      echo "</tr>";
		  echo "</form>";
          echo "</tbody>";
		  }
         echo '</table>';
?>
</div>
<!--Database display ends-->
<br>
<!--Data Entry form begins-->
<div class="container-fluid" style="background:#99ccff">
<p>Enter all the details below.</p>
<form method="POST"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"><br>
<div class="row">

<div class="col-md-2">
    <label for="carno" class="control-label">Car Number</label>
</div>	

<div class="col-md-2">
	<input class="form-control" type="text" name="car_no" value="<?php if(isset($_POST['car_no']))echo htmlspecialchars($_POST['car_no'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$car_no', $reg_errors))echo $reg_errors['$car_no'];?>">
</div>

<div class="col-md-2">
    <label for="carmodel" class="control-label">Car Model</label>
</div>

<div class="col-md-2">	
	<input class="form-control" type="text" name="car_type" value="<?php if(isset($_POST['car_type']))echo htmlspecialchars($_POST['car_type'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$car_type', $reg_errors))echo $reg_errors['$car_type'];?>">
</div>

<div class="col-md-2">
    <label for="carcapacity" class="control-label">No. of Seats</label>
</div>

<div class="col-md-2">	
	<input class="form-control" type="text" name="car_cap" value="<?php if(isset($_POST['car_cap']))echo htmlspecialchars($_POST['car_cap'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$car_cap', $reg_errors))echo $reg_errors['$car_cap'];?>">
</div>
</div>
<br>
<div class="row">

<div class="col-md-2">
    <label for="carpool" class="control-label">Allow Carpool</label>
</div>	

<div class="col-md-2">
	<select class="form-control" name="car_pool" placeholder="<?php if (array_key_exists('$car_pool', $reg_errors))echo $reg_errors['$car_pool'];?>">
		<option <?php if (isset($_POST['car_pool']) && $car_pool=="yes") echo "checked";?> value="yes">Yes</option>
		<option <?php if (isset($_POST['car_pool']) && $car_pool=="no") echo "checked";?> value="no">No</option>
	</select>
</div>

<div class="col-md-2">
    <label for="price/km" class="control-label">Price/KM</label>
</div>

<div class="col-md-2">	
	<input class="form-control" type="text" name="price_km" value="<?php if(isset($_POST['price_km']))echo htmlspecialchars($_POST['price_km'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$price_km', $reg_errors))echo $reg_errors['$price_km'];?>">
</div>

<div class="col-md-2">
    <label for="waiting charges" class="control-label">Waiting Charges/HR</label>
</div>

<div class="col-md-2">	
	<input class="form-control" type="text" name="waiting_hr" value="<?php if(isset($_POST['waiting_hr']))echo htmlspecialchars($_POST['waiting_hr'])?>" autocomplete="off" placeholder="<?php if (array_key_exists('$waiting_hr', $reg_errors))echo $reg_errors['$waiting_hr'];?>">
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
<!--Data Entry form ends-->
<br>
<?php
include('./includes/footer.html');
?>
