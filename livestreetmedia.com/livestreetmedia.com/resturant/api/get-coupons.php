<?php
	include_once('../includes/connect_database.php'); 
	include_once('../variables/variables.php');
	

	if(isset($_GET['accesskey'])) {
		$access_key_received = $_GET['accesskey'];

		if($access_key_received == $access_key){
			// get menu data from menu table
			$sql_query = "SELECT ID, description, validity
				FROM tbl_coupons WHERE validity=0";
				
			$result = $connect->query($sql_query) or die ("Error :".mysql_error());
	 
			$newsfeed = array();
			while($newsfeed = $result->fetch_assoc()) {
				$newsfeeds[] = array(
					'ID' => $newsfeed['ID'],
					'Description' => $newsfeed['description']
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