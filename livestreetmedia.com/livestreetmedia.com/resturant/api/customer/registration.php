<?php
	include_once('../../includes/connect_database.php'); 
	include_once('../../variables/variables.php');
	
	if(isset($_GET['accesskey']) && isset($_GET['username'])&& isset($_GET['password'])&& isset($_GET['email'])) {
		$access_key_received = $_GET['accesskey'];
		$username = $_GET['username'];
		$password = $_GET['password'];
		$email =  $_GET['email'];

		if($access_key_received == $access_key){
				// find menu by category id in menu table
				$sql_query = "SELECT * FROM tbl_customers WHERE UserName = '$username'";
				$result = $connect->query($sql_query) or die("Error : ".mysql_error());
			echo $result->num_rows;
			if($result->num_rows == 0){
					echo "Insert here";
				// create new user
			$sql_query = "INSERT INTO tbl_customers (UserName,Password,Email) VALUES ('$username','$password','$email')";
			
			$result = $connect->query($sql_query) or die("Error : ".mysql_error());
		
			echo $result;
			
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
	include_once('../../includes/close_database.php'); 
?>