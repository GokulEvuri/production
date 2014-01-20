<?php
	include_once('../../includes/connect_database.php'); 
	include_once('../../variables/variables.php');
	
	if(isset($_POST['accesskey']) && isset($_POST['username'])&& isset($_POST['password'])&& isset($_POST['email'])) {
		$access_key_received = $_POST['accesskey'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$email =  $_POST['email'];

		if($access_key_received == $access_key){
				// find menu by category id in menu table
				$sql_query = "SELECT * FROM tbl_customers WHERE UserName = '$username'";
				$result = $connect->query($sql_query) or die("Error : ".mysql_error());
	
			if(empty($result->num_rows)){
					
				// create new user
			$sql_query = "INSERT INTO tbl_customers (UserName,Password,Email) VALLUES ('$username','$password','$email')";
				$result = $connect->query($sql_query) or die("Error : ".mysql_error());
	
			}
			else{
				echo "Requested user name is unavailable";
			}

		}else{
			die('accesskey is incorrect.');
		}
	} else {
		die('accesskey, username, password and email are required.');
	}
	include_once('../includes/close_database.php'); 
?>