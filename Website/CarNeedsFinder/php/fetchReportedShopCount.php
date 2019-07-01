<?php require_once('conn.php') ?>
<?php
	$query = "SELECT *, count(idshopreport) as countreport FROM shop right join shopreport on shopreport.shop_idshop = shop.idshop where reportstate = 1 group by shop.idshop";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
