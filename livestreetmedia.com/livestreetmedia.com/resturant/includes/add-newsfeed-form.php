<?php
	include_once('connect_database.php'); 
	include_once('functions.php'); 	
	error_reporting(E_ALL ^ E_STRICT);
?>
<div id="content">
	<?php 
		$sql_query = "SELECT ID, heading, link 
			FROM tbl_newsfeed 
			ORDER BY ID ASC";
				
		$stmt_category = $connect->stmt_init();
		if($stmt_category->prepare($sql_query)) {	
			// Execute query
			$stmt_category->execute();
			// store result 
			$stmt_category->store_result();
			$stmt_category->bind_result($category_data['ID'],$category_data['heading'], 
				$category_data['link']
				);		
		}
		
			
		if(isset($_POST['btnAdd'])){
			$heading = $_POST['heading'];
			$link = $_POST['link'];
			
				

			// create array variable to handle error
			$error = array();
			
			if(empty($heading)){
				$error['heading'] = "*Heading should be filled.";
			}
				
			if(empty($link)){
				$error['link'] = "*Link should be selected.";
			}				
				
			if(!empty($heading) && !empty($link) ){
				
				$sql_query = "INSERT INTO tbl_newsfeed (heading, link)
						VALUES(?, ?)";
						
				$stmt = $connect->stmt_init();
				if($stmt->prepare($sql_query)) {	
					// Bind your variables to replace the ?s
					$stmt->bind_param('ss', 
								$heading, 
								$link
								);
					// Execute query
					$stmt->execute();
					// store result 
					$result = $stmt->store_result();
					$stmt->close();
				}
				
				if($result){
					include_once('pushnotifications-newsfeed.php');
					$error['add_newsfeed'] = "*News Feed has been successfully added.";
				}else{
					$error['add_newsfeed'] = "*Failed adding new News Feed.";
				}
			}
				
			}
	?>
	<h1>Add News Feed</h1>
	<hr />
	<form method="post"
		enctype="multipart/form-data">
		<p>Heading:</p>
		<input type="text" name="heading" />
		<p class="alert"><?php echo isset($error['heading']) ? $error['heading'] : '';?></p>
	    <p>Link:</p>
		<input type="text" name="link" />
		<p class="alert"><?php echo isset($error['link']) ? $error['link'] : '';?></p>
		<input type="submit" value="Submit" name="btnAdd" />
		<input type="reset" value="Clear"/>
		<p class="alert"><?php echo isset($error['add_newsfeed']) ? $error['add_newsfeed'] : '';?></p>
	</form>
				
	<div class="separator"> </div>
</div>
			

<?php 
	$stmt_category->close();
	include_once('close_database.php'); ?>