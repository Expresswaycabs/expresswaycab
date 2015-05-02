<?php require('./includes/config.inc.php');
require(MYSQL);?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
     <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
	 <meta name="viewport" content="width=device-width, initial-scale=1"/>
	 <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
	 <title>Book Cabs Online</title>
	 <link rel="shortcut icon" href="images/favicon.ico">
	 <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="css/styles.css">
	 <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
     <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	 <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&language=hi"></script>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px;
		height:300px;	
      }
	   @media screen and (max-width:767px){
	      .logo,.needaride,.row,.ofm{
		   text-align:center;
		   }
	   }
	   @media screen and (min-width:768px){
	      .logo,.needaride,.row,.ofm{
		  text-align:center;
		  }
	   }
	   @media screen and (min-width:992px){
	      .logo,.needaride,.row,.ofm{
		  align-content:center;
		  }
	   }
	   @media projection and (min-width:1200px){
	      .logo,.needaride,.row,.ofm{
		  text-align:center;
		  }
	   }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true"></script>
    <script>
var map;
var geocoder;
var bounds = new google.maps.LatLngBounds();
var markersArray = [];

var destinationIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=D|FF0000|000000';
var originIcon = 'https://chart.googleapis.com/chart?chst=d_map_pin_letter&chld=O|FFFF00|000000';
var directionsDisplay;
var directionsService = new google.maps.DirectionsService();
function initialize() {
directionsDisplay = new google.maps.DirectionsRenderer();
  var mapOptions = {
    center: new google.maps.LatLng(12.97159, 77.5945),
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.SATELLITE,
    heading: 90,
    tilt: 45
  };
  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  directionsDisplay.setMap(map);
  directionsDisplay.setPanel(document.getElementById("directionsPanel"));
  geocoder = new google.maps.Geocoder();
   google.maps.event.addListener(map, 'click', function(e) {
    placeMarker(e.latLng, map);
  });
}

function calcRoute() {
  var start = document.getElementById("start").value;
  var end = document.getElementById("end").value;
  var request = {
    origin:start,
    destination:end,
    travelMode: google.maps.TravelMode.DRIVING
  };
  directionsService.route(request, function(result, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(result);
    }
  });
}

function calculateDistances() {
  var service = new google.maps.DistanceMatrixService();
  service.getDistanceMatrix(
    {
      origins: start,
      destinations: end,
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, callback);
}

function callback(response, status) {
  if (status != google.maps.DistanceMatrixStatus.OK) {
    alert('Error was: ' + status);
  } else {
    var origins = response.originAddresses;
    var destinations = response.destinationAddresses;
    var outputDiv = document.getElementById('outputDiv');
    outputDiv.innerHTML = '';
    deleteOverlays();

    for (var i = 0; i < origins.length; i++) {
      var results = response.rows[i].elements;
      addMarker(origins[i], false);
      for (var j = 0; j < results.length; j++) {
        addMarker(destinations[j], true);
        outputDiv.innerHTML += origins[i] + ' to ' + destinations[j]
            + ': ' + results[j].distance.text + ' in '
            + results[j].duration.text + '<br>';
      }
    }
  }
}

function placeMarker(location, isDestination) {
var marker = new google.maps.Marker({
    location: start,
    isDestination: end
  });
  isDestination.panTo(location);
  var icon;
  if (isDestination) {
    icon = destinationIcon;
  } else {
    icon = originIcon;
  }
  geocoder.geocode({'address': location}, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      bounds.extend(results[0].geometry.location);
      map.fitBounds(bounds);
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location,
        icon: icon
      });
      markersArray.push(marker);
    } else {
      alert('Geocode was not successful for the following reason: '
        + status);
    }
  });
}
function deleteOverlays() {
  for (var i = 0; i < markersArray.length; i++) {
    markersArray[i].setMap(null);
  }
  markersArray = [];
}

function rotate90() {
  var heading = map.getHeading() || 0;
  map.setHeading(heading + 90);
}

function autoRotate() {
  // Determine if we're showing aerial imagery
  if (map.getTilt() != 0) {
    window.setInterval(rotate90, 3000);
  }
}

google.maps.event.addDomListener(window, 'load', initialize);

    </script>
	
	<script>
	   function enable_box(status)
       {	
	      document.getElementById("date_ret").disabled = !status.checked;
		  document.getElementById("time_ret").disabled = !status.checked;
       }
	   
	   function disable_box(status)
       {	
	      document.getElementById("date_ret").disabled = status.checked;
		  document.getElementById("time_ret").disabled = status.checked;
       }
	</script>
  </head>
  
  
 <body style="background:url('images/background.jpg');">
 
<?php
 $reg_errors = array();
 $customer_eid = $_SESSION['customer_eid'];
 if($_SERVER['REQUEST_METHOD']=='POST'){

/*check for return*/
if($_POST['returning']!=""){
          $returning = mysqli_real_escape_string($dbc,$_POST['returning']);
}else{
          $reg_errors['$returning'] = 'No value!';
}

/*check for carpooling*/
if($_POST['carpooling']!=""){
          $carpooling = mysqli_real_escape_string($dbc,$_POST['carpooling']);
}else{
          $reg_errors['$carpooling'] = 'No value!';
}

/*check for from_city*/
if($_POST['from_city']!=""){
          $from_city = mysqli_real_escape_string($dbc,$_POST['from_city']);
}else{
          $reg_errors['$from_city'] = 'No value!';
}

/*check for to_city*/
if($_POST['to_city']!=""){
          $to_city = mysqli_real_escape_string($dbc,$_POST['to_city']);
}else{
          $reg_errors['$to_city'] = 'No value!';
}

/*check for date_arr*/
if($_POST['date_arr']!=""){
          $date_arr = mysqli_real_escape_string($dbc,$_POST['date_arr']);
}else{
          $reg_errors['$date_arr'] = 'No value!';
}

/*check for time_arr*/
if($_POST['time_arr']!=""){
          $time_arr = mysqli_real_escape_string($dbc,$_POST['time_arr']);
}else{
          $reg_errors['$time_arr'] = 'No value!';
}

/*check for date_ret*/
if(isset($_POST['date_ret'])){
          $date_ret = mysqli_real_escape_string($dbc,$_POST['date_ret']);
}else
	      $date_ret = "00-00-0000";
/*check for time_arr*/
if(isset($_POST['time_ret'])){
          $time_ret = mysqli_real_escape_string($dbc,$_POST['time_ret']);
}else
	      $time_ret = "00:00:00";

/*check for time_arr*/
if($_POST['no_of_pass']!=""){
          $no_of_pass = mysqli_real_escape_string($dbc,$_POST['no_of_pass']);
}else{
          $reg_errors['$no_of_pass'] = 'No value!';
}
if(empty($reg_errors)){
    $routeQuery = "SELECT route_id FROM places WHERE from_city='$from_city' AND to_city='$to_city'";
    $routeResult = mysqli_query($dbc,$routeQuery);
	if($routeResult==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
    $row = mysqli_fetch_array($routeResult);
    $route_id = $row['route_id'];
	
	
	$from_place = $to_city;
	$to_place = $from_city;
	
	
	$retRouteQuery = "SELECT retRoute_id FROM places WHERE from_city='$from_city' AND to_city='$to_city'";
    $retRouteResult = mysqli_query($dbc,$retRouteQuery);
	if($retRouteResult==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }
    $row = mysqli_fetch_array($retRouteResult);
    $retRoute_id = $row['retRoute_id'];
	

	if($carpooling=='yes' && $returning=='no')
	{
		$status_no = 4;
	}
    else if($carpooling=='no' && $returning=='yes')
    {
		$status_no = 3;
	}		
	else if($carpooling=='yes' && $returning=='yes')
	{
		$status_no = 5;
	}	
	else 
	{
		$status_no = 2;
	}
	    
        $_SESSION['returning'] = $returning;
        $_SESSION['carpooling'] = $carpooling;		
        $_SESSION['from_city'] = $from_city;
        $_SESSION['to_city'] = $to_city;
        $_SESSION['no_of_pass'] = $no_of_pass;
        $_SESSION['date_arr'] = $date_arr;
		$_SESSION['time_arr'] = $time_arr;
		$_SESSION['date_ret'] = $date_ret;
		$_SESSION['time_ret'] = $time_ret;
		$_SESSION['route_id'] = $route_id;
		$_SESSION['retRoute_id'] = $retRoute_id;
		$_SESSION['status_no'] = $status_no;
	
    $query = "INSERT INTO search_criteria(returning,carpooling,from_city,to_city,date_arr,time_arr,date_ret,time_ret,no_of_pass,customer_eid,route_id,status_no)VALUES('$returning','$carpooling','$from_city','$to_city','$date_arr','$time_arr','$date_ret','$time_ret','$no_of_pass','$customer_eid','$route_id','$status_no')";
    $result = mysqli_query($dbc,$query);
    if($result==FALSE) {
           die('Invalid query: ' . mysqli_error($dbc));
           }	
    if(mysqli_affected_rows($dbc)==1){
       
	
	if($carpooling = 'yes'){		
	    echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cabdetails1.php">';    
        exit;
	}else{
		echo '<META HTTP-EQUIV="Refresh" Content="0; URL=cabdetails2.php">';    
        exit;
	}
	}

}
}
?>
 
 
 
 
 
 <div id="wrap">
	   <div class="header">
	      <!--TITLE-->
	      <img src="images/logo.png" class="img-responsive center-block" alt="no img" width="70" height="70">
	      <h1 class="logo">ExpresswayCabs</h1>
	      <!--END TITLE-->
	   </div>
	   
	   <!-- NAVIGATION BAR-->
	   <nav class="navbar navbar-inverse">
       <div class="container-fluid">
          <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>                        
          </button>
          <a class="navbar-brand" href="#">ExpresswayCabs</a>
          </div>
		  
          <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="customer_login.php">Get A Cab</a></li>
            <li><a href="serviceprovider_login.php">Online Fleet Manager</a></li>
            <li><a href="about.php">About Us</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="customer_registration.php"><span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['customer_name']?></a></li>
            <li><a href="customer_logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
          </div>
       </div>
       </nav>
	   </div>
<div id="map-canvas" style="width:100%; height:100%"></div>   

<div>
<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<!--Search criteria-->
<div class="searchcriteria">
<div class="container-fluid">

<!--Radio Button-->
<div class="row">

<div class="col-md-4">
<label> 
<input type="radio" name="returning" <?php if (isset($_POST['returning']) && $returning=="no") echo "checked";?> value="no" onClick=disable_box(this)>Oneway Trip 
</label>
</div>

<div class="col-md-4">
<label> 
<input type="radio" name="returning" <?php if (isset($_POST['returning']) && $returning=="yes") echo "checked";?> value="yes" onClick=enable_box(this)>Round Trip 
</label>
</div>

<div class="col-md-4"> 
</div>
</div>
<!--Radio Button ends-->
<br>
<!--Departure and Arrival cities-->
<div class="row">

<div class="col-md-3">
    <label for="origin" class="control-label">From</label>
</div>	

<div class="col-md-3">	
	<select class="form-control" id="start" name="from_city" onchange="calcRoute();">
  <option <?php if (isset($_POST['from_city']) && $from_city=="Bengaluru, Karnataka") echo "checked";?>value="Bengaluru, Karnataka">Bengaluru</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Kochi, Kerala") echo "checked";?>value="Kochi, Kerala">Kochi, Kerala</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Belagavi, Karnataka") echo "checked";?>value="Belagavi, Karnataka">Belagavi, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Chennai, Tamil Nadu") echo "checked";?>value="Chennai, Tamil Nadu">Chennai, Tamil Nadu</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Mangalore, Karnataka") echo "checked";?>value="Mangalore, Karnataka">Mangalore, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Hyderabad, Telangana") echo "checked";?>value="Hyderabad, Telangana">Hyderabad, Telangana</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Panaji, Goa") echo "checked";?>value="Panaji, Goa">Panaji, Goa</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Hampi, Karnataka") echo "checked";?>value="Hampi, Karnataka 583239">Hampi, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Davangere, Karnataka") echo "checked";?>value="Davangere, Karnataka">Davangere, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Hubli, Karnataka") echo "checked";?>value="Hubli, Karnataka">Hubli, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Krishnagiri, Tamil Nadu") echo "checked";?>value="Krishnagiri, Tamil Nadu">Krishnagiri, Tamil Nadu</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Vellore, Tamil Nadu") echo "checked";?>value="Vellore, Tamil Nadu">Vellore, Tamil Nadu</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Chitradurga, Karnataka") echo "checked";?>value="Chitradurga, Karnataka">Chitradurga, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Tumakuru, Karnataka") echo "checked";?>value="Tumakuru, Karnataka">Tumakuru, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Hassan, Karnataka") echo "checked";?>value="Hassan, Karnataka">Hassan, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Belur, Karnataka") echo "checked";?>value="Belur, Karnataka">Belur, Karnataka</option>
  <option <?php if (isset($_POST['from_city']) && $from_city=="Mysuru, Karnataka") echo "checked";?>value="Mysuru, Karnataka">Mysuru, Karnataka</option>
</select>
</div>

<div class="col-md-3">
    <label for="origin" class="control-label">To</label>
</div>

<div class="col-md-3">	
	<select class="form-control" id="end" name="to_city" onchange="calcRoute();">
  <option <?php if (isset($_POST['to_city']) && $to_city=="Bengaluru, Karnataka") echo "checked";?>value="Bengaluru, Karnataka">Bengaluru</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Kochi, Kerala") echo "checked";?>value="Kochi, Kerala">Kochi, Kerala</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Belagavi, Karnataka") echo "checked";?>value="Belagavi, Karnataka">Belagavi, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Chennai, Tamil Nadu") echo "checked";?>value="Chennai, Tamil Nadu">Chennai, Tamil Nadu</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Mangalore, Karnataka") echo "checked";?>value="Mangalore, Karnataka">Mangalore, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Hyderabad, Telangana") echo "checked";?>value="Hyderabad, Telangana">Hyderabad, Telangana</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Panaji, Goa") echo "checked";?>value="Panaji, Goa">Panaji, Goa</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Hampi, Karnataka") echo "checked";?>value="Hampi, Karnataka 583239">Hampi, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Davangere, Karnataka") echo "checked";?>value="Davangere, Karnataka">Davangere, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Hubli, Karnataka") echo "checked";?>value="Hubli, Karnataka">Hubli, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Krishnagiri, Tamil Nadu") echo "checked";?>value="Krishnagiri, Tamil Nadu">Krishnagiri, Tamil Nadu</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Vellore, Tamil Nadu") echo "checked";?>value="Vellore, Tamil Nadu">Vellore, Tamil Nadu</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Chitradurga, Karnataka") echo "checked";?>value="Chitradurga, Karnataka">Chitradurga, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Tumakuru, Karnataka") echo "checked";?>value="Tumakuru, Karnataka">Tumakuru, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Hassan, Karnataka") echo "checked";?>value="Hassan, Karnataka">Hassan, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Belur, Karnataka") echo "checked";?>value="Belur, Karnataka">Belur, Karnataka</option>
  <option <?php if (isset($_POST['to_city']) && $to_city=="Mysuru, Karnataka") echo "checked";?>value="Mysuru, Karnataka">Mysuru, Karnataka</option>
</select>
</div>

</div>
<!--Departure and Arrival cities ends-->
<br>
<!--Pickup Time and Date-->
<div class="row">

<div class="col-md-3">
    <label for="origin" class="control-label">Pick-up Date</label>
</div>	

<div class="col-md-3">
	<input class="form-control" type="date" name="date_arr" value="<?php if(isset($_POST['date_arr']))echo htmlspecialchars($_POST['date_arr'])?>" autocomplete="off">
</div>

<div class="col-md-3">
    <label for="origin" class="control-label">Pick-up Time</label>
</div>

<div class="col-md-3">	
	<input class="form-control" type="time" name="time_arr" value="<?php if(isset($_POST['time_arr']))echo htmlspecialchars($_POST['time_arr'])?>" autocomplete="off">
</div>

</div>
<!--Pickup Time and Date Ends-->
<br>
<!--Return Time and Date-->
<div class="row">

<div class="col-md-3">
    <label for="origin" class="control-label">Return Date</label>
</div>	

<div class="col-md-3">
	<input class="form-control" type="date" name="date_ret" id="date_ret" value="<?php if(isset($_POST['date_ret']))echo htmlspecialchars($_POST['date_ret'])?>" autocomplete="off" disabled>
</div>

<div class="col-md-3">
    <label for="origin" class="control-label">Return Time</label>
</div>

<div class="col-md-3">	
	<input class="form-control" type="time" name="time_ret" id="time_ret" value="<?php if(isset($_POST['time_ret']))echo htmlspecialchars($_POST['time_ret'])?>" autocomplete="off" disabled>
</div>

</div>
<!--Return Time and Date Ends-->
<br>
<!--No. of passengers-->
<div class="row">
<div class="col-md-3">
    <label for="origin" class="control-label">No. of Passengers</label>
</div>

<div class="col-md-3">	
	<input class="form-control" type="text" name="no_of_pass" value="<?php if(isset($_POST['no_of_pass']))echo htmlspecialchars($_POST['no_of_pass'])?>" autocomplete="off">
</div>
<div class="col-md-3"><label for="carpool" class="control-label">Carpooling</label></div>
<div class="col-md-3">
<select class="form-control" id="carpooling" name="carpooling">
  <option <?php if (isset($_POST['carpooling']) && $carpooling=="Yes") echo "checked";?>value="yes">Yes</option>
  <option <?php if (isset($_POST['carpooling']) && $carpooling=="No") echo "checked";?>value="no">No</option>
</div>
</div>
<!--No. of passengers ends-->
<br><br>
<!--Search Button-->
<div class="row">
<div class="col-md-12">
<input class="btn btn-warning" type="submit" name="search" id="srchbutton" value="SEARCH CABS" style="align-content:center"/>
</div>
</div>
<span><?php if (array_key_exists('$returning', $reg_errors))echo $reg_errors['$returning'];?></span>
<span><?php if (array_key_exists('$carpooling', $reg_errors))echo $reg_errors['$carpooling'];?></span>
<span><?php if (array_key_exists('$from_city', $reg_errors))echo $reg_errors['$from_city'];?></span>
<span><?php if (array_key_exists('$to_city', $reg_errors))echo $reg_errors['$to_city'];?></span>
<span><?php if (array_key_exists('$date_arr', $reg_errors))echo $reg_errors['$date_arr'];?></span>
<span><?php if (array_key_exists('$time_arr', $reg_errors))echo $reg_errors['$time_arr'];?></span>
<span><?php if (array_key_exists('$date_ret', $reg_errors))echo $reg_errors['$date_ret'];?></span>
<span><?php if (array_key_exists('$time_ret', $reg_errors))echo $reg_errors['$time_ret'];?></span>
<span><?php if (array_key_exists('$no_of_pass', $reg_errors))echo $reg_errors['$no_of_pass'];?></span>
</div>
</div></form>
<!--Search criteria ends--><br>
</div>
<div class="directionpanel">
 <div class="container">
<div id="directionsPanel" style="width:45%;height 100%"></div>
</div></div>
  </body>
<?php
include('./includes/footer.html');
?>  
</html>
