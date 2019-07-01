<?php require_once('conn.php') ?>
<?php
$id = $_POST['idshop'];
	$query = "SELECT *,CONCAT(reviewername,'&nbsp;:&nbsp;&nbsp;',rate,'Star','&nbsp;-&nbsp;&nbsp;',comment,'&nbsp;','( ',datetime,' )') as userreview FROM shopreview WHERE shop_idshop = '$id' ORDER BY datetime DESC";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
