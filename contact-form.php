<?php
error_reporting(0);
ini_set('display_errors', 0);
    $subject = $_POST['name']." - Contact Form";

    $message = "<b>Name : ".$_POST['name']."</b></br>";
    $message .= "<b>Email : ".$_POST['email']."</b></br>";
    $message .= "<b>Subject : ".$_POST['subject']."</b></br>";
    $message .= "<b>Message : ".$_POST['message']."</b></br>";

    $header = "From:noreply@souparnikahealth.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $email = "care@souparnikahealth.com";
    $retval = mail ($email,$subject,$message,$header);
    if( $retval == true ) {
        echo "<script>alert('Thank you, Your message have been received. We will contact you as soon as possible.');
        window.location.href = 'contact.html';</script>";
    }
    else
    {
        echo "<script>alert('Something went wrong !');
        window.location.href = 'contact.html';</script>";
    }
?>