<?php 
	include_once('../../includes/connect_database.php'); 
	include_once('../../variables/variables.php');
//var_dump($_REQUEST);
//print_r($_POST);
//print_r($_GET);
if(isset($_POST["username"])){ 

    $username = strtolower($_POST['username']); 
    $password = $_POST['password'];
    $sql_query = "SELECT * FROM tbl_customers  
        WHERE UserName= ? AND 
        Password= ? 
        LIMIT 1";
    $stmt = $connect->stmt_init();
    if($stmt->prepare($sql_query)) {
				// Bind your variables to replace the ?s
				$stmt->bind_param('ss', $username, $password);
				// Execute query
				$stmt->execute();
				/* store result */
				$stmt->store_result();
				$num = $stmt->num_rows;
				// Close statement object
				$stmt->close();
				if($num == 1){
					$_SESSION['user'] = $username;
					echo "ok";
				}else{
				 echo "failed";
					$error['failed'] = "*Login failed.";
				}
			}
}else{
        echo "failed";
   	exit; 
}
 include_once('../../includes/close_database.php');

?>