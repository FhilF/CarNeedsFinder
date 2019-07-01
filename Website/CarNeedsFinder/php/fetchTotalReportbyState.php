<?php require_once('conn.php') ?>
<?php
	$state = $_POST['shopState'];
	$query = "SELECT count(idshopreport) as countreport FROM shopreport where reportstate = '$state'";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
