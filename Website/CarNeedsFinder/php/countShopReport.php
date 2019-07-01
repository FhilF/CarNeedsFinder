<?php require_once('conn.php') ?>
<?php

	$query = "SELECT count(idshopreport) as countreport FROM shopreport where reportstate = 0 AND adminstate = 0";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
