<?php
require('./includes/config.inc.php');
include('./includes/header2.html');
require(MYSQL);
?>
<?php   
        $customer_eid = $_SESSION['customer_eid'];
		$customer_id = $_SESSION['customer_id'];
        $returning = $_SESSION['returning'];
        $carpooling = $_SESSION['carpooling'];		
        $from_city = $_SESSION['from_city'];
        $to_city = $_SESSION['to_city'];
        $no_of_pass = $_SESSION['no_of_pass'];
        $date_arr = $_SESSION['date_arr'];
		$time_arr = $_SESSION['time_arr'];
		$date_ret = $_SESSION['date_ret'];
		$time_ret = $_SESSION['time_ret'];
		$route_id = $_SESSION['route_id'];
		$retRoute_id = $_SESSION['retRoute_id'];
		$status_no = $_SESSION['status_no'];
		$car_no = $_SESSION['car_no'];
$book_errors = array();
if($_SERVER['REQUEST_METHOD']=='POST'){

if(!empty($_POST['passenger_name'])){
      $passenger_name = mysqli_real_escape_string($dbc,$_POST['passenger_name']);
}else{
      $book_errors['passenger_name'] = 'Enter your name!';
}

		
if(!empty($_POST['customer_mno'])){
      $customer_mno = mysqli_real_escape_string($dbc,$_POST['customer_mno']);
}else{
      $book_errors['customer_mno'] = 'Enter your mobile no!';
}
		
if(empty($book_errors)){
      $query = "INSERT INTO booking_detail(passenger_name,no_of_pass,customer_id,customer_eid,customer_mno,car_no,status_no,time_of_booking,date_of_dept,time_of_dept,route_id,retRoute_id) VALUES ('$passenger_name','$no_of_pass','$customer_id','$customer_eid','$customer_mno','$car_no','$status_no','NOW()','$date_arr','$time_arr','$route_id','$retRoute_id') ";
	  $result = mysqli_query($dbc,$query);
	  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
      
	  if(mysqli_affected_rows($dbc)==1){
      $query = "SELECT booking_no FROM booking_detail WHERE car_no='$car_no'";
	  $result = mysqli_query($dbc,$query);
	  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
	  $row = mysqli_fetch_array($result);
      $booking_no = $row['booking_no'];	   
      $_SESSION['booking_no'] = $booking_no;		   
	  
       if($status_no==2)
		{
            $query = "INSERT INTO status_detail_2(route_id,status_no,car_no,booking_no) VALUES ('$route_id','$status_no','$car_no','$booking_no') ";
			$result = mysqli_query($dbc,$query);
			if($result==FALSE) {
              die('Invalid query: ' . mysqli_error($dbc));
           }
		}	
		else if($status_no==3)
		{
            $query = "INSERT INTO status_detail_3(route_id,status_no,car_no,booking_no,retRoute_id) VALUES ('$route_id','$status_no','$car_no','$booking_no','$retRoute_id')";
			$result = mysqli_query($dbc,$query);
			if($result==FALSE) {
               die('Invalid query: ' . mysqli_error($dbc));
           }
		}	
		else if($status_no==4){
			
		 	$query = "INSERT INTO status_detail_4(route_id,status_no,car_no,booking_no) VALUES ('$route_id','$status_no','$car_no','$booking_no') ";
			$result = mysqli_query($dbc,$query);
			if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		}
		else if($status_no==5){
			
			$query = "INSERT INTO status_detail_5(route_id,status_no,car_no,booking_no,retRoute_id) VALUES ('$route_id','$status_no','$car_no','$booking_no','$retRoute_id')";
			$result = mysqli_query($dbc,$query);
			if($result==FALSE) {
               die('Invalid query: ' . mysqli_error($dbc));
           }
		}
		
		header("Location:booking_detail.php");
	  }
}	
}		
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
<div class="container-fluid">
<div class="loginform" style="height:300px">
<br><br><br>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
<input class="form-control" type="text" name="passenger_name" id="cust_em" value="<?php if(isset($_POST['passenger_name']))echo htmlspecialchars($_POST['passenger_name'])?>" autocomplete="off" placeholder="Enter Passenger's Name"></div>
<span class="error"><?php if (array_key_exists('$passenger_name', $book_errors))echo $book_errors['$passenger_name']?></span>
</div><br>

<div class="row">
<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
<input class="form-control" type="text" name="customer_mno" id="cust_pwd" value="<?php if(isset($_POST['customer_mno']))echo htmlspecialchars($_POST['customer_mno'])?>" autocomplete="off" placeholder="Enter Mobile No"></div>
<span class="error"><?php if (array_key_exists('$customer_mno', $book_errors))echo $book_errors['$customer_mno']?></span>
</div><br><br><br>

<div class="row">
<button type="submit" class="btn btn-success" id="logbtn">Confirm Booking</button>
</div><br><br>

</form> 

</div>
</div><br><br><br><br><br>
<?php
include('./includes/footer.html');
?>
</body>
</html>
