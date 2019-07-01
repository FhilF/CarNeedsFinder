<?php require_once('conn.php') ?>
<?php
$id = $_POST['idShopOwner'];


$query = "UPDATE adminreview ar right join shop s on ar.shop_idshop = s.idshop right join shopowner so on s.shopowner_idshopowner = so.idshopowner SET state = 1 where s.shopowner_idshopowner = '$id'";
if(mysqli_query($conn, $query)){
	echo 1;
		}else{
	echo 2;
	}
?>