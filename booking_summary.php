<?php
require('./includes/config.inc.php');
include('./includes/header2.html');
require(MYSQL);?>

<?php
$booking_no = $_SESSION['booking_no'];
$car_no = $_SESSION['car_no'];

$result = mysqli_query( $dbc , "SELECT sp_name FROM service_provider WHERE (sp_id=(SELECT sp_id FROM car_detail WHERE car_no='$car_no'))");
$row = mysqli_fetch_array($result);
$sp_name = $row['sp_name'];//name of taxi booked


$result = mysqli_query($dbc,"SELECT bk.customer_eid,bk.customer_mno,sc.from_city,sc.to_city,bk.date_of_dept,bk.time_of_dept,bk.car_no FROM booking_detail as bk JOIN search_criteria as sc on bk.route_id=sc.route_id AND bk.customer_eid=sc.customer_eid WHERE bk.booking_no='$booking_no'");
          if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		while($row = mysqli_fetch_array($result))
   		{
  		 
		  echo '<table class="table table-hover" style="background:white">
                <caption style="color:chartreuse;text-align:center;"><h3>Booking Details</h3></caption>
                <thead>
	            <tr>
		          <th>Customer Email-id</th>
		          <th>Mobile No</th>
		          <th>Place of Departure</th>
				  <th>Place of Arrival</th>
		          <th>Date of Departure</th>
				  <th>Time of Departure</th>
				  <th>Car Number</th>
	            </tr>
                </thead>'; 
		  while($row = mysqli_fetch_array($result)){
		  echo "<tbody>"; 
	      echo "<tr>";
		  echo "<td>" .$row['customer_eid']. "</td>";
		  echo "<td>" .$row['customer_mno']. "</td>";
		  echo "<td>" .$row['from_city']. "</td>";
		  echo "<td>" .$row['to_city']. "</td>";
	      echo "<td>" .$row['date_of_dept']. "</td>";
		  echo "<td>" .$row['time_of_dept']. "</td>";
	      echo "<td>" .$row['car_no']. "</td>";
	      echo "</tr>";
		  echo "</form>";
          echo "</tbody>";
		  }
         echo '</table>';
  		}
          
		
		$customer_eid = $row['customer_eid'];
		$customer_mno = $row['customer_mno'];
		$from_city = $row['from_city'];
		$to_city = $row['to_city'];
		$date_of_dept = $row['date_of_dept'];
		$time_of_dept = $row['time_of_dept'];
		
		
		
		$result = mysqli_query($dbc,"SELECT em_name,em_mno,em_lno FROM em_driver_detail WHERE car_no='$car_no'");
		$row = mysqli_fetch_array($result);
        $em_name = $row['em_name'];
		$em_mno = $row['em_mno'];
		$em_lno = $row['em_lno'];
?>
<div class="row">
<form action="mailto:">
<input class='btn btn-success' type=submit name=confirm value=Confirm>
</div>		
