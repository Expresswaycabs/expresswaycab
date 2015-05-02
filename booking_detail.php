<?php
require('./includes/config.inc.php');
include('./includes/header2.html');
require(MYSQL);
$reg_errors = array();
$booking_no = $_SESSION['booking_no'];
$car_no = $_SESSION['car_no'];

$url = "https://btc-e.com/api/2/btc_usd/ticker";
$json = json_decode(file_get_contents($url), true);
$price = $json["ticker"]["last"];
$rupPrice = 20; 
$calc = $rupPrice / $price;
$taxiFare = round($calc, 4);
require("yourEmail.php");
$emailTitle = "New Booking Detail"; 
$emailTitle_Customer = "Taxi Booking Detail"; //EMAIL TITLE CUSTOMER WILL SEE

$result = mysqli_query( $dbc , "SELECT sp_name FROM service_provider WHERE (sp_id=(SELECT sp_id FROM car_detail WHERE car_no='$car_no'))");
$row = mysqli_fetch_array($result);
$taxiName = $row[0];//name of taxi booked


$Result = mysqli_query( $dbc , "SELECT car_no FROM booking_detail WHERE car_no='$car_no'");
$row = mysqli_fetch_array($Result);
$taxiNo = $row[0];

//CREATE UNIQUE BITCOIN ADDRESS FOR PAYMENT
require("bitcoinpayment_addr.php");
        $new_address = "https://blockchain.info/merchant/$id/new_address?password=$pw";
 
        $json_new_addr = json_decode(file_get_contents($new_address), true);
        $display_address = $json_new_addr['address'];
		$result = mysqli_query($dbc,"SELECT bk.customer_eid,bk.customer_mno,sc.from_city,sc.to_city,bk.date_of_dept,bk.time_of_dept,bk.car_no FROM booking_detail as bk JOIN search_criteria as sc on bk.route_id=sc.route_id AND bk.customer_eid=sc.customer_eid WHERE bk.booking_no='$booking_no'");
          if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
		while($row = mysqli_fetch_array($result))
   		{
  		 
		  echo '<table class="table table-hover">
                <caption style="color:black;text-align:center;">Booking Details</caption>
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
		  echo "<form action=booking_detail.php method=POST>";
	      echo "<tr>";
		  echo "<td>" . "<input type=text name=customer_eid  value=".$row['customer_eid']." size=20 </td>";
		  echo "<td>" . "<input type=text name=customer_mno value=".$row['customer_mno']." size=9 </td>";
		  echo "<td>" . "<input type=text name=from_city value=".$row['from_city']." size=9 </td>";
		  echo "<td>" . "<input type=text name=to_city value=".$row['to_city']." size=9 </td>";
	      echo "<td>" . "<input type=text name=from_date value=".$row['date_of_dept']." size=9 </td>";
		  echo "<td>" . "<input type=text name=time_arr value=".$row['time_of_dept']." size=9 </td>";
	      echo "<td>" . "<input type=text name=car_no value=".$row['car_no']." size=9 </td>";
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
		$car_no = $row['car_no'];
		
		
        $body = "Hi";
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
        Email: $customer_eid <br>
        Mobile No: $customer_mno <br>
        City of Departure: $from_city <br>
        City of Return: $to_city <br>
        Date of Departure : $date_of_dept <br>
        Time of Departure : $time_of_dept <br>
                
EOD;
        $customerCopy = mail($customer_eid, $emailTitle_Customer, $custEmail, $headers);

?>

<?php
include('./includes/footer.html');
?>
