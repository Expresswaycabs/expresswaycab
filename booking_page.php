<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);
?>
<div class="container-fluid" style="background:#ccffff;">
<?php
		if(isset($_POST['Book'])){
			$car_no = $_POST['car_no'];
        $_SESSION['car_no'] = $car_no; }
        if($status_no==2)
		{ 
			header("Location:booking_detail.php");
		}	
		else if($status_no==3)
		{
			header("Location:booking_detail.php");
		}	
		else if($status_no==4){
		 if(isset($_POST['Book'])){	
			while($_POST['seats_available']>=$no_of_pass)
			{
				$_POST['seats_available'] = $_POST['seats_available'] - $no_of_pass;
				$updateQuery = " UPDATE car_detail SET seats_available='$_POST['seats_available'] WHERE car_no='$_POST['hidden'] ";
				$result=mysqli_query($dbc,$updateQuery);
				if($result==FALSE) {
                    die('Invalid query: ' . mysqli_error($dbc));
                 }
			}
            if($_POST['seats_available']==$no_of_pass)
            {
				$updateQuery = " UPDATE car_detail SET available='no' WHERE car_no='$_POST['hidden]' ";
				$result=mysqli_query($dbc,$updateQuery);
				 if($result==FALSE) {
                    die('Invalid query: ' . mysqli_error($dbc));
                 }
		    }
            			
			echo '<META HTTP-EQUIV="Refresh" Content="0; URL="booking_details.php">';    
        exit;
		 }	
		}
		else if($status_no==5){
			header("Location:bookingpage.php");
		}
?>
</div>
