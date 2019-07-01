<?php require_once('conn.php') ?>
<?php
$id = $_POST['idshop'];
$reportstate = $_POST['reportState'];
	$query = "SELECT * FROM shopreport LEFT JOIN shop on shop.idshop = shopreport.shop_idshop WHERE shop_idshop = '$id' and reportstate = '$reportstate' ORDER BY datetime DESC";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
