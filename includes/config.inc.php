<?php

/*define live and contact email for error handling*/
$live = false;
$contact_email = 'expresswaycabs@gmail.com';

/*define the constants*/
define('BASE_URI','C:/xampp/htdocs/ExpresswayCabs.com/expresswaycabs');
define('BASE_URL','www.expresswaycab.com');
define('MYSQL','C:/xampp/htdocs/ExpresswayCabs.com/mysql.inc.php');

/*start session to track logged-in users*/
session_start();

/*define an error-handling function*/
function my_error_handler($e_number,$e_message,$e_file,$e_line,$e_vars){
    global $live,$contact_email;
	$message="An error occurred in script '$e_file' on line $e_line: \n$e_message\n"; //detailed error message
	$message.="<pre>".print_r(debug_backtrace(),1)."</pre>\n";
	
	/*if site isn't live, show error message in the browser*/
    if(!$live){
	   echo '<div class="error">'.nl2br($message).'</div>';
	}else{
	   error_log($message,1,$contact_email,'From:admin@expresswaycab.com');
	   if($e_number!=E_NOTICE){
	      echo '<div class="error">A system error occurred.We apologise for the inconvenience.</div>';
	   }
	  return true; 
	}
}
 
/*applying error handler*/
set_error_handler('my_error_handler'); 

function redirect_invalid_user($check = 'customer_eid',$destination = 'index.php',$protocol = 'http://'){
      if(!isset($_SESSION[$check])){
	      $url = $protocol.BASE_URL.$destination;
		  header("Location:url");
		  exit();
	  }
}

function redirect_invalid_serviceprovider($check = 'sp_eid',$destination = 'index.php',$protocol = 'http://'){
      if(!isset($_SESSION[$check])){
	      $url = $protocol.BASE_URL.$destination;
		  header("Location:url");
		  exit();
	  }
}