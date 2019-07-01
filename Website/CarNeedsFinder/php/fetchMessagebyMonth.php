<?php require_once('conn.php') ?>
<?php
	$id = $_POST['idShopOwner'];
	$month = $_POST['month'];
	$query = "select *, concat(a.firstname,' ',a.lastname) as adminName, a.image as adminImage from adminreview ar right join admin a on ar.admin_idadmin = a.idadmin left join shop s on ar.shop_idshop = s.idshop left join shopowner so on s.shopowner_idshopowner = so.idshopowner where ar.date between '$month' and curdate() and s.shopowner_idshopowner = '$id' order by ar.date desc, ar.time desc";
	
	$result = mysqli_query($conn, $query);
	
	$shop = array();
	while ($row = $result->fetch_assoc()) {
    	$shop[] = $row;
	}
	
	echo json_encode($shop);

	

?>
