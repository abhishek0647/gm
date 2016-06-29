<?php
error_reporting(0);

session_start();
require_once 'class.user.php';
$user_home=new User();

$email = trim($_POST['txtemail']);

$stmt = $user_home->runQuery("SELECT * FROM tbl_users WHERE userEmail=:email_id");
$stmt->execute(array(":email_id"=>$email));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if($stmt->rowCount() == 1) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randstring = '';
	for ($i = 0; $i < 10; $i++) {
		$randstring .= $characters[rand(0, strlen($characters))];
	}

	$password = md5($randstring);

	$passUpdate = $user_home->runQuery("UPDATE tbl_users SET userPass=:user_pass WHERE userEmail=:user_email_id");
	$passUpdate->execute(array(":user_pass"=>$password, ":user_email_id"=>$email));

	$contactUsName  = "GasMarket Support Team";
	$contactUsText  = trim($_POST['contact-us-message']);

	$to = "abhishek0647@gmail.com";
	$subject = "GasMarket Support";
	$txt = $contactUsText."\n\nThanks & Regards,\n".$contactUsName;
	//$headers = "From: abhishek0647@gmail.com";
	$headers = "From: ".$contactUsEmail;

	mail($to,$subject,$txt,$headers);

	$user_home->redirect('forgot-password.php?status=success');
}
else {
	$user_home->redirect('forgot-password.php?status=noUserFound')
}
?>
