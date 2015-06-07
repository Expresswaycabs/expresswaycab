<?php
require('./includes/config.inc.php');
include('./includes/header.html');
require(MYSQL);

if($_SERVER['REQUEST_METHOD']=='POST'){
 $cust_eid = mysqli_real_escape_string($dbc,$_POST['cust_eid']);
 $cust_name = mysqli_real_escape_string($dbc,$_POST['cust_name']);
 $experience = mysqli_real_escape_string($dbc,$_POST['experience']);
 $complaints = mysqli_real_escape_string($dbc,$_POST['complaints']);
 $questions = mysqli_real_escape_string($dbc,$_POST['questions']);
 $suggestions = mysqli_real_escape_string($dbc,$_POST['suggestions']); 
$query = "INSERT INTO feedback(cust_eid,cust_name,experience,complaints,questions,suggestions)VALUES('$cust_eid','$cust_name','$experience','$complaints','$questions','$suggestions')";
$result = mysqli_query($dbc,$query);
if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }				 
if(mysqli_affected_rows($dbc)==1){
header('Location:index.php');
}
}
?>
<div class="container-fluid">
<div class="ofm"><h2>CustomerFeedback</h2></div> 
</div>
<div class="container-fluid" style="background:#ffffcc;text-align:center;">
<br><br>
<form action="feedback.php" method="post">


<label for="fullname" class= "control-label" style="text-align:right">Full Name</label>
<br><div class="col-md-5"></div>
<div class="col-md-2">
<input class="form-control" type="text" name="cust_name" value="<?php if(isset($_POST['cust_name']))echo htmlspecialchars($_POST['cust_name'])?>" autocomplete="off">
</div><div class="col-md-5"></div>
<br><br>

<label for="email" class="control-label" style="text-align:right">Email ID</label><br>
<div class="col-md-5"></div>
<div class="col-md-2">
<input class="form-control" type="email" name="cust_eid" value="<?php if(isset($_POST['cust_eid']))echo htmlspecialchars($_POST['cust_eid'])?>" autocomplete="off">
</div><div class="col-md-5"></div>
<br><br>
<label for="address" class="control-label" style="text-align:right">How was your experience with ExpresswayCabs?</label><br>
<div>
<textarea rows="6" cols="33" name="experience" style="color:black;" value="<?php if(isset($_POST['experience']))echo htmlspecialchars($_POST['experience'])?>" autocomplete="off"></textarea>
</div>
<br>
<label for="address" class="control-label" style="text-align:right">Any Complaints?</label><br>
<div>
<textarea rows="6" cols="33" name="complaints" style="color:black;" value="<?php if(isset($_POST['complaints']))echo htmlspecialchars($_POST['complaints'])?>" autocomplete="off"></textarea>
</div>
<br>
<label for="address" class="control-label" style="text-align:right">Any Questions?</label><br>
<div>
<textarea rows="6" cols="33" name="questions" style="color:black;" value="<?php if(isset($_POST['questions']))echo htmlspecialchars($_POST['questions'])?>" autocomplete="off"></textarea>
</div>
<br>
<label for="address" class="control-label" style="text-align:right">Any Suggestions?</label><br>
<div>
<textarea rows="6" cols="33" name="suggestions" style="color:black;" value="<?php if(isset($_POST['suggestions']))echo htmlspecialchars($_POST['suggestions'])?>" autocomplete="off"></textarea>
</div>

  <div class="row">
				<div class="col-md-5"></div>
                <div class="col-md-2">
                <input class="btn btn-primary" type="submit" name="go" style="text-align:center" value="Submit"/>
                </div>
				<div class="col-md-5"></div>
                </div>
<br>
</form>
</div><br>
<?php
include('./includes/footer.html');
?>
