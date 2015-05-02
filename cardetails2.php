<?php
require('./includes/config.inc.php');
include('./includes/header2.html');
require(MYSQL);
?>
<div class="container-fluid" style="background:#ccffff;">
<?php
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

 $result = mysqli_query( $dbc , "SELECT sp.sp_name,cd.car_type,cd.seats_available,cd.car_no,cd.price_km,cd.waiting_hr FROM service_provider AS sp JOIN car_detail AS cd ON sp.sp_id = cd.sp_id WHERE (sp.sp_city='$from_city' OR cd.route_id='$route_id' OR cd.retRoute_id='$retRoute_id') AND cd.car_cap>='$no_of_pass' AND cd.available='yes' AND cd.car_pool='no'");
		  if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
 echo '<table class="table table-hover">
                <caption style="color:black;text-align:center;">Book Your Car</caption>
                <thead>
	            <tr>
		          <th>Taxi Company</th>
		          <th>Taxi Model</th>
		          <th>No of Seats</th>
				  <th>Car Number</th>
				  <th>Price/KM</th>
		          <th>Waiting Charges/HR</th>
				  <th></th>
				  <th>Book</th>
	            </tr>
                </thead>'; 
		  while($row = mysqli_fetch_array($result)){
		  echo "<tbody>"; 
		  echo "<form action=booking_page.php method=POST>";
	      echo "<tr>";
		  echo "<td>" . "<input type=text name=sp_name value=".$row['sp_name']." size=20 </td>";
		  echo "<td>" . "<input type=text name=car_type value=".$row['car_type']." size=9 </td>";
		  echo "<td>" . "<input type=text name=seats_available value=".$row['seats_available']." size=9 </td>";
		  echo "<td>" . "<input type=text name=car_no value=".$row['car_no']." size=9 </td>";
	      echo "<td>" . "<input type=text name=price_km value=".$row['price_km']." size=9 </td>";
		  echo "<td>" . "<input type=text name=waiting_hr value=".$row['waiting_hr']." size=12 </td>";
		  echo "<td>" . "<input type=hidden name=hidden value=".$row['car_no']." </td>";
		  echo "<td>" . "<input class='btn btn-success' type=submit name=Book value=Book </td>";
	      echo "</tr>";
		  echo "</form>";
          echo "</tbody>";
		  }
         echo '</table>';
?>
</div>
