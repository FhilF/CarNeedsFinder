<?php require_once('conn.php') ?>
<?php
$id = $_POST['idshop'];
	$query = "select * from shopreview where idshopreview = '$id'";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);
;
	

?>
