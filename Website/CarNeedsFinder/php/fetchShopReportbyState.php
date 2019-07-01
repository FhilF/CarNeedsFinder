<?php require_once('conn.php') ?>
<?php
	$state = $_POST['shopState'];
	$query = "SELECT * FROM shopreport LEFT JOIN shop on shop.idshop = shopreport.shop_idshop WHERE reportstate = '$state' ORDER BY datetime DESC, shop.shopname ASC";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
