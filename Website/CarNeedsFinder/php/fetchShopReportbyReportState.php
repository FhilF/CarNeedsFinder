<?php require_once('conn.php') ?>
<?php
	$state = $_POST['shopState'];
	$query = "SELECT * FROM shopreport LEFT JOIN shop on shop.idshop = shopreport.shop_idshop WHERE reportstate = '0' ORDER BY adminstate, datetime DESC";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);


?>
