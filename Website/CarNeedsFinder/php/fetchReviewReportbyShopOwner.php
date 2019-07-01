<?php require_once('conn.php') ?>
<?php

$id = ($_POST["id"]);
	$query = "Select *, COUNT(sr.idshopreview) as reviewcount , concat(sh.firstname , ' ' , sh.lastname) as name, s.address as shopaddress from shop s RIGHT JOIN shopowner sh ON s.shopowner_idshopowner = sh.idshopowner LEFT JOIN shopreview sr ON sr.shop_idshop = s.idshop where s.activation = 'Active' AND s.shopowner_idshopowner = '$id' AND sr.reportstate = '1' GROUP BY s.idshop";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>

