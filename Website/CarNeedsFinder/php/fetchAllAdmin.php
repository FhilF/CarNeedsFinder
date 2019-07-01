<?php require_once('conn.php') ?>
<?php
	$query = "select * , concat(lastname,', ',firstname) as name from admin where activation != 'Main' and activation != 'Deleted' order by lastname,firstname";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>