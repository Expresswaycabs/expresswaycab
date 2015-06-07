<?php 
if(isset($_POST['submit'])){
    $to = $_POST['email']; // this is your Email address
    $from = "expresswaycabs@gmail.com"; // this is the sender's Email address
    $subject = "Booking Confirmation";
    $subject2 = "Copy of booking confirmation";
    $message = "Your taxi has been booked. You'll receive all the details about the cab and the driver in a while.";
    $message2 = "Here is a copy of your message ";

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
    mail($to,$subject,$message,$headers);
    mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender
    echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    // You can also use header('Location: thank_you.php'); to redirect to another page.
    // You cannot use header and echo together. It's one or the other.
    }
?>
