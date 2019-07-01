<?php require_once('conn.php') ?>
<?php
$id = $_POST['idshop'];
	$query = "SELECT *,CONCAT(report,'&nbsp;',' - ( ',datetime,' )') as userreport FROM shopreport LEFT JOIN shop on shop.idshop = shopreport.shop_idshop WHERE idshopreport = '$id'";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
