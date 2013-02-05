<?php
function choosefunction(){

sendform();
}



function sendform(){

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$subject = $_POST['subject'];
$enquiry = $_POST['enquiry'];

$message = 'Name: ' .  $name . "\r\n"; 
$message .= 'Email: ' . $email . "\r\n";
$message .= 'Phone: ' .  $phone . "\r\n";
$message .= 'Enquiry: '.  $enquiry . "\r\n";


//$headers  = 'MIME-Version: 1.0' . "\r\n
//$headers = 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

//$to = 'kamaulynder@yahoo.com, clientservices@ibidlabs.com';
$to = 'info@pizzainn.com';

$headers = 'From: ' . $name . '<' . $email .'>' . "\r\n";
$headers .= "Return-Path: kamaulynder@yahoo.com\r\n";
if(mail($to, $subject, $message, $headers)){
	echo "<br><br>Your message has been sent. Someone from Pizza inn will get back to you as soon as possible";
}


}



?>
