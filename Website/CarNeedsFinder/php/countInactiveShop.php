<?php require_once('conn.php') ?>
<?php
	$query = "select count(idshop) as shops from shop where activation = 'Inactive'";
	
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$count = $row['shops'];
	
	echo $count;
	

?>
	