<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);
$reg_errors = array();
$booking_no = $_SESSION['booking_no'];
if($_SERVER['REQUEST_METHOD']=='POST')
{
require("yourEmail.php");
$emailTitle = "New Booking Detail"; 
$emailTitle_Customer = "Taxi Booking Detail"; //EMAIL TITLE CUSTOMER WILL SEE
$taxiName = mysqli_query( $dbc , "SELECT car_name FROM CAR_DETAIL , BOOKING_DETAIL WHERE BOOKING_DETAIL.carno = CAR_DETAIL.car_no "); //name of taxi booked
$taxiNo = mysqli_query( $dbc , "SELECT car_no FROM CAR_DETAIL , BOOKING_DETAIL ");


		$result = mysqli_query($db,"SELECT customer_eid , customer_mno , from_city, to_city , from_date , to_date , time_arr , time_ret FROM BOOKING_DETAIL WHERE booking_no = $booking_no");

		while($row = mysqli_fetch_array($result))
   		{
  		 if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		  echo '<table class="table table-hover">
                <caption style="color:black;text-align:center;">Booking Details</caption>
                <thead>
	            <tr>
		          <th>Customer Email-id</th>
		          <th>Mobile No</th>
		          <th>Place of Departure</th>
				  <th>Place of Return</th>
		          <th>Date of Departure</th>
				  <th>Date of Return</th>
				  <th>Time of Departure</th>
				  <th>Time of Return</th>
				  <th>Car Number</th>
	            </tr>
                </thead>'; 
		  while($row = mysqli_fetch_array($result)){
		  echo "<tbody>"; 
		  echo "<form action=booking_detail.php method=POST>";
	      echo "<tr>";
		  echo "<td>" . "<input type=text name=customer_eid  value=".$row['customer_eid']." size=20 </td>";
		  echo "<td>" . "<input type=text name=customer_mno value=".$row['customer_mno']." size=9 </td>";
		  echo "<td>" . "<input type=text name=from_city value=".$row['from_city']." size=9 </td>";
		  echo "<td>" . "<input type=text name=to_city value=".$row['to_city']." size=9 </td>";
	      echo "<td>" . "<input type=text name=from_date value=".$row['from_date']." size=9 </td>";
		  echo "<td>" . "<input type=text name=to_date value=".$row['to_date']." size=12 </td>";
		  echo "<td>" . "<input type=text name=time_arr value=".$row['time_arr']." size=9 </td>";
		  echo "<td>" . "<input type=text name=timr_ret value=".$row['time_ret']." size=12 </td>";
	      echo "<td>" . "<input type=text name=car_no value=".$row['car_no']." size=9 </td>";
	      echo "</tr>";
		  echo "</form>";
          echo "</tbody>";
		  }
         echo '</table>';
  		}

 
        $headers = "From: expresswaycabs@gmail.com" ."\r\n";
        $headers .= "Content-type: text/html\r\n";
        $success = mail("$yourEmail", "$emailTitle", "$body", "$headers");
        $message = '<div id="pmsg">Thank you for your order! There is only one more step!<br>Please send ' . $taxiFare . ' to <a href="bitcoin:' . $display_address .'?amount=' . $taxiFare . '&message=' . $taxiName . '">' . $display_address . '</a><br>We have emailed you this information if you have to pay later.</div>';
         
        $custEmail = <<<EOD
        <h3>Please send payment to finalize your purchase</h3>
        Payment Address: $display_address <br>
        Payment Amount: $taxiFare <br>
        Item Purchased: $taxiName <br>
        Booking No : $booking_no <br>
        Email: $customer_email <br>
        Mobile No: $customer_mno <br>
        City of Departure: $from_city <br>
        City of Return: $to_city <br>
        Date of Departurn : $from_date <br>
        Date of Return : $to_date <br>
        Time of Departurn : $time_arr <br>
        Time of Return : $time_ret <br>
                
EOD;
        mail($customer_eid, $emailTitle_Customer, $custEmail, $headers);
}

?>

<?php
include('./includes/footer.html');
?>
