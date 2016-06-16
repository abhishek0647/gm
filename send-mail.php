<?php
$to = "abhishek0647@gmail.com";
$subject = "Testing Email";
$txt = "Hello world!";
$headers = "From: abhishek0647@gmail.com";

mail($to,$subject,$txt,$headers);
?>
