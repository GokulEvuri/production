<?php	include_once('includes/connect_database.php');

$sql_query = "SELECT Devises
				FROM tbl_customers";

$result = $connect->query($sql_query) or die ("Error :".mysql_error());
	 
			$registrationIDs  = array();
			while($registrationID = $result->fetch_assoc()) {
				$registrationIDs[] = array(
					$registrationID['Devises']
					);
			}
//echo $result;
print_r( $registrationIDs);

echo "  ";

$sql_query = "SELECT ID, heading, link, t_stamp 
				FROM tbl_newsfeed";
				
			$result = $connect->query($sql_query) or die ("Error :".mysql_error());
	 
			$newsfeeds = array();
			while($newsfeed = $result->fetch_assoc()) {
				$newsfeeds[] = array(
					$newsfeed['ID'],
					$newsfeed['heading'],
					$newsfeed['link'],
					$newsfeed['t_stamp']
					);
			}

//	print_r($newsfeeds);



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
else {
	echo "Couldn't Send push notifications";	
}

print_r($fields);
print_r($headers);
//echo $result;

// Close connection
curl_close($ch);


?>