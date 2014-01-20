<?php
	include_once('connect_database.php'); 
	include_once('functions.php'); 
?>
<div id="content">
	<?php 
	
		if(isset($_GET['id'])){
			$ID = $_GET['id'];
		}else{
			$ID = "";
		}
		
		// create array variable to store category data
		$category_data = array();
			
					
		if(isset($_POST['btnEdit'])){
			
			$heading = $_POST['heading'];
			$link = $_POST['link'];
			
				
			// create array variable to handle error
			$error = array();
			
			if(empty($heading)){
				$error['heading'] = "*Heading should be filled.";
			}
								
			if(empty($link)){
				$error['link'] = "*Link should be filled.";
			}
			
			
					
			if(!empty($heading) && !empty($link)){
				

					
					// updating all data except image file
					$sql_query = "UPDATE tbl_newsfeed
							SET heading = ? , link = ? , t_stamp = ? WHERE ID = ?";
							
					$stmt = $connect->stmt_init();
					if($stmt->prepare($sql_query)) {	
						$t_s = timestamp;
						// Bind your variables to replace the ?s
						$stmt->bind_param('ssss', 
									$heading, 
									$link,
									$t_s,
									$ID);
						// Execute query
						$stmt->execute();
						// store result 
						$update_result = $stmt->store_result();
						$stmt->close();
					}
					
				// check update result
				if($update_result){
					$error['update_data'] = "*News Feed has been successfully updated.";
				}else{
					$error['update_data'] = "*Failed updating News Feed.";
				}
			}
			
		}
		
		// create array variable to store previous data
		$data = array();
			
		$sql_query = "SELECT * FROM tbl_newsfeed WHERE ID = ?";
			
		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {	
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $ID);
			// Execute query
			$stmt->execute();
			// store result 
			$stmt->store_result();
			$stmt->bind_result( 
					$data['ID'],
					$data['heading'], 
					$data['link'],
					$data['timestamp']
					);
			$stmt->fetch();
			$stmt->close();
		}
		
			
	?>
	<h1>Edit Menu</h1>
	<hr />
	<form method="post"
		enctype="multipart/form-data">
		<p>News Feed:</p>
		
		<input type="text" name="heading" value="<?php echo $data['heading']; ?>"/>
		<p class="alert"><?php echo isset($error['heading']) ? $error['link'] : '';?></p>
		
		<input type="text" name="link" value="<?php echo $data['link']; ?>" />
		<p class="alert"><?php echo isset($error['link']) ? $error['link'] : '';?></p>
	    
	    <input type="submit" value="Submit" name="btnEdit" />
		<p class="alert"><?php echo isset($error['update_data']) ? $error['update_data'] : '';?></p>
	</form>
	<div class="separator"> </div>
	</div>

<?php 
//	$stmt_category->close();
	include_once('close_database.php'); ?>