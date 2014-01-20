<?php
	include_once('connect_database.php'); 
	include_once('functions.php'); 
?>
<div id="content">
	<?php 
	
		if(isset($_GET['id'])&& isset($_GET['validity'])){
			$ID = $_GET['id'];
			$validity = 1;
			if($_GET['validity']==1){
			$validity = 0;
			}else{
				$validity = 1;
			}
					// updating all data except image file
					$sql_query = "UPDATE tbl_coupons
							SET validity =  ? WHERE ID = ?";
							
					$stmt = $connect->stmt_init();
					if($stmt->prepare($sql_query)) {	
						$t_s = timestamp;
						// Bind your variables to replace the ?s
						$stmt->bind_param('ss', 
									$validity, 
									$ID);
						// Execute query
						$stmt->execute();
						// store result 
						$update_result = $stmt->store_result();
						$stmt->close();
					}
					
				// check update result
				if($update_result){
					$error['update_data'] = "*Coupon has been successfully updated.";
				}else{
					$error['update_data'] = "*Failed updating coupon.";
				}

		}else{
			$error['update_data'] = "*Failed updating coupon.";

		}
			
	include_once('close_database.php');
	?>