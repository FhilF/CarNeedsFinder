<?php require_once('conn.php') ?>
<?php
	$query = "select count(iduser) as users from user";
	
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$count = $row['users'];
	
	echo $count;
	

?>
	