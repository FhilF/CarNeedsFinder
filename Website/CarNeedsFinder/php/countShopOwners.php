<?php require_once('conn.php') ?>
<?php
	$query = "select count(distinct so.idshopowner) as owners from 
shopowner so left join shop s on so.idshopowner = s.shopowner_idshopowner where s.activation = 'Active'";
	
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$count = $row['owners'];
	
	echo $count;
	

?>
	