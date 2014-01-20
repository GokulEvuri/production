<?php
	include_once('connect_database.php'); 
	include_once('functions.php'); 	
	error_reporting(E_ALL ^ E_STRICT);
?>
<div id="content">
	<?php 

			
		if(isset($_POST['btnAdd'])){
			$description = $_POST['description'];
			$validity = (int)$_POST['validity'];
							
			echo $description;
			echo $validity;

			// create array variable to handle error
			$error = array();
			
			if(empty($description)){
				$error['description'] = "*Description should be filled.";
			}
							
				
			if(!empty($description)){
				
				$sql_query = "INSERT INTO tbl_coupons (description, validity)
						VALUES(?, ?)";
						
				$stmt = $connect->stmt_init();
				if($stmt->prepare($sql_query)) {	
					// Bind your variables to replace the ?s
					$stmt->bind_param('ss', 
								$description, 
								$validity);
					// Execute query
					$stmt->execute();
					// store result 
					$result = $stmt->store_result();
					$stmt->close();
				}
				
				if($result){
					$error['add_coupon'] = "*Coupon has been successfully added.";
				}else{
					$error['add_coupon'] = "*Failed adding new Coupon, see if you have set validity to 0 or 1.";
				}
			}
				
			}
	?>
	<h1>Add Coupons</h1>
	<hr />
	<form method="post"
		enctype="multipart/form-data">
		<p>Description:</p>
		<input type="text" name="description" />
		<p class="alert"><?php echo isset($error['description']) ? $error['description'] : '';?></p>
	    
		<p>Validity: 
			<select name="validity">
			  <option value=0>Valid</option>
			  <option value=1>Not Valid</option>
			</select>
		</p>
		<p class="alert"><?php echo isset($error['validity']) ? $error['validity'] : '';?></p>
		<input type="submit" value="Submit" name="btnAdd" />
		<input type="reset" value="Clear"/>
		<p class="alert"><?php echo isset($error['add_coupon']) ? $error['add_coupon'] : '';?></p>
	</form>
				
	<div class="separator"> </div>
</div>
			

<?php 
	include_once('close_database.php'); ?>