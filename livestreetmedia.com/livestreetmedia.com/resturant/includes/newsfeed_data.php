<?php
	include_once('connect_database.php'); 
?>

<div id="content">
	<?php 
		if(isset($_GET['id'])){
			$ID = $_GET['id'];
		}else{
			$ID = "";
		}
		
		// create array variable to store data from database
		$data = array();
		
		// get all data from menu table and category table
		$sql_query = "SELECT ID, heading, link 
				FROM tbl_newsfeed
				WHERE ID = ? ";
		
		$stmt = $connect->stmt_init();
		if($stmt->prepare($sql_query)) {	
			// Bind your variables to replace the ?s
			$stmt->bind_param('s', $ID);
			// Execute query
			$stmt->execute();
			// store result 
			$stmt->store_result();
			$stmt->bind_result($data['ID'], 
					$data['Heading'], 
					$data['Link']
					);
			$stmt->fetch();
			$stmt->close();
		}
		
	?>
	<h1>Menu Detail</h1>
	<hr />
	<form method="post">
		<table>
			<tr class="row">
				<th class="detail">ID</th>
				<td class="detail"><?php echo $data['ID']; ?></td>
			</tr>
			<tr class="row">
				<th class="detail">Heading</th>
				<td class="detail"><?php echo $data['Heading']; ?></td>
			</tr>
				<tr class="row">
				<th class="detail">Link</th>
				<td class="detail"><?php echo $data['Link']; ?></td>
			</tr>
		</table>
		<div id="option_menu">
			<a href="edit-newsfeed.php?id=<?php echo $ID; ?>">Edit</a>
			<a href="delete-newsfeed.php?id=<?php echo $ID; ?>">Delete</a>
		</div>
	</form>
				
	<div class="separator"> </div>
</div>
			
<?php include_once('close_database.php'); ?>