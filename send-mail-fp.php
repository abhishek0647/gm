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

	$upass = md5($randstring);

	$passUpdate = $user_home->runQuery("UPDATE tbl_users SET userPass=:user_pass WHERE userEmail=:user_email_id");
	$passUpdate->execute(array(":user_pass"=>$upass, ":user_email_id"=>$email));

	$to = $email;
	$subject = "GasMarket Support";
	$txt = "Hi ".$email."\n\nYour new password is ".$randstring."\n\n Please reach out to us if you are facing any issues\n\nThanks & Regards,\nGasMarket Support Team";
	//$headers = "From: abhishek0647@gmail.com";
	$headers = "From: abhishek0647@gmail.com";

	mail($to,$subject,$txt,$headers);

	$user_home->redirect('forgot-password.php?status=success');
}
else {
	$user_home->redirect('forgot-password.php?status=noUserFound');
}
?>
