<?php require_once('conn.php') ?>
<?php
$activation = $_POST['activation'];
	$query = "Select *, concat(sh.firstname , ' ' , sh.lastname) as name, s.address as shopaddress from shop s RIGHT JOIN shopowner sh ON s.shopowner_idshopowner = sh.idshopowner where s.activation = '$activation'";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);
	

?>