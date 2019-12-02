<?php

$current_url = $_GET["url"];

if(isset( $_POST['fname']))
    $fname = $_POST['fname'];
if(isset( $_POST['lname']))
    $lname = $_POST['lname'];
if(isset( $_POST['email']))
    $email = $_POST['email'];
if(isset( $_POST['phone']))
    $phone = $_POST['phone'];
if(isset( $_POST['message']))
    $comment = $_POST['message'];


$subject = 'Website Contact Form Submission';





$mailheader .= "From: postmaster@southerntechfusion.com \r\n";
$mailheader .= "MIME-Version: 1.0\r\n";
$mailheader .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



$message = '<html><body>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Name:</strong></td><td > $fname $lname </td></tr>";
$message .= "<tr><td><strong>Email:</strong></td><td > $email </td></tr>";
$message .= "<tr><td><strong>Phone Number:</strong></td><td > $phone </td></tr>";

if (isset( $_POST['mealplanchk']) || isset( $_POST['challengchk']) || isset( $_POST['cateringchk']) || isset( $_POST['dessertschk'])){

    if(isset( $_POST['mealplanchk']))
        $mealplanchk = 'Meal Plans <br/>';
    if(isset( $_POST['challengchk']))
        $challengchk = 'Challenges <br/>';
    if(isset( $_POST['cateringchk']))
        $cateringchk = 'Catering <br/>';
    if(isset( $_POST['dessertschk']))
        $dessertschk = 'Desserts';

    $message .= "<tr><td><strong>Service Interest:</strong></td><td> $mealplanchk $challengchk $cateringchk $dessertschk </td></tr>";
}

$message .= "<tr><td><strong>Message:</strong></td><td > $comment </td></tr>";
$message .= "</table>";
$message .= "</body></html>";

$recipient = "perfectlyplated18@gmail.com" ;

mail($recipient, $subject, $message, $mailheader) or die("Error!");

header('Location: ' . $current_url);
?>