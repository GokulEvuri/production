<?php
	include_once('../includes/connect_database.php'); 
	include_once('../variables/variables.php');
	

	if(isset($_GET['accesskey'])&& isset($_GET['username'])) {
		$access_key_received = $_GET['accesskey'];
		$username = $_GET['username'];

		if($access_key_received == $access_key){
			// get menu data from menu table
			$sql_query = "SELECT ID, UserName, Number_of_people, Date_n_time, Order_list, Status 
				FROM tbl_reservation WHERE UserName='$username'";
				
			$result = $connect->query($sql_query) or die ("Error :".mysql_error());
	 
			$newsfeed = array();
			while($newsfeed = $result->fetch_assoc()) {
				$newsfeeds[] = array(
					'ID' => $newsfeed['ID'],
					'Number_of_people' => $newsfeed['Number_of_people'],
					'Date_n_time'=>$newsfeed['Date_n_time'],
					'Order_list' => $newsfeed['Order_list'],
					'Status' => $newsfeed['Status']
					);
			}
		 
			// create json output
			$output = json_encode( $newsfeeds);
		}else{
			die('accesskey is incorrect.');
		}
	} else {
		die('accesskey is required.');
	}
 
	//Output the output.
	echo $output;

	include_once('../includes/close_database.php'); 
?>