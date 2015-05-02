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

/*check for route_id*/
if($_POST['route_id']!=""){
          $route_id = mysqli_real_escape_string($dbc,$_POST['route_id']);
}else{
          $reg_errors['$route_id'] = 'Enter operation route!';
}

if(empty($reg_errors)){
          
		  $result = mysqli_query( $dbc , "SELECT car_no FROM car_detail WHERE car_no= '$car_no' LIMIT 0 , 30");
		  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		  $rows = mysqli_num_rows($result);
		  
		  if($rows==0){
		         $query = "INSERT INTO car_detail(sp_id,car_type,car_cap,seats_available,car_no,available,price_km,waiting_hr,car_pool,returning,route_id)VALUES('$sp_id','$car_type','$car_cap','$car_cap','$car_no','yes','$price_km','$waiting_hr','$car_pool','yes','$route_id')";
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

<div class="col-md-2">
    <label for="route_id" class="control-label">Operation Route</label>
</div>	

<div class="col-md-2">	
	<select class="form-control" name="route_id" placeholder="<?php if (array_key_exists('$route_id', $reg_errors))echo $reg_errors['$route_id'];?>">
		<option <?php if (isset($_POST['route_id']) && $route_id==1) echo "checked";?> value="1">Bengaluru-Kochi</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==2) echo "checked";?> value="2">Bengaluru-Belagavi</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==3) echo "checked";?> value="3">Bengaluru-Chennai</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==4) echo "checked";?> value="4">Bengaluru-Mangalore</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==5) echo "checked";?> value="5">Bengaluru-Hyderabad</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==6) echo "checked";?> value="6">Bengaluru-Panaji</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==7) echo "checked";?> value="7">Bengaluru-Hampi</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==8) echo "checked";?> value="8">Bengaluru-Davangere</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==9) echo "checked";?> value="9">Bengaluru-Hubli</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==10) echo "checked";?> value="10">Bengaluru-Krishnagiri</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==11) echo "checked";?> value="11">Bengaluru-Vellore</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==12) echo "checked";?> value="12">Bengaluru-Chitradurga</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==13) echo "checked";?> value="13">Bengaluru-Tumakuru</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==14) echo "checked";?> value="14">Bengaluru-Hassan</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==16) echo "checked";?> value="15">Bengaluru-Belur</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==17) echo "checked";?> value="16">Bengaluru-Mysuru</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==18) echo "checked";?> value="17">Kochi-Belagavi</option>
		<option <?php if (isset($_POST['route_id']) && $route_id==19) echo "checked";?> value="18">Kochi-Chennai</option>
	</select>
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
