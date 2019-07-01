<?php require_once('conn.php') ?>
<?php
$id = $_POST['idshop'];
	$query = "Select *, concat(sh.firstname , ' ' , sh.lastname) as name, s.address as shopaddress from shopcopy s RIGHT JOIN shopowner sh ON s.shopowner_idshopowner = sh.idshopowner where s.shop_idshop = '$id'";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>