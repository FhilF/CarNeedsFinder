<?php require_once('conn.php') ?>
<?php
if (empty($_POST['idShopS'])) {
    header("Location: ../homeShopOwner.php");
}

$idShop = $_POST['idShopS'];
$service = $_POST['service'];
if (empty($_POST['servicePrice'])){
$price = "0.00 PHP";	
}else{
$price = $_POST['servicePrice']. 'PHP';
}

$query = "INSERT INTO shopservice(servicename,price,shop_idshop) VALUES ('".addslashes($service)."','".addslashes($price)."','$idShop')";
if(mysqli_query($conn, $query)){
	echo "success";
		}else{
	echo "error";
		}
?>
