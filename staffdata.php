<?php
require('./includes/config.inc.php');
require(MYSQL);
if(isset($_POST['update'])){
$updateQuery = " UPDATE em_driver_detail SET em_name='$_POST[em_name]',em_mno='$_POST[em_mno]',em_DOB='$_POST[em_DOB]',em_gender='$_POST[em_gender]',em_lno='$_POST[em_lno]',aadhar='$_POST[aadhar]',car_no='$_POST[car_no]' WHERE em_lno='$_POST[hidden]' ";
$updateResult=mysqli_query($dbc,$updateQuery);
 if($updateResult==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
  header("Location:staffdetails.php");		   
};

if(isset($_POST['delete'])){
$deleteQuery = " DELETE FROM em_driver_detail  WHERE em_lno='$_POST[hidden]' ";
$deleteResult=mysqli_query($dbc,$deleteQuery);
 if($deleteResult==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
  header("Location:staffdetails.php");		   
};
?>
