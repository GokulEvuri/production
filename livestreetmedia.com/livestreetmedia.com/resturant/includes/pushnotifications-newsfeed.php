<?php 
//	include_once($_SERVER['DOCUMENT_ROOT'].'/resturant/variables/variables.php');
	include_once('connect_database.php');

$sql_query = "SELECT Devises
				FROM tbl_customers";

$result = $connect->query($sql_query) or die ("Error :".mysql_error());
	 
			$registrationIDs  = array();
			while($newsfeed = $result->fetch_assoc()) {
				$newsfeeds[] = array(
					$newsfeed['Devises']
					);
			}

echo $registrationIDs;
/*$sql = mysql_query($sql_query);
$registrationIDs = array();
	while($row = mysql_fetch_array($sql))
	{
  		$results[] = array(
		$row['Devises']
 	  );
	}*/

// Set POST variables
$url = 'https://android.googleapis.com/gcm/send';



$sql_query = "SELECT ID, heading, link, t_stamp 
				FROM tbl_newsfeed";
				
			$result = $connect->query($sql_query) or die ("Error :".mysql_error());
	 
			$newsfeed = array();
			while($newsfeed = $result->fetch_assoc()) {
				$newsfeeds[] = array(
					'ID' => $newsfeed['ID'],
					'heading'=>$newsfeed['heading'],
					'link' => $newsfeed['link'],
					't_stamp' => $newsfeed['t_stamp']
					);
			}
	


$fields = array(
                'registration_ids'  => $registrationIDs,
                'data'              => $newsfeeds ,
                );

$headers = array( 
                    'Authorization: key=' . $apiKey_gcm,
                    'Content-Type: application/json'
                );

// Open connection
$ch = curl_init();

// Set the url, number of POST vars, POST data
curl_setopt( $ch, CURLOPT_URL, $url_gcm );

curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

// Execute post
$result = curl_exec($ch);

if($result){
	echo "Sent push notifications";
}

// Close connection
curl_close($ch);

?>