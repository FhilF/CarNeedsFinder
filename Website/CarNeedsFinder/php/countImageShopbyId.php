<?php require_once('conn.php') ?>
<?php
	if (empty($_POST['id'])) {
    header("Location: ../homeShopOwner.php");
	}else{
	$id = $_POST['id'];
	}
	$query = "select count(idshopimage) as count from shopimage where shop_idshop = $id";
	
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_array($result);
	$count = $row['count'];
	
	echo $count;
	

?>
	