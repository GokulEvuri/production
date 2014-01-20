<?php
// TODO
// 		Contact Info

	// database configuration
	$host ="localhost";
	$user ="worldhotells_res";
	$pass ="hello";
	$database = "worldhotells_res";
	$connect = new mysqli($host, $user, $pass,$database) or die("Error : ".mysql_error());
	
	$apiKey_gcm = "AIzaSyA9k_ILMHXWvJzMIWtfn_xc1SKVXRqmMN0";
	$url_gcm = 'https://android.googleapis.com/gcm/send';
	// access key to access API
	$access_key = "12345";
	
	// google play url
	$gplay_url = "https://play.google.com/store/apps/details?id=your.package.com";
	
	// email configuration
	$admin_email = "contact@cnss.se";
	$email_subject = "The Restaurant App: Information Email";
	$change_message = "You have change your admin info such as email and or password.";
	$reset_message = "Your new password is ";
	
	// reservation notification configuration
	$reservation_subject = "The Restaurant App: New Reservation";
	$reservation_message = "There is new reservation. please check it on admin page.";
	
	// copyright
	$copyright = "The Restaurant App &copy; 2014 CNSS. All rights reserved.";
?>