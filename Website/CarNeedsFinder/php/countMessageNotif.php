<?php require_once('conn.php') ?>
<?php
	$idShopOwner = $_POST['idShopOwner'];
	$query = "select count(a.idadminreview) as review from adminreview a
			right join shop s on a.shop_idshop = s.idshop
			right join shopowner so on s.shopowner_idshopowner = so.idshopowner
			where state = '0' and so.idshopowner = '$idShopOwner'";
	
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$count = $row['review'];
	
	echo $count;
	

?>
	