<?php require_once('conn.php') ?>
<?php
	
	$query = "select * from shopreview sr RIGHT JOIN shop s ON sr.shop_idshop = s.idshop RIGHT JOIN shopowner so ON s.shopowner_idshopowner = so.idshopowner where reportstate = 1 order by adminstate, datereported desc";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
