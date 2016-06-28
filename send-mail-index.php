<?php
session_start();
require_once 'class.user.php';
$user_home=new User();

$contactUsName  = trim($_POST['contact-us-name']);
$contactUsEmail = trim($_POST['contact-us-email']);
$contactUsText  = trim($_POST['contact-us-message']);

$to = "abhishek0647@gmail.com";
$subject = "GasMarket Support";
$txt = $contactUsText."\n\nThanks & Regards,\n".$contactUsName;
//$headers = "From: abhishek0647@gmail.com";
$headers = "From: ".$contactUsEmail;

mail($to,$subject,$txt,$headers);

$user_home->redirect('index.php?status=success');
?>
