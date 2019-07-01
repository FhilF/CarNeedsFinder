<?php require_once('conn.php') ?>
<?php
	$query = "select count(idshopreview) as reports from shopreview where reportstate = 1 and adminstate = 0";
	
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$count = $row['reports'];
	
	echo $count;
	

?>
	
