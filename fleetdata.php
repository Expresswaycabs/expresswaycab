<?php
require('./includes/config.inc.php');
require(MYSQL);

if(isset($_POST['updateCar'])){
$query = " UPDATE car_detail SET car_no='$_POST[car_no]',car_type='$_POST[car_type]',car_cap='$_POST[car_cap]',car_pool='$_POST[car_pool]',price_km='$_POST[price_km]',waiting_hr='$_POST[waiting_hr]' WHERE car_no='$_POST[hidden]' ";
$result=mysqli_query($dbc,$query);
 if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
  header("Location:fleetdetails.php");		   
};

if(isset($_POST['deleteCar'])){
$query = " DELETE FROM car_detail  WHERE car_no='$_POST[hidden]' ";
$result=mysqli_query($dbc,$query);
 if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
  header("Location:fleetdetails.php");		   
};
?>
